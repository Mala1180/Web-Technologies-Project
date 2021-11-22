<html lang="it">
<head>
    <head>
        <!-- Consider removing My from project name :) -->
        <title>My Unibo Vinyl - Login</title>
        <?php require("templates/head-section.php"); ?>
    </head>
</head>
<body>
    <header>
    <!-- wait for mala -->
    </header>
    <main>
        <section>
            <form name="formLogin" action="login.php" method="post">
                <input type="email" name="txtEmail" id="txtEmail" placeholder="Email" value="" required><br/>
                <input type="password" name="txtPassword" id="txtPassword" placeholder="Password" value="" required><br/>
                <input type="submit" name="btnLogin" id="SubmitLogin" name="SubmitLogin" value="Entra">
            </form>
        </section>
    </main>
</body>
</html>