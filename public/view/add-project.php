
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
            <a href="login"> <img src="public/img/logo.png" alt="Logo" height="70"></a>
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
            <img src="public/img/user.png" alt="Użytkownik" height="50">
        </div>
    </header>
    <div>
        <h1>Upoad</h1>
        <form action="addProject" method="post" enctype="multipart/form-data">
        <?php 
        if(isset($messages)){
                        foreach($messages as $message){
                            echo $message;
                        }
                    }
        ?>

        <input name="title" type="text" placeholder="title">
        <textarea name="description" rows="5" placecholder="desciption"></textarea>
        <input type="file" name="file">
        <button type="submit">przycisk</button>

        </form>

    </div>

    </body>
</html>
