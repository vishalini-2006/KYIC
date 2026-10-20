<?php

// error_reporting(E_ALL ^ E_NOTICE);
// error_reporting(E_ERROR | E_PARSE);

//---> Connect to DB --->
$servername = "localhost";
$username = "root";
$password = "";
$database = "kycfinserv_dbnew";

// Create connection
$connect = mysqli_connect($servername, $username, $password, $database);


// if (!$connect) {
//     die('Connect Error : (' . mysqli_connect_errno() . ')<hr/>'. mysqli_connect_error());
// }

// function EncodeURL($url)
// {
// $new = strtolower(ereg_replace(' ','_',$url));
// return($new);
// }

// function DecodeURL($url)
// {
// $new = ucwords(ereg_replace('_',' ',$url));
// return($new);
// }

/*************************************
			        Alert
*************************************/

// function pageStatus($status_type)
// {
//   if($status_type == 'added')  {  
//   echo '<div class="alert alert-success"><button data-dismiss="alert" class="close"></button><strong>Record created succesfully</strong>   </div>'; 
//   }
//   else if($status_type == 'updated')  {
//   echo '<div class="alert alert-success"><button data-dismiss="alert" class="close"></button><strong>Record Updated succesfully</strong></div>';
//   } 
//   else if($status_type == 'deleted')  {
//   echo '<div class="alert alert-danger"><button data-dismiss="alert" class="close"></button><strong>Record removed succesfully</strong></div>';
//   }
//   else if($status_type == 'log_out')  {
//     echo '<div class="alert alert-success"><button data-dismiss="alert" class="close"></button><strong>Logged out successfully.  Thankyou for using me:)</strong></div>';
//   }else if($status_type == 'loggedIN')  {
//     echo '<div class="alert alert-success"><button data-dismiss="alert" class="close"></button><strong>Welcome admin.  Check what you got today.</strong></div>';
//   }
// }

// //page error
// function errorStatus($edit_type)
// {
//   if(!empty($edit_type))  { 
//   echo '<div class="alert alert-danger"><button data-dismiss="alert" class="close"></button><strong>';
//   foreach ($edit_type as $e) { echo "$e <br>"; }  
//   echo '</strong></div>';
//   }
// }


// date_default_timezone_set("Asia/Kolkatta");
// echo date_default_timezone_get();
// echo date('H:i:s');
?>
<?php
date_default_timezone_set('Asia/Kolkata');
$currentTime = date( 'h:i:s A', time () );
// echo $currentTime;
?>
