function showDetail(food, userOrStore, qty, total, code, id, status) {

    let statusText = '';

    if (status === 'paid') statusText = '✔ Paid';
    else if (status === 'process') statusText = '⏳ Diproses';
    else if (status === 'done') statusText = '✅ Selesai';
    else statusText = '⌛ Pending';

    let html = `
        <p><b>Makanan:</b> ${food}</p>
        <p><b>Toko / Pembeli:</b> ${userOrStore}</p>
        <p><b>Jumlah:</b> ${qty}</p>
        <p><b>Total:</b> Rp ${total}</p>
        <p><b>Kode Pesanan:</b> ${code}</p>
        <p><b>ID:</b> #${id}</p>
        <p><b>Status:</b> ${statusText}</p>

        <div style="margin-top:15px;text-align:center;">
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${code}">
        </div>
    `;

    document.getElementById('modal-body').innerHTML = html;
    document.getElementById('order-modal').style.display = 'block';
}

// close modal
document.addEventListener("DOMContentLoaded", function () {
    const closeBtn = document.querySelector('.close');

    if (closeBtn) {
        closeBtn.onclick = function () {
            document.getElementById('order-modal').style.display = 'none';
        };
    }

    window.onclick = function (e) {
        if (e.target.id === 'order-modal') {
            document.getElementById('order-modal').style.display = 'none';
        }
    };
});
