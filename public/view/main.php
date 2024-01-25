
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

        <script src="public/js/shop.js"></script>
        <script src="public/js/search.js"></script>
        <style>
        #suggestionsList {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        #suggestionsList li {
            cursor: pointer;
            padding: 5px;
            border: 1px solid #ccc;
            width:40px;
        }
    </style>

    </head>
    <body>
        
    <header>
            <div class="logo">
                <a href="main"> <img src="public/img/logo.png" alt="Logo" height="70"></a>
            </div>
            <nav class="category">
                <div class="mobile-icon" onclick="toggleMenu()">&#9776;</div>
                <ol class="menu-list">
                    <li class="main-page-link"><a href="#">Strona główna</a></li>
                    <li><a href="zabawki">Zabawki</a>
                        <ul class="sub-menu">
                            <li><a href="pluszaki">pluszaki</a></li>
                            <li><a href="karciane">karciane</a></li>
                        </ul>
                    </li>
                    <li><a href="papiernicze">Papiernicze</a>
                        <ul class="sub-menu">
                            <li><a href="zeszyty">zeszyty</a></li>
                            <li><a href="bloki">bloki</a></li>
                            <li><a href="dlugopisy">dlugopisy</a></li>
                        </ul>
                    </li>
                    <li><a href="inne">Inne</a>
                        <ul class="sub-menu">
                            <li><a href="baterie">bateria</a></li>
                            <li><a href="kartki">kartki</a></li>
                        </ul>
                    </li>
                </ol>
            </nav>
            
            
            <div class="top-bar">
                <div class="icons">
                    <div class="search-bar">
                        <img src="public/img/lupa.png">
                        <input type="text" placeholder="SZUKAJ">
                        <ul id="suggestionsList"></ul>
                    </div>
                    <a href="koszyk">
                        <img src="public/img/sbag.png" alt="Kosz" height="50">
                        <span class="info-text">Koszyk</span>
                        <span class="cart-item-count"><?php echo $_SESSION["car"] ?></span>
                    </a>
                    <div class="user-menu">
                        <?php 
                        
                        if($_SESSION['loggedin'] == true) { 
                                
                                $link = "profil";
                        
                            } else {

                                $link = "login";
                            }

                        ?>
                        <a href="<?php echo $link?>">
                            <img src="public/img/user.png" alt="Użytkownik" height="50">
                            <span class="info-text">Konto</span>
                        </a>
                        <?php if($_SESSION['loggedin'] == true) {?>
                            <?php if($_SESSION['isAdmin']) {?>
                                <a href="admin_staf" class="conto-btn btn1">Admin staf</a>
                                <a href="logout" class="conto-btn btn2">Wyloguj się</a>
                            <?php }else{?>
                                <a href="logout" class="conto-btn btn1">Wyloguj się</a>
                                <?php } ?>
                        
                        <?php }?>
                    </div>
                </div>
            </div>
            
        </header>
    <div class="filter-menu">

    </div>
    <div class="product-container">


            <?php 
            foreach ($produkty as $produkt):?>
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
                            <button id="b" class="quantity-button minus" data-product-id="<?php echo $produkt->getId(); ?>">-</button>
                            <input type="number" class="quantity-input" data-product-id="<?php echo $produkt->getId(); ?>" value="1" min="1" max="<?php echo $produkt->getQuantity(); ?>">
                            <button id="b" class="quantity-button plus" data-product-id="<?php echo $produkt->getId(); ?>">+</button>
                            <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {?>
                                <button class="add-to-cart-button" data-product-id="<?php echo $produkt->getId(); ?>">Dodaj do koszyka</button>
                            <?php }else{?>
                                <button class="login-first" href="login">Zaloguj sie aby dodać do koszyka</button>
                            <?php }?>

                        </div>
                </div>
            </div>
            <?php endforeach; ?>

    </div>

    </body>
</html>
