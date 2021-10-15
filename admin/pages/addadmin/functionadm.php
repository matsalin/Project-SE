<?php
session_start();
$con = mysqli_connect('localhost', 'root', '','datahome') or die("Error: " . mysqli_error($con));
$username = "";
$name   = "";
$errors = array();

if (isset($_POST['addadm'])) {
	adduser();
}

function adduser(){
	// call these variables with the global keyword to make them available in function
	global $con, $errors ;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$username    =  e($_POST['username']);
	$name       =  e($_POST['name']);
	$password_1  = e($_POST['password1']);
	$password_2  =  e($_POST['password2']);

	// form validation: ensure that the form is correctly filled
	if(trim($_POST["username"]) == ""){
		echo "<script type='text/javascript'>";
        echo "alert('Please input Username!');";
        echo "window.location = 'addad.php'; ";
        echo "</script>";
	}
	if(trim($_POST["password1"]) == "")
	{
		echo "<script type='text/javascript'>";
        echo "alert('Please input Password!');";
        echo "window.location = 'addad.php'; ";
        echo "</script>";
		
	}  
	if($_POST["password1"] != $_POST["password2"])
	{
		echo "<script type='text/javascript'>";
        echo "alert('Password not Match!');";
        echo "window.location = 'addad.php'; ";
        echo "</script>";
	}
	
	if(trim($_POST["name"]) == "")
	{
		echo "<script type='text/javascript'>";
        echo "alert(''Please input name!');";
        echo "window.location = 'addad.php'; ";
        echo "</script>";
	
	}  

	// register user if there are no errors in the form
	if (count($errors) == 0) {
        $password = $password_1;
		$query = "INSERT INTO user (name,username, password,status) VALUES( '$name', '$username', '$password','ADMIN')";
        $rs = mysqli_query($con, $query) or  (mysqli_error($con));
        if($rs){
		echo "<script type='text/javascript'>";
        echo "alert('บันทึกข้อมูลเรียบร้อยแล้ว');";
        echo "window.location = 'addad.php'; ";
        echo "</script>"; }
        else{
        echo "<script type='text/javascript'>";
        echo "alert('username มีผู้ใช้แล้ว');";
        echo "window.location = 'addad.php'; ";
        echo "</script>";
        }
			
		
	}
}
function e($val){
	global $con;
	return mysqli_real_escape_string($con, trim($val));
}



?>