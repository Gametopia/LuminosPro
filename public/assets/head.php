<?php
require_once __DIR__ . '/../../src/helpers.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="x-icon" href="assets/img/lmns_round.svg">

    <script type="text/javascript">
        var _iub = _iub || [];
        _iub.csConfiguration = {
            "siteId": 4281006,
            "cookiePolicyId": 57074910,
            "lang": "nl",
            "storage": {
                "useSiteId": true
            }
        };
    </script>
    <script type="text/javascript" src="https://cs.iubenda.com/autoblocking/4281006.js"></script>
    <script type="text/javascript" src="//cdn.iubenda.com/cs/gpp/stub.js"></script>
    <script type="text/javascript" src="//cdn.iubenda.com/cs/iubenda_cs.js" charset="UTF-8" async></script>
    <meta name="keywords"
        content="scooter tuning Rotterdam, scooter rotterdam, scooter tuning, scooter afstellen, scooter opvoeren, scooter performance, Luminos Rotterdam">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://luminos.co.nl<?= $_SERVER['REQUEST_URI']; ?>">
    <meta name="description"
        content="Luminos is hét scooter tuning bedrijf in Rotterdam. Meer vermogen, betere prestaties en een unieke look voor jouw scooter. Snel, betrouwbaar en professioneel.">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/storefront.css">
    <link href='https://fonts.googleapis.com/css?family=DM Sans' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/2481caf917.js" crossorigin="anonymous" defer></script>
</head>



<body>
    <?php if ($flash = getFlash()): ?>
        <div class="flash <?= $flash['type']; ?>">
            <?= $flash['message']; ?>
        </div>
    <?php endif; ?>
    <div itemscope itemtype="https://schema.org/AutomotiveBusiness">
        <meta itemprop="name" content="Luminos">
        <meta itemprop="address" content="Rotterdam, Netherlands">
        <meta itemprop="url" content="https://luminos.co.nl">
    </div>
    <script src="assets/js/menu.js"></script>
    <script src="assets/js/gallery.js" defer></script>