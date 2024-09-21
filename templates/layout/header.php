<?php

if (defined('_INCODE') != 1) {
    die('Access Denied');
}
// autoRemoveTokenLogin();

// saveActivity();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo !empty($data['pageTitle']) ? $data['pageTitle'] : 'Unicode'; ?></title>
    <link rel="stylesheet" type="text/css" href="style.css?ver=<?php echo time(); ?>">

    <link rel="stylesheet" href="module/users/style.css?ver=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <style>
        body {
            margin: 20px;
        }

        .navbar {
            font-size: 20px;
            color: black;
            /* font-weight: bold; */
        }

        .menu-bar {
            position: relative;
            left: 400px;
        }

        .nav-item {
            margin-left: 20px;
        }

        .btn-login {
            width: 100px;
            height: 50px;
            background-color: white;
            border-radius: 7px;
            border: 2px solid black;

            padding: 10px;
        }

        .btn-login:hover {
            background-color: black;
            color: white;
        }

        .btn-signin {
            margin-left: 20px;
            width: 100px;
            height: 50px;
            background-color: green;
            color: white;
            border-radius: 7px;
            border: 2px solid black;

            padding: 10px;

        }

.btn-auth{
    position: relative;
    right: 100px;
}


    </style>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light tool-bar">
        <img src="https://smed.vn/Template/image/logo/logo.png">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse menu-bar" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link " href="#">Home </span></a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Service
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">News</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                <!-- <li class="nav-item dropdown profile">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Hi, Trang
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Profile</a>
                        <a class="dropdown-item" href='?module=auth&action=logout&loginToken=' .$loginToken>Log out</a>
                        <div class="dropdown-divider"></div>

                    </div>
                </li> -->
            </ul>
            <!-- <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form> -->
        </div>
        <div class="btn-auth">
            <a href="?module=auth&action=logout" class="btn btn-login">Log out</a>
            <a href="?module=auth&action=register" class="btn btn-signin">Sign in</a>
        </div>
    </nav>