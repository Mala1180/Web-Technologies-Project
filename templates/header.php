<header>
    <div class="container">
        <nav>
            <ul>
                <li>
                    <a href="index.php"><img src="./public/img/logoBianco.png" alt="logo home"></a>
                </li>
                <li>
                    <button id="search-button">
                        <img src="./public/img/icons/search.png" alt="icona che apre menu di ricerca" />
                    </button>
                </li>
                <li>
                    <button id="menu-button">
                        <img src="./public/img/icons/menu.png" alt="icona che apre menu utente" />
                    </button>
                </li>
            </ul>
        </nav>
        <a href="index.php">
            <img src="./public/img/logoBianco.png" alt="unibo logo" />
        </a>
        <section id="search-section">
            <form method="GET" action="userSearch.php">
                <div>
                    <label for="query">Cerca: </label>
                    <input id="query" name="query" type="text" placeholder="Album..."/>
                    <img src="./public/img/icons/search.png" alt="" />
                </div>
                <div>
                    <label for="filter">Filtro: </label>
                    <select id="filter" name="filter">
                        <option value="">Seleziona...</option>
                        <option value="1">Vinile</option>
                        <option value="0">CD</option>
                        <!-- <option value="2">Giradischi</option>
                        <option value="3">Bundle</option> -->
                    </select>
                </div>
                <!-- <input type="submit" value="Cerca" /> -->
            </form>
        </section>
        <section id="menu-section">
            <span>
                <a href="./userRegister.php">Registrati</a>
                <a href="./userLogin.php">Login</a>
                <a href="./terms.php">Informativa sui dati</a>
            </span> 
            <span>
                <a href="./profile.php">Profilo</a>
                <a href="./cart.php">Carrello</a>
                <a href="./userNotifications.php">Notifiche</a>
                <a href="./logout.php" id="logoutBtn">Logout</a>
            </span>
        </section>
    </div>
</header>