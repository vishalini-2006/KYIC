<?php
include 'include/config.php';
// $status = $_GET['msg'];
if(!isset($_SESSION['CMSadmin']))
{
  header("Location: index.php");
}

$Admin = $_SESSION['CMSadmin'];
//`adminid`, `adminname`, `username`, `password`SELECT * FROM `admin` WHERE 1
 		$SESS_Admin = mysqli_query($connect,"SELECT * from admin where adminid ='$Admin'") or die(mysqli_error());
        while($FETCH_session_Admin = mysqli_fetch_array($SESS_Admin)) {
		$Admin_admin_id = $FETCH_session_Admin['adminid'];
		$Admin_adminUsername = $FETCH_session_Admin['username'];
		$Admin_adminPassword = $FETCH_session_Admin['password'];

	$Admin_level = $FETCH_session_Admin['level'];
      }
	  
	//   $reg_id = $_GET['reg_id'];
	//   $reg_name = $_GET['reg_name'];

	//   $USER = mysqli_query($connect,"SELECT * from reg_user where reg_id ='$reg_id'") or die(mysqli_error());
	//   while($fetch_user = mysqli_fetch_array($USER)) {
	//   $user_reg_id = $fetch_user['reg_id'];
	//   $user_reg_name = $fetch_user['reg_name'];
	//   }


	  $site_title = "KYC Finserv";
/*************************************
      GET PAGENAME
*************************************/
function curPageName() {
 return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}

function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

$currentpage = curPageName();

$randno = md5(time());


//current page
if($currentpage == 'home.php')
{
	$home = 'active open';
	$activeid1= '<span class="selected"></span>';
}

//current page
if($currentpage == 'reg_users.php')
{
	$reg_users = 'active open';
	$reg_users1 = '<span class="selected"></span>';
}


// organic_menu
	else if($currentpage == 'organic_menu.php') {
	$organic_menu = ' active open';
	$buyer_menu_arrow_open = ' open';
	$buyer_menu_display = ' style="display: block;"';
}

// sub_menu

	else if($currentpage == 'sub_menu.php') {
	$sub_menu = ' active open';
	$buyer_menu_arrow_open = ' open';
	$buyer_menu_display = ' style="display: block;"';
}

// productlist
	else if($currentpage == 'productlist.php' || $currentpage == 'productAdd.php' || $currentpage == 'productEdit.php' || $currentpage == 'product_image.php') {
	$productlist = ' active open';
	$productlist_arrow_open = ' open';
	$productlist_display = ' style="display: block;"';
}

// setting
	else if($currentpage == 'setting.php') {
	$setting = ' active open';
}


// ordered_customer
	else if($currentpage == 'ordered_customer.php') {
	$ordered_customer = ' active open';
}



// pincode
	else if($currentpage == 'pincode_price.php') {
	$pincode_price = ' active open';
}


//========================================== website settings =====================================================//

// ********************* About Us ****************** //

	else if($currentpage == 'add_aboutus.php') {

	$add_aboutus = ' active open';

	$add_aboutus_arrow_open = ' open';

	$add_aboutus_display = ' style="display: block;"';

}


// ********************* Terms ****************** //

	else if($currentpage == 'add_terms.php') {

	$add_terms = ' active open';

	$add_terms_arrow_open = ' open';

	$add_terms_display = ' style="display: block;"';

}


// ********************* Privacy Policy ****************** //

	else if($currentpage == 'add_privacy.php') {

	$add_privacy = ' active open';

	$add_privacy_arrow_open = ' open';

	$add_privacy_display = ' style="display: block;"';

}


// ********************* Add Contact ****************** //

	else if($currentpage == 'contact_add.php') {

	$add_contact = ' active open';

	$add_contact_arrow_open = ' open';

	$add_contact_display = ' style="display: block;"';

}


// ********************* Social Media ****************** //

	else if($currentpage == 'socialmedia.php') {

	$socialmedia = ' active open';

	$socialmedia_arrow_open = ' open';

	$socialmedia_display = ' style="display: block;"';

}


// ********************* Add Blog ****************** //

	else if($currentpage == 'add_blog.php') {

	$add_blog = ' active open';

	$add_blog_arrow_open = ' open';

	$add_blog_display = ' style="display: block;"';

}

//**************** Slider**********************//

else if($currentpage == 'slider.php') {

	$add_slider = ' active open';

	$add_slider_arrow_open = ' open';

	$add_slider_display = ' style="display: block;"';

}

// // reg user `reg_id`, `reg_name`, `reg_mailid`, `reg_pin`, `reg_newpin`, `reg_phone`SELECT * FROM `reg_user` WHERE 1
function regusersDB($reg_id)
{
	 global $connect;
	$get_buyer = mysqli_query($connect,"SELECT * FROM `reg_user` where reg_id = '$reg_id'") or die(mysqli_error());
	while($get_buyer_menu = mysqli_fetch_array($get_buyer)) 
	{
	                return $get_buyer_menu['reg_phone'];                        
	}
}
function bankDB($bank_id)
{
	 global $connect;
	$get_buyer = mysqli_query($connect,"SELECT * FROM `bank_details` where s_no = '$bank_id'") or die(mysqli_error());
	while($get_buyer_menu = mysqli_fetch_array($get_buyer)) 
	{
	                return $get_buyer_menu['bank_name'];                        
	}
}

///`qrid`, `qrimage`, `qrdesc`SELECT * FROM `qrdetails` WHERE 1
function qrDB($qrid)
{
	 global $connect;
	$get_buyerqrid = mysqli_query($connect,"SELECT * FROM `qrdetails` where qrid = '$qrid'") or die(mysqli_error());
	while($get_buyerqrids = mysqli_fetch_array($get_buyerqrid)) 
	{
	                return $get_buyerqrids['qrdesc'];                        
	}
}

// // Select productDB Data base
// function productDB($product_id)
// {
// 	 global $connect;
// 	$get_product = mysqli_query($connect,"SELECT * FROM `product` where product_id = '$product_id'") or die(mysqli_error());
// 	while($get_product_details = mysqli_fetch_array($get_product)) 
// 	{
// 	                return $get_product_details['product_name'];                        
// 	}
// }

// function billingDB($billing_id)
// {
// 	 global $connect;
// 	$get_billing = mysqli_query($connect,"SELECT * FROM `billing_details` where billing_id = '$billing_id'") or die(mysqli_error());
// 	while($get_billing_details = mysqli_fetch_array($get_billing)) 
// 	{
// 	                return $get_billing_details['billing_name'];                        
// 	}
// }

// function registeredDB($registered_users_id)
// {
// 	 global $connect;
// 	$get_registered_users = mysqli_query($connect,"SELECT * FROM `registered_users` where registered_users_id = '$registered_users_id'") or die(mysqli_error());
// 	while($get_registered_users_details = mysqli_fetch_array($get_registered_users)) 
// 	{
// 	                return $get_registered_users_details['user_name'];                        
// 	}
// }

?>