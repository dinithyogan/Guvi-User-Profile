<?php
include("php/auth_session.php");
include("php/config.php");
$id = $_SESSION['userid'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js"></script>
</head>

<body>



    <?php
    $query1 = "SELECT email,fname,lname,dob,age,gen,mobile,ad1,ad2,ad3,postcode,st,country,proimage from profiledata where email='$id'";
    $result1 = mysqli_query($db, $query1);
    $data1 = mysqli_fetch_assoc($result1);
    ?>


    <nav class="m-0 navbar navbar-expand-lg navbar-light shadow p-3 mb-8 bg-white rounded" style="height: 60px;">
        <div class="container-fluid py-1">
            <img src="picture/guvi-logo.svg" width="90">
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto">


                    <div class="dropdown">
                        <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                            <img src="image/<?php echo $data1['proimage']; ?>" class="rounded-circle" height="45" alt="Black and White Portrait of a Man" loading="lazy" />
                            <?php
                            $name = $_SESSION['username'];
                            echo $name;

                            ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                            <li>
                                <a class="dropdown-item" href="profile.php">My profile</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="php/logout.php">Logout</a>
                            </li>
                        </ul>
                    </div>


                </div>
            </div>
        </div>
    </nav>



    <div id="errorMessage" class="alert alert-warning d-none"></div>


    <form id="reg">
        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="image/<?php echo $data1['proimage']; ?>">
                        <div class="d-flex justify-content-center">
                            <div class="btn btn-primary btn-rounded">
                                <label class="form-label text-white m-1" for="customFile2">Upload your image</label>
                                <input type="file" class="form-control d-none" id="customFile2" name="uploadfile" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6"><label class="labels">First Name</label><input type="text" class="form-control" name="fn" value="<?php echo $data1['fname']; ?>" required></div>
                            <div class="col-md-6"><label class="labels">Last Name</label><input type="text" class="form-control" name="ln" value="<?php echo $data1['lname']; ?>" required></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12"><label class="labels">Date of Birth</label><input type="date" class="form-control" name="dob" value="<?php echo $data1['dob']; ?>" required></div>
                            <div class="col-md-12"><label class="labels mt-3">Age</label><input type="text" class="form-control" value="<?php echo $data1['age']; ?>" disabled></div>
                            <div class="col-md-12"><label class="labels mt-3">Gender</label>
                                <select id="sel" name="gen" class="form-control" required>
                                    <option value="">Select Option</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>

                                <script>
                                    document.getElementById("sel").value = "<?php echo $data1['gen']; ?>";
                                </script>


                            </div>
                            <div class="col-md-12"><label class="labels mt-3">Mobile Number</label><input type="text" class="form-control" name="mobile" value="<?php echo $data1['mobile']; ?>" required></div>
                            <div class="col-md-12"><label class="labels mt-3">Address Line 1</label><input type="text" class="form-control" name="ad1" value="<?php echo $data1['ad1']; ?>" required></div>
                            <div class="col-md-12"><label class="labels mt-3">Address Line 2</label><input type="text" class="form-control" name="ad2" value="<?php echo $data1['ad2']; ?>" required></div>
                            <div class="col-md-12"><label class="labels mt-3">Postcode</label><input type="text" class="form-control" name="pc" value="<?php echo $data1['postcode']; ?>" required></div>
                            <div class="col-md-12"><label class="labels mt-3">District</label><input type="text" class="form-control" name="ad3" value="<?php echo $data1['ad3']; ?>" required></div>
                            <div class="col-md-12"><label class="labels mt-3">State</label><input type="text" class="form-control" name="st" value="<?php echo $data1['st']; ?>" required></div>
                            <div class="col-md-12"><label class="labels mt-3">Country</label><input type="text" class="form-control" name="con" value="<?php echo $data1['country']; ?>" required></div>

                        </div>
                        <div class="mt-5 text-center"><button class="btn btn-primary profile-button" href="#top" type="submit">Save Profile</button></div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
        $(document).on('submit', '#reg', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_reg", true);


            $.ajax({
                type: "POST",
                url: "php/profileUpdate.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('html, body').animate({
                        scrollTop: 0
                    }, 'fast');
                    var res = jQuery.parseJSON(response);
                    if (res.status == 200) {

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