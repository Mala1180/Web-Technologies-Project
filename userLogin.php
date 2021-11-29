<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Consider removing My from project name :) -->
    <title>My Unibo Vinyl - Login</title>
</head>
<body>
    <header>
    <!-- wait for mala -->
    </header>
    <main>
        <section>
            <form name="formLogin">
                <input type="text" name="txtUsername" id="txtUsername" placeholder="Username" value="" required><br/>
                <input type="password" name="txtPassword" id="txtPassword" placeholder="Password" value="" required><br/>
                <input type="button" name="btnLogin" id="SubmitLogin" value="Entra">
            </form>
            <input type="button" name="btnGetResource" id="GetResource" value="test get resource">
            <input type="button" name="SubmitLogout" id="SubmitLogout" value="Logout">
        </section>
    </main>
    <script type="text/javascript" src="./public/js/RequestHelper.js"></script>
    <script type="text/javascript" src="./public/js/myjwtclass.js"></script>
    <script type="text/javascript" src="./public/js/login.js"></script>
    <script type="text/javascript" src="./public/js/request.js"></script>
    <script type="text/javascript" src="./public/js/logout.js"></script>
</body>
</html>