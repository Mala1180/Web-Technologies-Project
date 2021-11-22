<html lang="it">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Unibo Vinyl</title>

    <link rel="stylesheet" href="css/index.css" />
    <link rel="stylesheet" href="css/font.css" />
    <link rel="stylesheet" href="css/utility.css" />

    <script src="js/index.js"></script>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li>
                    <a href="index.php"><img src="img/logoBianco.png" alt="unibo logo"></a>
                </li>
                <li>
                    <img src="img/icons/search.png" alt="search icon" />
                </li>
                <li>
                    <img src="img/icons/menu.png" alt="search icon">
                </li>
            </ul>
        </nav>
        <section class="hidden">
            <div>
                <img src="img/icons/search.png" alt="search icon" />
                <input type="text" />
            </div>
            <div>
                <label id="ciao" for="filter">Filtra: </label>
                <select id="filter" name="filter">
                    <option value="Vinile">Vinile</option>
                    <option value="CD">CD</option>
                    <option value="Giradischi">Giradischi</option>
                    <option value="Bundle">Bundle</option>
                </select>
            </div>
        </section>
        <section class="hidden">
            <a href="register.html">Registrati</a>
            <a href="login.html">Accedi</a>
            <a href="#">Informativa sui dati</a>
        </section>
    </header>
    <main>
        <section>
            <h1>Vinili</h1>
        </section>
        <section>
            <h1>CD</h1>
        </section>
        <section>
            <h1>Giradischi</h1>
        </section>
        <section>
            <h1>Bundle</h1>
        </section>
    </main>
</body>
</html>