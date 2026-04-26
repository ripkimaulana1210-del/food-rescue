# Laravel WebSockets & Realtime Orders Setup

## 📦 Instalasi

### 1. Package yang Diinstall
```bash
composer require beyondcode/laravel-websockets
composer require pusher/pusher-php-server
```

### 2. Publish Configuration
```bash
php artisan vendor:publish --provider="BeyondCode\LaravelWebSockets\WebSocketsServiceProvider" --force
```

### 3. Run Migration
```bash
php artisan migrate
```

## ⚙️ Konfigurasi

### .env
```
BROADCAST_DRIVER=pusher
PUSHER_APP_ID=12345
PUSHER_APP_KEY=food-rescue-key
PUSHER_APP_SECRET=food-rescue-secret
PUSHER_HOST=127.0.0.1
PUSHER_PORT=6001
PUSHER_SCHEME=http
```

### Broadcasting Channels (routes/channels.php)
- `orders.{userId}` - Private channel untuk buyer
- `store-orders.{storeUserId}` - Private channel untuk seller

## 🎯 Features

### 1. Order Status Broadcasting
Ketika order status berubah, event `OrderStatusUpdated` di-broadcast ke:
- Buyer (via `orders.{userId}` channel)
- Seller (via `store-orders.{storeUserId}` channel)

### 2. Realtime Polling (AJAX)
Setiap 2 detik, halaman orders akan:
1. Fetch data terbaru dari `/api/orders/updates/buyer` atau `/api/orders/updates/seller`
2. Update UI tanpa page refresh
3. Smooth transition animation

### 3. Events
- **OrderStatusUpdated** - Triggered saat order status berubah
  - Channels: `orders.{userId}`, `store-orders.{storeUserId}`
  - Data: id, order_code, status, food_name, total_price, qty

## 🚀 Cara Menjalankan

### Terminal 1 - Laravel Server
```bash
php artisan serve
```
Server akan berjalan di `http://localhost:8000`

### Terminal 2 - WebSockets Server
```bash
php artisan websockets:serve
```
WebSockets akan berjalan di `127.0.0.1:6001`

### Terminal 3 - Queue Worker (Optional)
Jika ingin realtime event broadcasting:
```bash
php artisan queue:work
```

## 📱 Testing

### Scenario 1: Buyer sees status updates
1. Open `http://localhost:8000/pesanan` (Pesanan Saya)
2. Di tab lain, confirm payment sebagai seller
3. Buyer tab akan auto-update status tanpa refresh

### Scenario 2: Seller sees status updates
1. Open `http://localhost:8000/store/pesanan` (Pesanan Masuk)
2. Scan QR code dari halaman scan QR
3. Seller tab akan auto-update status

## 📝 File-file yang Dimodifikasi

### Backend
- `app/Events/OrderStatusUpdated.php` - NEW
- `app/Http/Controllers/OrderController.php` - Added broadcast() & API methods
- `routes/api.php` - Added realtime endpoints
- `routes/channels.php` - Added order channels
- `.env` - Configured WebSockets

### Frontend
- `public/js/realtime.js` - NEW (AJAX polling logic)
- `public/css/scan.css` - NEW (Extracted from scan.blade.php)
- `resources/views/orders/pesanan-saya.blade.php` - Added meta & realtime.js
- `resources/views/orders/scan.blade.php` - Extracted CSS to external file
- `resources/views/store/pesanan.blade.php` - Added meta & realtime.js
- `resources/views/layouts/app.blade.php` - Added @yield('meta')

## 🔧 API Endpoints

### GET `/api/orders/updates/buyer`
Get buyer's current orders (authenticated)
```json
{
  "orders": [
    {
      "id": 1,
      "status": "paid",
      "order_code": "ABC12345",
      "food_name": "Nasi Goreng",
      "total_price": 25000,
      "qty": 1
    }
  ]
}
```

### GET `/api/orders/updates/seller`
Get seller's incoming orders (authenticated)
```json
{
  "orders": [
    {
      "id": 2,
      "status": "pending",
      "order_code": "XYZ98765",
      "food_name": "Roti Bakar",
      "buyer_name": "John Doe",
      "total_price": 15000,
      "qty": 2
    }
  ]
}
```

## 🐛 Troubleshooting

### WebSockets port 6001 sudah digunakan
```bash
# Gunakan port lain di config/websockets.php
php artisan websockets:serve --port=6002
```

### Polling tidak bekerja
1. Check browser console untuk error AJAX
2. Pastikan user authenticated (login dulu)
3. Clear browser cache

### Status tidak update
1. Pastikan broadcast() di-trigger (check event log)
2. Pastikan user sudah subscribe ke channel yang benar
3. Restart WebSockets server

## 📚 Dokumentasi Terkait
- Laravel Broadcasting: https://laravel.com/docs/broadcasting
- Laravel WebSockets: https://beyondcode.io/docs/laravel-websockets
- Laravel Echo: https://laravel.com/docs/broadcasting#client-side-installation
