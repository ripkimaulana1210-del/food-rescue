# TODO - Fix Order Pages Bugs

## Plan (9 items) - ALL COMPLETED ✅
- [x] 1. `OrderController::store()` - Validate qty, reduce food portions, update sold_out status
- [x] 2. `public/js/realtime.js` - Only animate cards when status actually changes
- [x] 3. `resources/views/orders/scan.blade.php` - Prevent duplicate QR submissions, uppercase & trim manual input
- [x] 4. `public/js/orders.js` - Replace `window.onclick` with `addEventListener`
- [x] 5. `resources/views/foods/food_detail.blade.php` - Add missing closing `</div>` for `.detail-card`
- [x] 6. `OrderController::scan()` - Add ownership check (only store owner can validate)
- [x] 7. `OrderController::scan()` - `strtoupper(trim($code))` before query
- [x] 8. `routes/web.php` - Scan routes already have `auth` middleware
- [x] 9. `OrderController::scan()` + `store/pesanan.blade.php` - Redirect to store orders page with auto-show detail modal
