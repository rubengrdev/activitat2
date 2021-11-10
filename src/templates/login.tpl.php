<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../styles/styles.css">
    
    <title>Login</title>
</head>
<body>

    <header>
        <nav>
            <h1> <?= $nom; ?> </h1>
        </nav>
        
    </header>
    <main>


        <div id="menuContainer">
            <div id="menu">
            <ul>
                <li>
                    <a href="?url=login">Login</a>
                </li>
                <li>
                    <a href="?url=register">Register</a>
                </li>
                <li>
                    <a href="?url=home">Home</a>
                </li>
                
            </ul>
            </div>
        </div>


        <article>
            <section>
                <div id="breadcrumb"></div>
                <div id="login-box">
                    <form action="?url=login_action" method="post">
                        <div class="aligninput">
                            <input class="textlogin" type="email" name="email" placeholder="email@mail.com">
                            <input class="textlogin" type="password" name="password" placeholder="password">
                        </div>
                        <div class="remember">
                            <label><p>Recordarme en este equipo</p></label><input class="checkbox" type="checkbox" name="remember">
                        </div>
                        <div class="submit-button">
                            <input type="submit" value="Login" class="submit">
                        </div>
               
                    </form>
                    </div>
                </div>
                </section>
        </article>
            
        </main>
        
</body>
<script type="text/javascript" src="../../lib/jsfunctionality.js"></script>
<script type="text/javascript" src="../../resources/breadcrumbs.js"></script>
</html>