
<html>
    <head>
    <title>Tak</title>
        <meta charset="utf-8">
        <meta name="description" content="My bisness">
        <meta name="author" content="Konrad Tatomir">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="public/css/style2.css">
        <link rel="icon" type="image/x-icon" href="public/img/favicon.ico">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script src="public/js/js1.js"></script>

    </head>
    <body>
        
    <header>
        <div >
            <a href="project"> <img src="public/img/logo.png" alt="Logo" height="70"></a>
        </div>
        <nav class="category">
            <ul>
                <li>zabawki

                    <ul class="sub-menu">
                        <li>Podkategoria 1.1</li>
                        <li>Podkategoria 1.2</li>
                        <li>Podkategoria 1.3</li>
                    </ul>
                </li>
                  
                <li>papiernicze</li>
                <li>inne</li>
            </ul>
        </nav>
        <div class="icons">
           
            <div class="search-bar">
                <input type="text" placeholder="Wyszukaj...">
            </div>
            <img src="public/img/sbag.png" alt="Kosz"  height="50">
            <a href="login">
            <img src="public/img/user.png" alt="Użytkownik" height="50">
            </a>
        </div>
    </header>
    <div class="filter-menu">

    </div>
    <div class="product-container">
        <?php foreach ($produkty as $produkt):?>
            <div class="product">
                <div class="product-img">
                    <?php foreach ($produkt->getImages() as $z): ?>
                            <img src="public/img/produkty/<?php echo $z; ?>" alt="<?php echo $produkt->getName(); ?>">
         
                    <?php endforeach; ?>
                    <div class="nav-arrow prev-arrow"></div>
                    <div class="nav-arrow next-arrow"></div>
                </div>
                    <div class="product-info">

                    <h3><?php echo $produkt->getName(); ?></h3>
                    <p><?php echo $produkt->getPrice(); ?> zł/szt</p>

                    <div class="quantity-control">
                    <button id="b" class="quantity-button minus" data-product-id="<?php echo $productId; ?>">-</button>
                    <input type="number" class="quantity-input" value="1" min="1" max="<?php echo $produkt->getQuantity(); ?>" data-product-id="<?php echo $productId; ?>">
                    <button id="b" class="quantity-button plus" data-product-id="<?php echo $productId; ?>">+</button>

                    </div>
                    <button class="add-to-cart-button" data-product-id="<?php echo $productId; ?>">Dodaj do koszyka</button>
                </div>
            </div>
            <?php endforeach; ?>

    </div>

    </body>
</html>
