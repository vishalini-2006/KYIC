<?php

include 'config.php';

$registered_users_id = $_SESSION['registered_users_id'];

// if(!isset($_SESSION['registered_users_id']))
// {
//   header("Location: index.php");
// }

echo "SELECT * from register_user where reg_id ='$registered_users_id'";
$SESS_Admin = mysqli_query($connect, "SELECT * from register_user where reg_id ='$registered_users_id'") or die(mysqli_error());
while ($FETCH_session_Admin = mysqli_fetch_array($SESS_Admin))
{
    
    
$Admin_user_id = $FETCH_session_Admin['reg_id'];
$Admin_reg_name = $FETCH_session_Admin['reg_name'];
$Admin_reg_mobile = $FETCH_session_Admin['reg_mobile'];



}

?>