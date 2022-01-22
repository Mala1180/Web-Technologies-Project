<!DOCTYPE html>
<html lang="it">
    <head>
        <?php require("./templates/head-section.php"); ?>
        <link rel="stylesheet" href="./public/css/header.css" />
        <link rel="stylesheet" href="./public/css/orders.css" />

        <title>Unibo Vinyl - Ordini</title>
    </head>
    <body>
        <header>
            <div class="container">
                <nav>
                    <ul>
                        <li>
                            <a href="index.php"><img src="./public/img/logoBianco.png" alt="unibo logo"></a>
                        </li>
                        <li>
                            <a href="#" role="button">
                                <img id="menu-icon" src="./public/img/icons/menu.png" alt="menu icon" />
                            </a>
                        </li>
                    </ul>
                </nav>
                <a href="index.php">
                    <img src="./public/img/logoBianco.png" alt="unibo logo" />
                </a>
                <h1>Ordini</h1>
                <section id="menu-section">
                    <span>
                        <a href="./userRegister.php">Registrati</a>
                        <a href="./userLogin.php">Login</a>
                        <a href="./terms.php">Informativa sui dati</a>
                    </span> 
                    <span>
                        <a href="./profile.php">Il mio profilo</a>
                        <a href="./cart.php">Carrello</a>
                        <a href="./logout.php" id="logoutBtn">Logout</a>
                    </span>
                </section>
            </div>
        </header>
        <main>

        </main>
        <script src="./public/js/page-header.js"></script>
    </body>
</html>