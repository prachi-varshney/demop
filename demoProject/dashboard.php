<?php 
session_start();
if(!isset($_SESSION['name']) && !isset($_SESSION['email'])){
header("Location: login.php");
exit;


}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <title>Project</title>

    <link href="assets/css/app.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>
    <div class="wrapper">
        <!-- sidebar -->
        <?php include 'layouts/sidebar.php' ?>
        <!-- header -->
        <?php include 'layouts/header.php' ?>

        <main class="content">
            <div class="container-fluid p-0">

                <h1 class="h3"> Dashboard</h1>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Total User</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                        <i class="align-middle" data-feather="user"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">05</h1>
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Total Clients</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                        <i class="align-middle" data-feather="user-plus"></i> 
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">03</h1>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Total Items</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                        <i class="align-middle" data-feather="package"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">06</h1>
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Total Invoice</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                        <i class="align-middle" data-feather="credit-card"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">04</h1>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    </div>

    <script src="assets/js/app.js"></script>


</html>