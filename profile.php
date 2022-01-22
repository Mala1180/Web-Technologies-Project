<!DOCTYPE html>
<html lang="it">
    <head>
        <?php require("./templates/head-section.php"); ?>
        <link rel="stylesheet" href="./public/css/header.css" />
        <link rel="stylesheet" href="./public/css/profile.css" />


        <title>Unibo Vinyl - Profilo</title>
    </head>
    <body>
        <?php require_once("./templates/header.php"); ?>
        <!-- <header>
            <div class="container">
                <nav>
                    <ul>
                        <li>
                            <a href="index.php"><img src="./public/img/logoBianco.png" alt="logo"></a>
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
                <h1>Profilo</h1>
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
        </header> -->
        <main>
            <section><a href="orders.php">I miei ordini</a></section>
            <section><a href="notifications.php">Notifiche</a></section>
            <section><a href="settings.php">Impostazioni</a></section>
            <section><a href="payments.php">Pagamenti</a></section>
        </main>
        <script src="./public/js/page-header.js"></script>
    </body>
</html>