<?php
include("config.php");
if (isset($_POST['save_reg'])) {
    $uname = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $pass = mysqli_real_escape_string($db, $_POST['password']);

    if ($uname == NULL || $email == NULL || $pass == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }
    $sql = "SELECT * FROM guvi.user WHERE email = '$email'";
    $result = mysqli_query($db, $sql);
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        $res = [
            'status' => 500,
            'message' => 'user exists'
        ];
        echo json_encode($res);
        return;
    }
    $query = "INSERT INTO guvi.user (username,email,pass) VALUES('$uname','$email','$pass')";
    $query_run = mysqli_query($db, $query);
    $pro = "INSERT INTO guvi.profiledata (email) VALUES('$email')";
    $pro_run = mysqli_query($db, $pro);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Registered Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}
?>