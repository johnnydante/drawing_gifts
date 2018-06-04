<?php

session_start();
require_once 'tablica.php';


if(isset($_SESSION['wylosowaly']))
$_SESSION['do_losowania'] = array_diff($_SESSION['osoby'], $_SESSION['wylosowaly']);
else
    $_SESSION['do_losowania'] = $_SESSION['osoby'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Losowanie</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <style>

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 30px;
            background-color: darkslategray;
            color: wheat;
        }

        .formularz {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        p {
            text-align: center;
        }

        h3 {
            text-align: center;
        }
        .btn-danger {
            position: absolute;
            bottom: 5%;
            left: 5%;
        }
        .form-group {
            float: left;
        }
    </style>

</head>
<body>
    <div>
        <div class="osoby">
            <h3>Osoby, które jeszcze nie wylosowały:</h3>
            <p>
                <?php foreach ($_SESSION['do_losowania'] as $osoba) {
                    echo $osoba.'<br>';
                } ?>
            </p>
        </div>
        <div class="formularz">
            <form action="next.php" method="get">
                <h3> Wpisz swoje imię: </h3>
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Twoje imię..." name="imie">
                </div>
                <div class="form-group">
                    <input class="btn btn-success" type="submit" value="Przydziel osobę">
                </div>
            </form>

        </div>
        <p><?php if(isset($_SESSION['brak'])) echo $_SESSION['brak']; ?></p>

    </div>
    <form action="reset.php"><input class="btn btn-danger" type="submit" value="Resetuj losowanie"></form>
</body>
</html>