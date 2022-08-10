<html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Styles.css">
    <title>Index</title>
</head>

<body>


    <!--Header-->
    <header>
        <div class="grid-container">
            <div class="navbar">
                <ul>
                    <li><a href="https://slimien.github.io/Min-digitale-arbeidsbok/index.html">Hjem</a></li>
                    <li><a href="https://slimien.github.io/Min-digitale-arbeidsbok/HTML/My%20work.html">Mitt arbeid</a></li>
                    <li><a href="https://slimien.github.io/Min-digitale-arbeidsbok/HTML/About%20me.html">Om meg</a></li>
                    <li><a href="https://www.youtube.com/watch?v=OCHO0GFerQc&t" target="blanc">Rick Roll</a></li>
                </ul>
            </div>
        </div>
    </header>

    <section>
        <div class="grid-container">

            <!--overskrift-->
            <div class="page-title">
                <h1>Database</h1>
            </div>
    </section>



</body>



    <h1>Legge inn kilder i databasen</h1>
    <!--includer insert skjemaet-->
    <?php
    include './Php Files/database.php';
    ?>


    <!--oversi9kt over databasen-->
    <h2>Mine databasekilder</h2>
    <?php
    include './Php Files/Oversikt.php';
    ?>


    <!--Testing-->
    <?php
    include '../testing purposes/alldatatest.php';
    ?>

</html>