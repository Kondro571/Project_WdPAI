
<html>
    <head>
    <title>Tak</title>
        <meta charset="utf-8">
        <meta name="description" content="My bisness">
        <meta name="author" content="Konrad Tatomir">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="public/css/produkty.css">
        <link rel="icon" type="image/x-icon" href="public/img/favicon.ico">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script src="public/js/js1.js"></script>

    </head>
    <body>
        
        <header>
            <div class="logo">
                <a href="project"> <img src="public/img/logo.png" alt="Logo" height="70"></a>
            </div>
            <nav class="category">
                <div class="mobile-icon" onclick="toggleMenu()">&#9776;</div>
                <ol class="menu-list">
                    <li class="main-page-link"><a href="#">Strona główna</a></li>
                    <li><a href="#">Zabawki</a>
                        <ul class="sub-menu">
                            <li><a href="#">pluszaki</a></li>
                            <li><a href="#">karciane</a></li>
                            <li><a href="#">pole</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Papiernicze</a>
                        <ul class="sub-menu">
                            <li><a href="#">zeszyty</a></li>
                            <li><a href="#">bloki</a></li>
                            <li><a href="#">dlugopisy</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Inne</a>
                        <ul class="sub-menu">
                            <li><a href="#">bateria</a></li>
                            <li><a href="#">kartki</a></li>
                        </ul>
                    </li>
                </ol>
            </nav>
            
            
            <div class="top-bar">
                <div class="icons">
                    <div class="search-bar">
                        <img src="public/img/lupa.png">
                        <input type="text" placeholder="SZUKAJ">
                    </div>
                    <a href="koszyk">
                        <img src="public/img/sbag.png" alt="Kosz" height="50">
                        <span class="info-text">Koszyk</span>
                    </a>
                    <div class="user-menu">
                        <a href="login">
                            <img src="public/img/user.png" alt="Użytkownik" height="50">
                            <span class="info-text">Konto</span>
                        </a>
                        <a href="#" class="conto-btn btn1">Admin staf</a>
                        <a href="logout" class="conto-btn btn2">Wyloguj się</a>
                    </div>
                </div>
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
                            <button class="add-to-cart-button" data-product-id="<?php echo $productId; ?>">Dodaj do koszyka</button>

                        </div>
                </div>
            </div>
            <?php endforeach; ?>

    </div>

    </body>
</html>
