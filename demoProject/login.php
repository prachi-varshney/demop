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

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="assets/img/icons/icon-48x48.png" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />

    <title>Sign In</title>

    <link href="assets/css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body style="background-image: url('assets/img/login_background.jpg');">
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">

                        <div class="text-center mt-4">
                            <p class="lead">
                                Sign in to your account to continue
                            </p>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-4">
                                    <div class="text-center m-4">
                                        <img src="assets/img/logo.png" alt="Charles Hall"
                                            class="img-fluid rounded-circle" width="200" height="200" />
                                    </div>
                                    <form id="loginFrom">
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input class="form-control form-control-lg" type="email" name="email"
                                                placeholder="Enter your email" maxlength="50" required />
                                        </div>
                                        <!-- <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input class="form-control form-control-lg" type="password" name="password" placeholder="Enter your password" maxlength="20" required />
                                            
                                            <input type="checkbox" onclick="showPassword()" class="show-password"> Show Password
                                           
                                        </div> -->


                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input class="form-control form-control-lg" type="password" name="password"
                                                placeholder="Enter your password" maxlength="20" required
                                                id="password" />
                                            <input type="checkbox" id="showPasswordCheckbox" onclick="showPassword()">
                                            <label for="showPasswordCheckbox">Show Password</label>
                                        </div>

                                        <div class="text-center mt-3">
                                            <button class="btn btn-sm btn-primary" type="button" onclick="Login()"> Sign
                                                in</button>
                                            <!-- <button type="submit" class="btn btn-lg btn-primary">Sign in</button> -->
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="assets/js/app.js">
    </script>
    <script>

        function formValidation() {
            $("#loginFrom").find('.error').remove();
            let isValid = true;
            $("#loginFrom").find(':input[required]').each(function () {
                if (!this.checkValidity()) {
                    $(this).after('<div class="error" style="color: red; font-size: 12px;">This field is required</div>');
                    isValid = false;
                }
            });

            return isValid;
        }

        function resetValidation() {
            $('#loginFrom').on('reset', function () {
                $(this).find('.error').remove();
            });
        }

        function Login() {
            if (!formValidation()) {
                return;
            }
            var formElem = document.getElementById('loginFrom');
            var formData = new FormData(formElem);
            formData.append('type', 'Login');
            $.ajax({
                type: 'POST',
                url: 'login_handler.php',
                data: formData,
                processData: false,
                contentType: false,
                async: false,
                dataType: "json",
                success: function (result) {
                    if (result.success == true || result.success == 'true') {
                        window.location.replace('dashboard.php');
                    } else {
                        alert(result.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.log("Error:", error);
                }
            });
        }


        function showPassword() {
    var x = document.getElementById("password");
    var checkbox = document.getElementById("showPasswordCheckbox");
    if (checkbox.checked) {
        x.type = "text";
        x.value = x.value;
    } else {
        x.type = "password";
    }
}

    </script>

</body>

</html>