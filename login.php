 <?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'config.php';

if($_POST['register'] ==  'add')
{
    $reg_name    =    $_POST['reg_name'];
    $reg_mobile    =    $_POST['reg_mobile'];
    $reg_pass    =    $_POST['reg_pass'];
    
    
   $get_user_count = mysqli_query($connect, "SELECT * from register_user where reg_mobile ='$reg_mobile' ") or die(mysqli_error()); 
   $count = mysqli_num_rows($get_user_count);

    if($count == 0){
    mysqli_query($connect,"INSERT INTO `register_user`(`reg_name`, `reg_mobile`, `reg_pass`) VALUES ('$reg_name','$reg_mobile','$reg_pass')") or die(mysqli_error($connect));
    
     echo "<script type='text/javascript'>window.location = 'form.php'</script>";
    }
    else
    {
         echo "<script type='text/javascript'>window.location = 'form.php'></script>";
    }
}

?>