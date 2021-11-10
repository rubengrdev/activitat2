<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../styles/styles.css">
    <title>Register</title>
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
                    <form action="?url=register_action" method="post">
                        <div class="aligninput">
                            <input class="textlogin" type="text" name="username" placeholder="username">
                            <input class="textlogin" type="email" name="email" placeholder="email@mail.com">
                            <input class="textlogin" type="password" name="password" placeholder="password">
                            <input class="textlogin" type="password" name="passwordConfirmation" placeholder="password confirmation">
                        </div>
                        <div class="submit-button">
                            <input type="submit" value="Register" class="submit">
                        </div>
                </div>
                    </form>
                </div>
                </section>
        </article>
            
        </main>
        
</body>
<script type="text/javascript" src="../../lib/jsfunctionality.js"></script>
<script type="text/javascript" src="../../resources/breadcrumbs.js"></script>
</html>