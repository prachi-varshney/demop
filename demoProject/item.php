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
                            aria-selected="true" onclick="resetValidation()">List</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                            aria-selected="false" onclick="resetValidation()">Add Item</button>
                    </li>

                </ul>
                <input type="hidden" id="url" value="item_handler">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                        aria-labelledby="pills-home-tab">
                        <div class="card">

                            <div class="p-3 shadow mt-2" style="border:1px solid lightgray">
                                <form id="search">
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <input type="text" name="item_name" class="form-control form-control-sm"
                                                id="item_name" placeholder="Enter Item Name">
                                        </div>

                                        <div class="col-md-3">
                                            <!-- <button type="reset" class="btn btn btn-secondary me-2">Reset</button> -->
                                            <button type="reset" class="btn btn btn-secondary me-2" onclick="resetValidation()">Reset</button>
                                            <button type="button" class="btn btn btn-dark"
                                                onclick="loadTable('list')">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <table class="table mt-2 table-bordered">
                                <thead style="background-color: #f0f0f0">
                                    <tr>
                                        <th>Sno</th>
                                        <th>Id</th>
                                        <th>Item Name</th>
                                        <th>Item Description</th>
                                        <th>Price</th>
                                        <th>Image</th>
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
                                <h2 class="card-title mb-0">item Info.</h2>
                            </div>
                            <div class="card-body">
                                <form id="dataFrom" enctype="multipart/form-data">


                                    <input type="hidden" name="type" value="ADD_EDIT">


                                    <div class="row">
                                        <input type="hidden" class="" name="id" id="id" />
                                        <div class="mb-3 col-md-3">
                                            <label class="form-label">Item Name<span class="req-star" style="color: red;">*</span></label>
                                            <input type="text" class="form-control form-control-sm" name="item_name"
                                                id="item_name" required maxlength="50" />
                                        </div>

                                        <div class="mb-3 col-md-3">
                                            <label class="form-label">Item Price<span class="req-star" style="color: red;">*</span></label>
                                            <input type="number" class="form-control form-control-sm text-right"
                                                name="price" id="price" required maxlength="50" />
                                        </div>

                                        <div class="mb-3 col-md-3">
                                            <label class="form-label">Item Description<span
                                                    class="req-star" style="color: red;">*</span></label>
                                            <input type="text" class="form-control form-control-sm"
                                                name="item_description" id="item_description" required maxlength="50" />
                                        </div>


                                        <div class="mb-3 col-md-3">
                                            <label class="form-label">Item Image<span class="req-star" style="color: red;">*</span></label>
                                            <input type="file" class="form-control form-control-sm" name="item_image"
                                                id="item_image" =".jpg, .jpeg, .png, .gif" />
                                            <img id="imagePreview" src="" style="width: 50px; height: auto;">
                                            <button type="button" onclick="deleteImageSrc()" id="removeImage" style="display: none;">X</button>
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
            loadTable('list');
        });

    </script>


    <script src="assets/js/app.js"> </script>

</html>