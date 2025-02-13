<?php
session_start();
if (!isset($_SESSION['name']) && !isset($_SESSION['email'])) {
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

                <ul class="nav nav-pills mb-0" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                            aria-selected="true">All Invoice</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                            aria-selected="false">Add Invoice</button>
                    </li>

                </ul>
                <input type="hidden" id="url" value="invoice_handler">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                        aria-labelledby="pills-home-tab">
                        <div class="card">

                            <div class="p-3 shadow mt-2" style="border:1px solid lightgray">
                                <form id="search">
                                    <div class="row">
                                    <div class="col-md-2">
                                            <input type="text" name="invoice_no." class="form-control form-control-sm"
                                                id="invoice_no." placeholder="Invoice No.">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="date" name="invoice_date" class="form-control form-control-sm"
                                                id="invoice_date" placeholder="Invoice Date">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="name" class="form-control form-control-sm"
                                                id="name" placeholder="Client Name">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="email" class="form-control form-control-sm"
                                                id="email" placeholder="Enter Email">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="phone" class="form-control form-control-sm"
                                                id="phone" placeholder="Enter Phone No">
                                        </div>


                                        <div class="col-md-2">
                                            <button type="reset" class="btn btn btn-secondary me-2">Reset</button>

                                            <button type="button" class="btn btn btn-dark"
                                                onclick="loadTable('list')">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <table class="table table-hover mt-2">
                                <thead style="background-color: #f0f0f0">
                                    <tr>
                                        <th>Sno</th>
                                        <th>Invoice Id</th>
                                        <th>Invoice no.</th>
                                        <th>Invoice date</th>
                                        <th>Client Name</th>
                                        <th>Address</th>
                                        <th>Client Email</th>
                                        <th>Client Phone</th>
                                        <th>Total</th>
                                        <th>PDF</th>
                                        <th>Mail</th>
                                        <th align="center">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table_record">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="card">
                            <div class="card-header mb-0 pb-1">
                                <h2 class="card-title mb-0">User Info.</h2>
                            </div>
                            <div class="card-body">
                                <form id="dataFrom" enctype="multipart/form-data">


                                    <input type="hidden" name="type" value="ADD_EDIT">


                                    <div class="row">
                                        <input type="hidden" class="" name="id" id="id" />
                                        <div class="mb-3 col-md-2">
                                            <label class="form-label">Invoice no. <span class="req-star">*</span></label>
                                            <input type="text" class="form-control form-control-sm" name="invoice_no."
                                                id="invoice_no." required maxlength="50" />
                                        </div>
                                        <div class="mb-3 col-md-2">
                                            <label class="form-label">Invoice Date <span class="req-star">*</span></label>
                                            <input type="date" class="form-control form-control-sm" name="invoice_date."
                                                id="invoice_date" required maxlength="50" />
                                        </div>
                                        <div class="mb-3 col-md-2">
                                            <label class="form-label">Client Name <span class="req-star">*</span></label>
                                            <input type="text" class="form-control form-control-sm" name="name"
                                                id="name" required maxlength="50" />
                                        </div>
                                        <div class="mb-3 col-md-2">
                                            <label class="form-label">Address <span class="req-star">*</span></label>
                                            <input type="text" class="form-control form-control-sm" name="address"
                                                id="address" required maxlength="50" />
                                        </div>

                                        <div class="mb-3 col-md-2">
                                            <label class="form-label">Client Email <span class="req-star">*</span></label>
                                            <input type="text" class="form-control form-control-sm" name="email"
                                                id="email" required maxlength="50" />
                                        </div>

                                        <div class="mb-3 col-md-2">
                                            <label class="form-label">Phone No <span class="req-star">*</span></label>
                                            <input type="text" class="form-control form-control-sm" name="phone"
                                                id="phone" required maxlength="10" />
                                        </div>

                                    </div>

                                    <div class="row mt-2 float-end">
                                        <div class="col-md-12 ">
                                            <button type="reset" class="btn btn btn-secondary me-2"
                                                onclick="resetValidation()">Reset</button>

                                            <button type="button" class="btn btn btn-dark"
                                                onclick="addUpdate('ADD_EDIT')">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </main>
    </div>
    </div>

    <script src="assets/js/script.js">

    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
        </script>

    <script>
        $(document).ready(function () {
            // alert()
            loadTable('list');
        });

    </script>

    <script src="assets/js/app.js"> </script>




</html>