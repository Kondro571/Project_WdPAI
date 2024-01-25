$(document).ready(function() {
    $(".delete_product_button").on("click", function(e) {
        e.preventDefault();

        var productId = $(this).closest(".product").data("product-id");
        console.log(productId);
        fetch('remove_from_cart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                productId: productId
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
    
            if (response.status === 200) {
                console.log('usunieto produkt');
            }
            return response.json();
        })
        .then(data => {
            console.log('Odpowiedź z serwera:', data);
            var total=data["total"]
            $(this).closest(".product").remove();

            $(".wartosc").text(total + " zł");
            var dostawa = 50.00 - total;
            if (dostawa < 0) {
                dostawa = 0.00;
            }
            $(".dostawa").text(dostawa + " zł");
            $(".lacznie").text(Number(dostawa) + Number(total)+ " zł");

            const cartItemCountElement = $('.cart-item-count');
            const currentCount = parseInt(cartItemCountElement.text()) || 0;
            const newCount = currentCount - 1;
            
            cartItemCountElement.text(newCount);


        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });





    });
});