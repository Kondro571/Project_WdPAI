
<html>
    <head>
    <title>Tak</title>
        <meta charset="utf-8">
        <meta name="description" content="My bisness">
        <meta name="author" content="Konrad Tatomir">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="public/css/konto.css">
        <link rel="stylesheet" href="public/css/bar.css">

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
                        <a href="logout" class="conto-btn btn2">Wyloguj się</a>
                    </div>
                </div>
            </div>
            
        </header>

    <main>
        <h1>Profil Użytkownika</h1>

        <div class="user-info">
            <?php if(isset($user)){ ?>
            <div class="row">
                <div class="info-header">
                    <h3>Imię i Nazwisko</h3>
                </div>
                <div class="user-data">
                <?php echo $user->getName() ,$user->getSurname() ?>
                </div>
            </div>
      
            <div class="row">
                <div class="info-header">
                    <h3>Email</h3>
                </div>
                <div class="user-data">
                    <?php echo $_SESSION["user_email"]?>
                </div>
            </div>
            <div class="row">
                <div class="info-header">
                    <h3>Nr. telefonu</h3>
                </div>
                <div class="user-data">
                    <?php echo $user->getPhone()?>
                </div>
            </div>
  
            <div class="row">
                <div class="info-header">
                    <h3>Adres</h3>
                </div>
                <div class="user-data">
                    <?php echo $user->getCity() ,$user->getStreet(), $user->getNumber(), $user->getPostCode()?>
                </div>
            </div>
            <div class="edit">
                <a class="edit-link" target="__blank" href="edytuj_profil">Edytuj dane</a>
            </div>
            <?php }?>
        </div>

    </main>
</body>
</html>
