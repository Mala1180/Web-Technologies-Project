<header>
    <div class="container">
        <nav>
            <ul>
                <li>
                    <a href="index.php"><img src="./public/img/logoBianco.png" alt="unibo logo"></a>
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
                    <img src="./public/img/icons/search.png" alt="" />
                    <input type="text" name="query" placeholder="Cerca..."/>

                </div>
                <div>
                    <label for="filter">Filtro: </label>
                    <select id="filter" name="filter">
                        <option value="">Seleziona...</option>
                        <option value="Vinile">Vinile</option>
                        <option value="CD">CD</option>
                        <option value="Giradischi">Giradischi</option>
                        <option value="Bundle">Bundle</option>
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