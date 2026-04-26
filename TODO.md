# TODO - Implementasi Alur Pesanan Baru

## Plan

1. **Migration**: Tambah kolom `payment_method` ke tabel orders
2. **Model Order.php**: Tambah `payment_method` ke fillable
3. **OrderController.php**:
   - `store()`: Simpan `payment_method` ke DB
   - `scan()`: Ubah jadi redirect ke halaman detail (bukan langsung selesai)
   - `showScanResult()`: Method baru untuk tampilkan detail pesanan setelah scan
   - `complete()`: Method baru untuk menandai pesanan `paid` jadi `done`
4. **scan-result.blade.php**: View baru untuk detail pesanan (sisi toko)
5. **scan.blade.php**: Update pesan flash
6. **store/pesanan.blade.php**: Tambah tombol "Selesaikan" untuk pesanan paid
7. **payment_success.blade.php**: Update copy
8. **pesanan-saya.blade.php**: Tampilkan metode pembayaran
9. **routes/web.php**: Tambah route scan result & complete
10. **orders.js**: Update modal untuk tampilkan payment_method

---

## Progress

- [x] 1. Migration `payment_method`
- [x] 2. Model Order.php
- [x] 3. OrderController.php
- [x] 4. scan-result.blade.php
- [x] 5. scan.blade.php
- [x] 6. store/pesanan.blade.php
- [x] 7. payment_success.blade.php
- [x] 8. pesanan-saya.blade.php
- [x] 9. routes/web.php
- [x] 10. orders.js
- [x] 11. php artisan migrate

