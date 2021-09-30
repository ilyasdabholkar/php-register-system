<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Registration system</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">App</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php 
                    if(!isset($_SESSION['userId'])){ ?>
                <li class="nav-item active">
                    <a class="nav-link" href="http://localhost/Registration-system/register.php">Register User </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/Registration-system/login.php">Login</a>
                </li>
                <?php } ?>
                <?php 
                    if(isset($_SESSION['userId'])){ ?>
                        <li class="nav-item">
                            <a class="nav-link" href="myprofile.php">My Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    <?php } ?>
            </ul>
        </div>
    </nav>
