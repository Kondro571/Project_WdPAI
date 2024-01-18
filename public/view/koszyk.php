
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

        <script src="public/js/js1.js"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- <script src="js/menu.js"></script> -->
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
                        <a href="#" class="conto-btn btn2">Wyloguj się</a>
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
                <div class="product">
                    <p id="product">Produkt:</p>
                    <img src="img/produkty/mis1.jpg" alt="Produkt 1">
                    <div class="product-info">
                        <p>Nazwa Produktu</p>
                        <p>Cena: $20.00</p>
                        <p>Ilość: 2</p>
                        <i class="fa fa-trash-o"></i>
                    </div>
                    
                </div>
                <div class="product">
                    <img src="img/produkty/mis1.jpg" alt="Produkt 1">
                    <div class="product-info">
                        <h3>Nazwa Produktu</h3>
                        <p>Cena: $20.00</p>
                        <p>Ilość: 2</p>
                    </div>
                    <button class="remove-button">Usuń</button>
                </div>
                <div class="product">
                    <img src="img/produkty/mis1.jpg" alt="Produkt 1">
                    <div class="product-info">
                        <h3>Nazwa Produktu</h3>
                        <p>Cena: $20.00</p>
                        <p>Ilość: 2</p>
                    </div>
                    <button class="remove-button">Usuń</button>
                </div>
                <div class="product">
                    <img src="img/produkty/mis1.jpg" alt="Produkt 1">
                    <div class="product-info">
                        <h3>Nazwa Produktu</h3>
                        <p>Cena: $20.00</p>
                        <p>Ilość: 2</p>
                    </div>
                    <button class="remove-button">Usuń</button>
                </div>
            </aside>

            <!-- Prawa strona z podsumowaniem -->
            <div class="summary">
                <div class="summary-box">
                    <h2>Podsumowanie</h2>
                    <p><span>Wartość produktów:</span> <span class="right">$40.00</span></p>
                    <p><span>Dostawa od:</span> <span class="right">$5.00</span></p>
                    <p><span>Do zapłaty:</span> <span class="right">$45.00</span></p>
                    <button class="checkout-button">Przejdź do kasy</button>
                </div>
            </div>
        </div>
    </main>
    </body>
</html>
