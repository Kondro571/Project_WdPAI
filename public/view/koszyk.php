
<html>
    <head>
    <title>Tak</title>
        <meta charset="utf-8">
        <meta name="description" content="My bisness">
        <meta name="author" content="Konrad Tatomir">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="public/css/koszyk.css">
        <!-- <link rel="stylesheet" href="css/bar.css"> -->

        <link rel="icon" type="image/x-icon" href="public/img/favicon.ico">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script src="public/js/car.js"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- <script src="js/menu.js"></script> -->
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
                    </div>
                    <a href="koszyk">
                        <img src="public/img/sbag.png" alt="Kosz" height="50">
                        <span class="info-text">Koszyk</span>
                        <!-- <span class="cart-item-count"><?php echo $_SESSION["car"] ?></span> -->
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

    <main>
    <div class="title">
        <h1>Koszyk</h1>
    </div>
        
        <div class="cart-and-summary">

            <aside class="cart">
                <h2>Produkt</h2>
                <?php 
                    $suma=0.00;
                    foreach ($produkty as $produkt):
                ?>
                <div class="product" data-product-id="<?php echo $produkt->getId(); ?>">
                    <p id="product">Produkt:</p>

                    <?php foreach ($produkt->getImages() as $z): ?>

                        <?php 
                        $im=$z;
                        endforeach; ?>
                            <img src="public/img/produkty/<?php echo $im; ?>" alt="<?php echo $produkt->getName(); ?>">

                    <div class="product-info">
                        <p> <?php echo $produkt->getName();  ?> </p>
                        <p>cena za sztukę:<?php echo $produkt->getPrice();  ?>zł</p>
                        <p>ilośc: <?php echo $produkt->getQuantity();  ?></p>
                        <a href="" class="delete_product_button"><i class="fa fa-trash-o"></i></a>

                    </div>
                    
                </div>
                <?php 
                $suma=$suma+$produkt->getPrice()*$produkt->getQuantity();
                $dostawa =50.00-$suma;
                if($dostawa<0){
                    $dostawa = 0.00;
                }
                endforeach; 
            ?>
            </aside>
        
            <!-- Prawa strona z podsumowaniem -->
            <div class="summary">
                <div class="summary-box">
                
                    <h2>Podsumowanie</h2>
                    <p><span>Wartość produktów:</span> <span class="right wartosc"><?php echo $suma;  ?> zł</span></p>
                    <p><span>Dostawa od:</span> <span class="right dostawa" ><?php echo $dostawa  ?> zł</span></p>
                    <p><span>Do zapłaty:</span> <span class="right lacznie"><?php echo $suma+$dostawa ?> zł</span></p>
                    <a <?php if($_SESSION["car"]>0) {echo 'href="order"';}?>><button href="order" class="checkout-button">Przejdź do kasy</button></a>
                </div>
            </div>
        </div>
    </main>
    </body>
</html>
