const btnAdd = document.querySelectorAll('.btnAdd');
const btnRemove = document.querySelectorAll('.btnRemove');
const url = '/workshop-oop/cart/update';

const formatPrice = (price) => {
    return `${price.toLocaleString("vi-VN")}đ`;
}
const handleAddRemove = (btn, count) => {

    const dataId = btn.getAttribute('data-id');
    let inputQty = document.querySelector(`.qty-${dataId}`);
    const productPrice = document.querySelector(`.price-${dataId}`).getAttribute('data-price')
    const productSubTotal = document.querySelector(`.total-${dataId}`)
    const productTotal = document.querySelector(`.price-total`)
    // id cart detail
    const cartId = productSubTotal.getAttribute('data-id-cart');
    const productId = productSubTotal.getAttribute('data-id-product')
    // id cart
    const cartIdReal = productSubTotal.getAttribute('data-id-cartId');

    let changeCount = +inputQty.value + count;

    $.ajax({
        type: "POST",
        url: url,
        data: {
            quantity: changeCount,
            id: dataId,
            price: productPrice,
            cartId: cartId,
            productId: productId,
            cartIdReal: cartIdReal
        },
        success: ((res) => {
            inputQty.value = res.quantity;
            productSubTotal.innerHTML = formatPrice(res.subTotal);
            productTotal.innerHTML = `<span>Total</span> ${formatPrice(res.priceTotal)}`;
            toastr.success('Update quantity success 🎊😍');
        }),
        error: ((err) => {
            console.log(err)
        })
    })
}

btnAdd.forEach((btn, index) => {
    btn.addEventListener('click', () => {
        handleAddRemove(btn, 1);
    })
})

btnRemove.forEach((btn, index) => {
    btn.addEventListener('click', () => {
        const dataId = btn.getAttribute('data-id');
        const qtyInput = document.querySelector(`.qty-${dataId}`).value;

        if (+qtyInput === 1) {
            toastr.warning('Xóa đi. Giảm gì lắm thế 🤬🤬');
            return;
        }
        handleAddRemove(btn, -1);
    })
})

