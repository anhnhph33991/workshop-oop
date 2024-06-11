const btn_addToCart = document.querySelector('.btn_addToCart');
const btn_qty = document.querySelector('#quantity_1');
const base_url = '/workshop-oop/cart/add';
// const count_cart = document.querySelector('.count_cart');

function addToCart(event, id) {
    event.preventDefault();

    let numberInput = btn_qty ? (+btn_qty.value) : 1;

    $.ajax({
        type: "POST",
        url: base_url,
        data: {
            productId: id,
            quantity: numberInput
        },
        success: ((res) => {
            console.log(`Quantity: ${res.quantity}`);
            console.log(res.productId);
            console.log(res.message)
            // console.log(res.cartID)
            console.log(`Qty Update ${res.qtyUpdate}`)
            console.log(`Count: ${res.count}`)



            $('.count_cart').text(res.count);
            toastr.success('Thêm vào giỏ hàng thành công 🛒');
        }),
        error: ((xhr, status, error) => {
            console.log(`LuxChill: ${xhr}`);
            console.log(`LuxChill: ${status}`);
            console.log(`LuxChill: ${error}`);
        })
    });
}
