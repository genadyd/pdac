<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon.ico">
    <link rel="stylesheet" href="/public/styles/main_styles.css">
    <link rel="stylesheet" href="<?php /** @var string $styles */
    echo $styles ?>">
    <title><?= /** @var string $title */
        $title?></title>
</head>
<body>
<header class="flex j-content-between">
 <div class="logo">pdactech</div>
 <nav class="menu flex j-content-around">

     <?php /** @var array $menu */
     foreach($menu as $element): ?>
         <div class="menu_element <?php /** @var string $uri */
         if($uri == $element['href'])echo 'current'?>">
             <a href="<?=$element['href']?>">
                 <?=$element['text']?></a>
         </div>

     <?php endforeach; ?>
 </nav>
</header>


