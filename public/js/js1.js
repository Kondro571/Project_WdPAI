function toggleMenu() {
    var menuList = document.querySelector('.menu-list');
    menuList.style.display = (menuList.style.display === 'flex' || menuList.style.display === '') ? 'none' : 'flex';
}

window.addEventListener('resize', function () {
    var menuList = document.querySelector('.menu-list');
    if (window.innerWidth > 705) {
        menuList.style.display = 'flex';
    } else {
        menuList.style.display = 'none';
    }
});
$(document).ready(function () {


    $(".quantity-button.minus, .quantity-button.plus").on("click", function () {
        var productId = $(this).data("product-id");
    
        var input = $(".quantity-input[data-product-id='" + productId + "']");


        var currentValue = parseInt(input.val());

        if ($(this).hasClass("plus") && currentValue < 50) {

            input.val(currentValue + 1);
        } else if ($(this).hasClass("minus") && currentValue > 1) {
            input.val(currentValue - 1);
        }
    });
    
    $(".add-to-cart-button").on("click", function () {
        var productId = $(this).data("product-id");
        var quantity = $(this).siblings(".quantity-control").find(".quantity-input").val();

        addToCart(productId, quantity);
        console.log("Dodano do koszyka: Produkt ID = " + productId + ", Ilość = " + quantity);
    });
    //fetched api
    function addToCart(productId, quantity) {   

        
        $.ajax({
            type: "POST",
            url: "add_to_cart",
            data: {
                productId: productId,
                quantity: quantity
            },
            success: function (response) {
                console.log(response);
                
            },
            error: function (error) {
                console.error(error);
            }
        });
    }

    // Nowa funkcja z Fetch API
    function addToCartFetch(productId, quantity) {
        fetch('add_to_cart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                productId: productId,
                quantity: quantity
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log(data);
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
    }


    $(".product-container .product-img").hover(
        function () {
            $(this).find(".nav-arrow").css("opacity", 1);
        },
        function () {
            $(this).find(".nav-arrow").css("opacity", 0);
        }
    );

    $(".product-container .next-arrow").on("click", function () {
        showNextImage($(this).closest(".product"));
    });

    $(".product-container .prev-arrow").on("click", function () {
        showPrevImage($(this).closest(".product"));
    });

    function showNextImage(product) {
        const images = product.find("img");
        const currentImageIndex = product.data("current-image-index") || 0;
        const totalImages = images.length;
        const nextImageIndex = (currentImageIndex + 1) % totalImages;

        product.data("current-image-index", nextImageIndex);
        updateImageTransform(product, nextImageIndex);
    }

    function showPrevImage(product) {
        const images = product.find("img");
        const currentImageIndex = product.data("current-image-index") || 0;
        const totalImages = images.length;
        const prevImageIndex = (currentImageIndex - 1 + totalImages) % totalImages;

        product.data("current-image-index", prevImageIndex);
        updateImageTransform(product, prevImageIndex);
    }

    function updateImageTransform(product, imageIndex) {
        const translateValue = -imageIndex * 100 + "%";
        product.find("img").css("transform", "translateX(" + translateValue + ")");
    }




});