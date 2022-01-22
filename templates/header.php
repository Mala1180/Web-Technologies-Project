<header>
    <div class="container">
        <nav>
            <ul>
                <li>
                    <a href="index.php"><img src="./public/img/logoBianco.png" alt="logo"></a>
                </li>
                <li>
                    <a href="#" role="button">
                        <img id="search-icon" src="./public/img/icons/search.png" alt="search icon" />
                    </a>
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
            </form>
        </section>
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