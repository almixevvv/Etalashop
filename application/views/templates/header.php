<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="title" content="ETALAshop Official Site." />
    <meta name="description" content="ETALAshop Official Site International" />

    <!-- Technical specification provided with story GUC-433 -->
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta property="og:title" content="ETALAshop Official Site." />
    <meta property="og:description" content="ETALAshop Official Site International" />
    <meta property="og:url" content="etalashop.com" />

    <?php if (isset($productName)) { ?>
        <title><?= $productName; ?> | ETALAshop Official Site</title>
    <?php } else { ?>
        <title><?= $sectionName; ?> | ETALAshop Official Site</title>
    <?php } ?>

    <link rel="shortcut icon" href="<?= base_url('assets/images/logo_big.png'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/bootstrap-4/css/bootstrap.min.css'); ?>">

    <!-- INCUBE STYLESHEET LOADING -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/incube-assets/incube.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/incube-assets/incube-breakpoint.css'); ?>">

    <!-- FONT AWESOME 5 LOADING -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/font-awesome-5/css/all.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/font-awesome-5/css/brands.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/font-awesome-5/css/fontawesome.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/font-awesome-5/css/regular.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/font-awesome-5/css/solid.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/font-awesome-5/css/v4-shims.min.css'); ?>">

    <!-- SWEETALERT 2 LOADING -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/sweet-alert/sweetalert2.min.css'); ?>">

    <!-- WHITE SPACE DEBUG CSS -->
    <!-- <link rel="stylesheet" type="text/css" href="<?= base_url('assets/incube-assets/whitespace-debug.css'); ?>"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- <script src="<?php //echo base_url('assets/bootstrap-4/js/bootstrap.js'); 
                        ?>"></script> -->


    <!-- Bootstrap Requirement -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script src="<?= base_url('assets/incube-assets/function.js?version=' . filemtime('./assets/incube-assets/function.js')); ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/sweet-alert/sweetalert2.all.min.js'); ?>" type="text/javascript"></script>
</head>

<body>