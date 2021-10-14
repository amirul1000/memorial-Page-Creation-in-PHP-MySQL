<?php
    header('Content-Type: text/html; charset=utf-8');
	session_start();
    if(isset($_SESSION['userid']) && !empty($_SESSION['userid'])){
        $memorial_link = 'create-memorial.php';
    }
    else{
        $memorial_link = 'create-user.php';
    }

    $username_name = $_SESSION['username'];
?>

<!doctype html>
<html dir="rtl" lang="en">

<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Homepage">
    <title>Memorial</title>
    <!-- OG Tags -->
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Homepage" />
    <meta property="og:description" content="Homepage" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="" />
    <meta name="twitter:creator" content="" />
    <meta name="twitter:title" content="">
    <meta name="twitter:description" content="">
    <meta name="twitter:image" content="">
    <!-- OG Tags end-->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="assets/css/calendar.min.css" />
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/responsive.css" rel="stylesheet">
</head>

<body class="rtl">
    <!-- header-start -->
    <header class="header" id="header">
        <div class="container">
            <nav class="navbar navbar-expand-lg custom-navbar" id="navigationMenu">
                <a class="navbar-brand" href="index.php">
                    <img src="./assets/images/logo.png" alt="logo" />
                </a>
                <!-- Toggler/collapsibe Button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigationMenu">
                    <span class="navbar-toggler-icon">
                        <span class="bar1"></span>
                        <span class="bar2"></span>
                        <span class="bar3"></span>
                    </span>
                </button>
                <!-- Navbar links -->
                <div class="collapse navbar-collapse navbar-menu" id="navigationMenu">
                    <ul class="navbar-nav navbar-left" id="navbar-right">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="how-it-work.php">How It Works</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $memorial_link;?>">Creating a commemoration</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">About</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right kenny-links">
                        <?php if(isset($username_name) && !empty($username_name)){?>
                            <li class="nav-item">
                                <a class="nav-link" href=""><?php echo $username_name;?></a>
                            </li>
                        <?php  } ?>
                        <li class="nav-item">
                            <?php 
                            if(!empty($_SESSION['username'])){?>
                                <a class="nav-link nav-btn" href="logout.php">Log Out</a>
                                <?php } else { ?>
                            <a class="nav-link nav-btn" href="login.php">Login</a>
                            <?php } ?>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <!-- header-end -->