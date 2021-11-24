<!DOCTYPE html>
<html lang="it">
<head>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- Consider removing My from project name :) -->
        <title>My Unibo Vinyl - Login</title>
    </head>
</head>
<body>
    <header>
    <!-- wait for mala -->
    </header>
    <main>
        <section><!-- action="login.php" method="post" -->
            <form name="formLogin">
                <input type="email" name="txtEmail" id="txtEmail" placeholder="Email" value="" required><br/>
                <input type="password" name="txtPassword" id="txtPassword" placeholder="Password" value="" required><br/>
                <input type="button" name="btnLogin" id="SubmitLogin" value="Entra">
            </form>


            <input type="button" name="btnGetResource" id="GetResource" value="get resource">
        </section>
    </main>
    <script type="text/javascript" src="./public/js/RequestHelper.js"></script>
    <script type="text/javascript" src="./public/js/myjwtclass.js"></script>
    <script type="text/javascript" src="./public/js/login.js"></script>
</body>
</html>