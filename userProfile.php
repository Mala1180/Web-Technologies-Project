<!DOCTYPE html>
<?php 
    require_once("server/validate.php");
    if (!is_client_logged(true)) {
        header("location: userLogin.php");
    }
?>
<html lang="it">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Unibo Vinyl - Profilo</title>
</head>
<body>
    <header>
    <!-- wait for mala -->
    </header>
    <main>  
        <section>
            <h1>Il mio profilo</h1>
        </section>


    </main>
    <script type="text/javascript" src="./public/js/RequestHelper.js"></script>
    <script type="text/javascript" src="./public/js/myjwtclass.js"></script>
    <script type="text/javascript" src="./public/js/profile.js"></script>
</body>
</html>


<?php

?>