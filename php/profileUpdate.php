<?php 
include("config.php");
session_start();
$id=$_SESSION['userid'];

if(isset($_POST['save_reg']))
{
    $fn = mysqli_real_escape_string($db, $_POST['fn']);
    $ln = mysqli_real_escape_string($db, $_POST['ln']);
    $dob = mysqli_real_escape_string($db, $_POST['dob']);
    $gen = mysqli_real_escape_string($db, $_POST['gen']);
    $mobile = mysqli_real_escape_string($db, $_POST['mobile']);
    $ad1 = mysqli_real_escape_string($db, $_POST['ad1']);
    $ad2 = mysqli_real_escape_string($db, $_POST['ad2']);
    $ad3 = mysqli_real_escape_string($db, $_POST['ad3']);
	$pc = mysqli_real_escape_string($db, $_POST['pc']);
    $st = mysqli_real_escape_string($db, $_POST['st']);
    $con = mysqli_real_escape_string($db, $_POST['con']);

    $today = date("Y-m-d");
    $diff = date_diff(date_create($dob), date_create($today));
    $age= $diff->format('%y');
    
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "../image/" . $filename;
	
    if($filename!=NULL)
    {
        $query1 = "UPDATE guvi.profiledata SET proimage='$filename' WHERE email = '$id'";
        $query1_run = mysqli_query($db, $query1);
        move_uploaded_file($tempname, $folder);
    }
    
    $query = "UPDATE guvi.profiledata 
    SET 
        fname = '$fn',
        lname='$ln',
        dob='$dob',
        age='$age',
        gen='$gen',
        mobile='$mobile',
        ad1='$ad1',
        ad2='$ad2',
        ad3='$ad3',
        postcode='$pc',
        st='$st',
        country='$con'
    WHERE
        email = '$id'";

    $query_run = mysqli_query($db, $query);

       if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Details Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Details Not Updated'
        ];
        echo json_encode($res);
        return;
    }
	
}
?>
