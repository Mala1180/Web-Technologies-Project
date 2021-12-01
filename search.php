<!DOCTYPE html>
<html lang="it">
    <head>
        <?php require("./templates/head-section.php"); ?>
        <link rel="stylesheet" href="./public/css/header.css" />
        <link rel="stylesheet" href="./public/css/search.css" />

        <title>Unibo Vinyl</title>
    </head>
    <body>
        <?php require("./templates/page-header.php"); ?>
        <main>
            <section class="article">
                <img src="public/img/vinile1.jpg" alt="article image" />
                <aside>
                    <div>
                        <h1>Vinile 1 prova nome lugno</h1>
                        <span>Tipologia: Vinile</span>
                    </div>
                    <div>
                        <span>€ 25</span>
                        <input type="button" value="Aggiungi al carrello" />
                    </div>
                </aside>
            </section>
            <section class="article">
                <img src="public/img/vinile1.jpg" alt="article image" />
                <aside>
                    <div>
                        <h1>Vinile 1</h1>
                        <span>Tipologia: Vinile</span>
                    </div>
                    <div>
                        <span>€ 25</span>
                        <input type="button" value="Aggiungi al carrello" />
                    </div>
                </aside>
            </section>
        </main>
        <footer>
            <img src="public/img/icons/cancel.png" alt="close cart preview image" />
            <h1>Il tuo carrello</h1>
            <section>
                <div>
                    <img src="public/img/vinile1.jpg" alt="article image" />
                    <h1>Nome Vinile</h1>
                </div>
                <span>Vinile</span>
                <div>
                    <span class="material-icons-outlined">add</span>
                    <span>€ 25</span>
                </div>
            </section>
            <section>
                <div>
                    <img src="public/img/vinile1.jpg" alt="article image" />
                    <h1>Nome Vinile</h1>
                </div>
                <span>Vinile</span>
                <div>
                    <span class="material-icons-outlined">add</span>
                    <span>€ 25</span>
                </div>
            </section>
            <section>
                <div>
                    <img src="public/img/vinile1.jpg" alt="article image" />
                    <h1>Nome Vinile</h1>
                </div>
                <span>Vinile</span>
                <div>
                    <span class="material-icons-outlined">add</span>
                    <span>€ 25</span>
                </div>
            </section>
            <span>Visualizza tutto</span>
        </footer>
    </body>
</html>