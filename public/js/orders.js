function showDetail(food, userOrStore, qty, total, code, id, status, paymentMethod = '-') {
    let statusClass = '';
    let statusText = '';

    if (status === 'paid') {
        statusClass = 'paid';
        statusText = 'Paid';
    } else if (status === 'process') {
        statusClass = 'process';
        statusText = 'Diproses';
    } else if (status === 'done') {
        statusClass = 'done';
        statusText = 'Selesai';
    } else {
        statusClass = 'pending';
        statusText = 'Pending';
    }

    const html = `
        <div class="timeline">
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <strong>Makanan</strong>
                    <p>${food}</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <strong>Detail</strong>
                    <p>Toko / Pembeli: ${userOrStore}</p>
                    <p>Jumlah: ${qty} porsi</p>
                    <p>Total: Rp ${total}</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <strong>Informasi Pesanan</strong>
                    <p>Kode: <b style="color: var(--primary-dark);">${code}</b></p>
                    <p>ID: #${id}</p>
                    <p>Metode Bayar: <b>${String(paymentMethod || '-').toUpperCase()}</b></p>
                    <p>Status: <span class="status ${statusClass}" style="display: inline-block; margin-top: 4px;">${statusText}</span></p>
                </div>
            </div>
        </div>

        <div style="text-align: center; margin-top: 20px;">
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${code}" alt="QR" style="border-radius: var(--radius); border: 2px solid var(--gray-100); padding: 8px; background: white;">
            <p style="font-size: 0.8rem; color: var(--gray-400); margin-top: 8px;">Scan QR saat pengambilan</p>
        </div>
    `;

    document.getElementById('modal-body').innerHTML = html;
    document.getElementById('order-modal').classList.add('active');
}

function closeModal() {
    document.getElementById('order-modal').classList.remove('active');
}

document.addEventListener('DOMContentLoaded', function() {
    window.addEventListener('click', function(e) {
        const modal = document.getElementById('order-modal');

        if (modal && e.target === modal) {
            modal.classList.remove('active');
        }
    });
});
