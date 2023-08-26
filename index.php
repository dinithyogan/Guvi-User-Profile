<?php
include("php/config.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form 
    session_start();
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    $sql = "SELECT * FROM user WHERE email = '$email' and pass = '$password'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $count = mysqli_num_rows($result);

    // If result matched $myusername and $mypassword, table row must be 1 row

    if ($count == 1) {
        $query1 = "SELECT username FROM user where email='$email'";
        $result1 = mysqli_query($db, $query1);
        $data1 = mysqli_fetch_assoc($result1);
        $_SESSION['userid'] = $email;
        $_SESSION['username'] = $data1['username'];
        echo "<script>window.location.href='profile.php';</script>";
    } else {
        echo "<script>alert('Your Login Name or Password is invalid');window.location.href='index.php';</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guvi</title>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />

    <link href="css/login-register.css" rel="stylesheet" />
    <script src="js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="js/login-register.js" type="text/javascript"></script>

</head>

<body>


    <nav class="m-0 navbar navbar-expand-lg navbar-light shadow p-3 mb-8 bg-white rounded" style="height: 60px;">
        <div class="container-fluid py-1">
            <img src="picture/guvi-logo.svg" width="90">
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto">
                    <a class="nav-item nav-link fw-bold" data-toggle="modal" href="#">Home</a>
                    <a class="nav-item nav-link fw-bold" data-toggle="modal" href="#">Courses</a>
                    <a class="nav-item nav-link fw-bold" data-toggle="modal" href="#">LIVE Classes</a>
                    <a class="nav-item nav-link fw-bold" data-toggle="modal" href="#">Practice</a>
                    <a class="nav-item nav-link fw-bold" data-toggle="modal" href="#">Resources</a>
                    <a class="nav-item nav-link fw-bold" data-toggle="modal" href="#">Our Solutions</a>&nbsp;&nbsp;
                    <a class="nav-item nav-link fw-bold" data-toggle="modal" href="javascript:void(0)" onclick="openLoginModal();">Login</a>&nbsp;
                    <a class="nav-item nav-link rounded text-white px-3 fw-bold" data-toggle="modal" href="javascript:void(0)" onclick="openRegisterModal();" style="background-color: #0dba4b;">Sign up</a>
                </div>
            </div>
        </div>
    </nav>

    <div id="errorMessage" class="alert alert-warning d-none"></div>
    <div class="modal fade login" id="loginModal">
        <div class="modal-dialog login animated ">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="box">
                        <div class="content">
                            <div class="error"></div>
                            <div class="form loginBox">
                                <form method="POST">
                                    <input id="email" class="form-control rounded-pill" type="text" placeholder="Email" name="email">
                                    <input id="password" class="form-control rounded-pill" type="password" placeholder="Password" name="password">
                                    <input class="btn btn-default btn-login rounded-pill" type="submit" value="Login">
                                </form>
                            </div>
                            <div class="box">
                                <div class="content registerBox" style="display:none;">
                                    <div class="form">
                                        <form html="{:multipart=>true}" data-remote="true" id="reg">
                                            <input id="username" class="form-control rounded-pill" type="text" placeholder="Username" name="username">
                                            <input id="email" class="form-control rounded-pill" type="text" placeholder="Email" name="email">
                                            <input id="password" class="form-control rounded-pill" type="password" placeholder="Password" name="password">
                                            <input class="btn btn-default btn-register rounded-pill" type="submit" value="Sign up">
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="division">
                                <div class="line l"></div>
                                <span>or</span>
                                <div class="line r"></div>
                            </div>

                            <div class="container text-center ">
                                <a id="google-button" class="inline_block text-decoration-none rounded-pill bg-white border border-success px-5 py-2">
                                    <i class="icon-google float-left "></i> Sign-up with Google
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="forgot login-footer">
                        <span>Don’t have an account?
                            <a href="javascript: showRegisterForm();" class="text-decoration-none">Sign up</a></span>
                    </div>
                    <div class="forgot register-footer" style="display:none">
                        <span>Already registered User?</span>
                        <a href="javascript: showLoginForm();" class="text-decoration-none">Log in</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
        $(document).on('submit', '#reg', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_reg", true);


            $.ajax({
                type: "POST",
                url: "php/insert.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 422) {
                        $('#errorMessage').removeClass('d-none');
                        $('#errorMessage').text(res.message);

                    } else if (res.status == 200) {

                        $('#errorMessage').addClass('d-none');
                        $('#reg')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#user').load(location.href + " #user");

                    } else if (res.status == 500) {
                        $('#errorMessage').addClass('d-none');
                        $('#reg')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });
    </script>


</body>

</html>