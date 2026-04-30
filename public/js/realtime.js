/**
 * Realtime Orders - Auto-refresh orders without page reload
 */

class OrdersRealtime {
    constructor() {
        this.pollInterval = 2000; // 2 seconds
        this.activeChannels = new Set();
    }

    /**
     * Subscribe to order updates
     * @param {number} userId - User ID untuk filter orders
     * @param {string} orderType - 'buyer' atau 'seller'
     */
    subscribe(userId, orderType = 'buyer') {
        const channelKey = `${orderType}-${userId}`;
        
        if (this.activeChannels.has(channelKey)) {
            return;
        }

        this.activeChannels.add(channelKey);
        this.startPolling(userId, orderType);
    }

    /**
     * Start polling untuk updates
     */
    startPolling(userId, orderType) {
        const pollId = setInterval(async () => {
            try {
                const response = await fetch(`/api/orders/updates/${orderType}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    const data = await response.json();
                    this.handleUpdates(data, orderType);
                }
            } catch (error) {
                console.error('Polling error:', error);
            }
        }, this.pollInterval);

        // Store poll ID untuk dapat di-clear later
        window.ordersPollId = pollId;
    }

    /**
     * Handle order updates
     */
    handleUpdates(data, orderType) {
        if (!data || !data.orders) return;

        data.orders.forEach(order => {
            this.updateOrderCard(order, orderType);
        });
    }

    /**
     * Update order card dengan status terbaru
     */
    updateOrderCard(order, orderType) {
        const orderCard = document.querySelector(`[data-order-id="${order.id}"]`);
        if (!orderCard) return;

        // Update status badge
        const statusBadge = orderCard.querySelector('.status');
        if (statusBadge) {
            // Only animate if status actually changed
            const currentStatus = statusBadge.classList.item(1);
            if (currentStatus !== order.status) {
                this.updateStatusBadge(statusBadge, order.status);

                // Trigger animation only on status change
                orderCard.style.opacity = '0.5';
                setTimeout(() => {
                    orderCard.style.opacity = '1';
                }, 300);
            }
        }
    }

    /**
     * Update status badge
     */
    updateStatusBadge(badge, status) {
        badge.className = 'status ' + status;
        
        const statusTexts = {
            'pending': '⌛ Pending',
            'paid': '✔ Paid',
            'process': '⏳ Diproses',
            'done': '✅ Selesai'
        };

        badge.textContent = statusTexts[status] || status;
    }

    /**
     * Unsubscribe dari polling
     */
    unsubscribe() {
        if (window.ordersPollId) {
            clearInterval(window.ordersPollId);
            this.activeChannels.clear();
        }
    }
}

// Initialize realtime orders
const ordersRealtime = new OrdersRealtime();

// Auto-subscribe ketika page loaded
document.addEventListener('DOMContentLoaded', function () {
    // Check apakah page adalah orders page
    if (document.querySelector('.orders-wrapper')) {
        const userIdMeta = document.querySelector('meta[name="user-id"]');
        const orderTypeMeta = document.querySelector('meta[name="order-type"]');
        
        if (userIdMeta && orderTypeMeta) {
            ordersRealtime.subscribe(userIdMeta.content, orderTypeMeta.content);
        }
    }
});

// Cleanup when page unload
window.addEventListener('beforeunload', function () {
    ordersRealtime.unsubscribe();
});
