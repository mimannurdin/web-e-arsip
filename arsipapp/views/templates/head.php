<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title;
    if ($page != 'home') {
        echo ' | E-Arsip';
    }
    ?></title>

    <link rel="stylesheet" href="/assets/css/style.min.css">
    <link rel="stylesheet" href="/assets/css/slider.min.css">

    <script src="/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/assets/js/slider.js"></script>
    <script src="/assets/fonts/fontawesome/js/all.min.js"></script>
    <script src="/assets/js/script.js"></script>
    <!-- <link rel="stylesheet" href="/assets/fonts/fontawesome/css/all.min.css"> -->

    <?php
    if ($page != 'home' && $page != 'masuk' && $page != 'daftar') :
    ?>
        <script src="/assets/js/sidenav-control.js"></script>
        <link rel="stylesheet" href="/assets/css/custombox.min.css">

        <link rel="stylesheet" href="/assets/datatables/datatables.min.css">
        <script src="/assets/datatables/datatables.min.js"></script>
    <?php
    endif;
    ?>
</head>
<body>
    
