
<html>
    <head>
    <title>Tak</title>
        <meta charset="utf-8">
        <meta name="description" content="My bisness">
        <meta name="author" content="Konrad Tatomir">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="public/css/style2.css">
        <link rel="icon" type="image/x-icon" href="public/img/favicon.ico">
        
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
    <div class="left-menu">

    <div>
    <div class="display">
    <?php foreach ($zabawki as $zabawka):?>
        <div class="product">
            <div class="product-img">
                <img src="<?php echo $zabawka->getImages();?>" alt="<?php echo $zabawka->getName();?>">
            </div>
            <div class="product-info">
                <h3><?php echo $zabawka->getName();?></h3>
                <p><?php echo $zabawka->getProducer();?></p>
                <p><?php echo $zabawka->getPrice();?></p>
                <p><?php echo $zabawka->getQuantity();?></p>
            </div>
        </div>



        <?php endforeach;?>
    </div>

    </body>
</html>
