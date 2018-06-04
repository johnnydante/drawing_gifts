<?php

 session_start();

    $_SESSION['nowe_pozostale'] = [];

//Sprawdzenie, czy osoba losująca jest w tablicy osób uczestniczących w zabawie
    if(!in_array($_GET['imie'], $_SESSION['do_losowania'])) {
        $_SESSION['brak'] = 'Nie ma takiego imienia w bazie!';
        header('Location: index.php');
        exit();
    }
    unset($_SESSION['brak']);

//Budowanie tablicy osób, które już losowały
    if(isset($_SESSION['wylosowaly'])) {
        array_push($_SESSION['wylosowaly'], $_GET['imie']);
    } else {
        $_SESSION['wylosowaly'] = [];
        array_push($_SESSION['wylosowaly'], $_GET['imie']);
    }

//Budowanie tablicy osób, które można jeszcze wylosować
    if (isset($_SESSION['nie_mozna_losowac']))
        $_SESSION['pozostale'] = array_diff($_SESSION['osoby'], $_SESSION['nie_mozna_losowac']);
    else $_SESSION['pozostale'] = $_SESSION['osoby'];

    $losujace_pozostale = array_values(array_diff($_SESSION['osoby'], $_SESSION['wylosowaly']));

//Losowanie wykluczające osobę losującą
    $losowane = array_diff($_SESSION['pozostale'], [$_GET['imie']]);
    $do_losowania = array_values($losowane);
    $a = rand(0, (count($do_losowania)-1));
    $_SESSION['do_prezentu'] = $do_losowania[$a];

//Wykluczenie możliwości, w której ostatnia losująca osoba musiałaby losować ze zbioru, w któym pozostała tylko ona
    if(count($losujace_pozostale)==1 & $_SESSION['do_prezentu']==$do_losowania[0]) {
        $_SESSION['do_prezentu'] = $losujace_pozostale[0];
    }

//Budowanie tablicy osób, które zostały już wylosowane
    if(isset($_SESSION['nie_mozna_losowac'])) {
       array_push($_SESSION['nie_mozna_losowac'], $_SESSION['do_prezentu']);
    } else {
        $_SESSION['nie_mozna_losowac'] = [];
        array_push($_SESSION['nie_mozna_losowac'], $_SESSION['do_prezentu']);
    }

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
            padding-top: 100px;
            background-color: darkslategray;
            color: wheat;
        }

        h3 {
            margin-bottom: 30px;
        }
    </style>

</head>
<body>

<form action="index.php">
    <?php
    if(substr($_GET['imie'], -1)== 'a')
        echo $_GET['imie']."!<br>Osoba, którą wylosowałaś to:<b> ";
    else
        echo $_GET['imie']."!<br>Osoba, którą wylosowałeś to:<b> ";
        echo $_SESSION['do_prezentu']."</b><br><br>";

    ?>
    <input class="btn btn-warning" type="submit" value="Następna osoba">
</form>
</body>
</html>