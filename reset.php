<?php

session_start();
unset($_SESSION['wylosowaly']);
unset($_SESSION['nie_mozna_losowac']);
unset($_SESSION['do_losowania']);
unset($_SESSION['pozostale']);
unset($_SESSION['brak']);

header('Location: index.php');
