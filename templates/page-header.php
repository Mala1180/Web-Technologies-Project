<header>
    <div class="container">
        <nav>
            <ul>
                <li>
                    <a href="index.php"><img src="./public/img/logoBianco.png" alt="unibo logo"></a>
                </li>
                <li>
                    <img src="./public/img/icons/search.png" alt="search icon" />
                </li>
                <li>
                    <img src="./public/img/icons/menu.png" alt="search icon" />
                </li>
            </ul>
        </nav>
        <a href="index.php">
            <img src="./public/img/logoBianco.png" alt="unibo logo" />
        </a>
        <section>
            <!-- TODO: input, selects, ... must be in a form tag -->
            <div>
                <img src="./public/img/icons/search.png" alt="search icon" />
                <input type="text" />
            </div>
            <div>
                <label for="filter">Filtra: </label>
                <select id="filter" name="filter">
                    <option value="Vinile">Vinile</option>
                    <option value="CD">CD</option>
                    <option value="Giradischi">Giradischi</option>
                    <option value="Bundle">Bundle</option>
                </select>
            </div>
        </section>
        <section>
            <?php if (isset($username)) { ?>
                    <a href="./profile.php">Il mio profilo</a>
                    <a href="./terms.php">Informativa sui dati</a>
                    <a href="./logout.php">Logout</a>
            <?php } else { ?>
                    <a href="./userRegister.php">Registrati</a>
                    <a href="./userLogin.php">Login</a>
                    <a href="./terms.php">Informativa sui dati</a>
            <?php } ?> 
        </section>
    </div>
</header>