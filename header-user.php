<?php include('constant.php'); ?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library</title>
    <link
        rel="stylesheet"
        href="https://unpkg.com/swiper@8/swiper-bundle.min.css"
        />
    <!-- font awesome cdn link  @ https://cdnjs.com/ The iconic SVG, font, and CSS toolkit  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">

    <!--  css file link  -->
    <link rel="stylesheet" href="Home_CSS.css">
    <link rel="stylesheet" href="shopcss.css">

</head>

<body>

    <!-- header section starts  -->
    <header>

        <div id="menu-bar" class="fas fa-bars"></div>

        <a href="homepage.php" class="logo">BOOKSHOP </a> <!-- logo-->

        <nav class="navbar">
            <a href="Homepage.php">Home</a>
            <a href="Categories.php">Categories</a>
            <a href="book.php">Book</a>
            <a href="#footer">Contact</a>
        </nav>

        <div class="icons">
            <!-- show icon search, login, shopping cart-->
            <i class="fas fa-search" id="search-btn"></i>
        </div>

        <form action="book-search.php" class="search-bar-container">
            <input type="search" name="search" id="search-bar" placeholder="search here...">
            <label for="search-bar" class="fas fa-search"></label>
        </form>

    </header>
    <!-- header section ends -->

    