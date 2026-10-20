<?php
session_start();
include_once 'function.php';

// add Bank Details
if ($_POST['add'] == 'Create') {

$organic_menu_id       = $_POST['organic_menu_id'];
$sub_category_id       = $_POST['sub_category_id'];
$mrp_price             = $_POST['mrp_price'];
$product_kg             = $_POST['product_kg'];

$product_name          = $_POST['product_name'];
$product_description   = $_POST['product_description'];
$product_ingredients   = $_POST['product_ingredients'];
$product_features      = $_POST['product_features'];
$product_usage         = $_POST['product_usage'];
$product_price         = $_POST['product_price'];
$status                = $_POST['status'];

// $description  = htmlentities($_POST['description'], ENT_QUOTES);
// trim ($description);
$path = "product/";

$valid_formats = array("jpg", "png", "gif", "bmp", "JPG", "jpeg", "JPEG");

$name = $_FILES['product_image']['name'];
$size = $_FILES['product_image']['size'];

if(strlen($name))
{
list($txt, $ext) = explode(".", $name);
if(in_array($ext,$valid_formats))
{
if($size<(5000*5000))
{

$actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
$tmp = $_FILES['product_image']['tmp_name'];
//echo $tmp;
if(move_uploaded_file($tmp, $path.$actual_image_name))
{

mysqli_query($connect,"INSERT INTO `product`(`organic_menu_id`,`sub_category_id`,`mrp_price`,`product_kg`, `product_name`, `product_description`, `product_ingredients`, `product_usage`, `product_price`, `product_image`, `status`, `product_features`) VALUES ('$organic_menu_id','$sub_category_id','$mrp_price','$product_kg', '$product_name', '$product_description','$product_ingredients','$product_usage', '$product_price', '$actual_image_name', '$status', '$product_features')") or die(mysqli_error());

}
else {
$err[] =  "failed";
}
}
else {
$err[] = "Image file size max 1 MB";          
}
}
else {
$err[] =  "Invalid file format..";  
}
}
else{

mysqli_query($connect,"INSERT INTO `product`(`organic_menu_id`,`sub_category_id`,`mrp_price`,`product_kg`, `product_name`, `product_description`, `product_ingredients`, `product_usage`, `product_price`, `status`, `product_features`) VALUES ('$organic_menu_id','$sub_category_id','$mrp_price','$product_kg', '$product_name', '$product_description','$product_ingredients','$product_usage', '$product_price', '$status', '$product_features')") or die(mysqli_error());


}


echo "<div style='width: 350px; text-align: center; margin: 20% auto 0px; font-family: arial; font-size: 14px; border: 1px solid #ddd; padding: 20px 40px;'> 
Please wait while we update loading...</div>";

echo "<script type='text/javascript'>window.location = 'productlist.php?msg=added&action=list'</script>";
}




?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />   
<head>
<meta charset="utf-8" />
<title>Product Add | <?php echo $site_title; ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/font-awesome/font-awesome.min.css">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
<script src="//cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL STYLES -->
<link href="assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
<link href="assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
<!-- END THEME GLOBAL STYLES -->
<!-- BEGIN THEME LAYOUT STYLES -->
<link href="assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
<link href="assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
<link href="assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="assets/layouts/customer.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<style type="text/css">
.dt-buttons {
display: none;
}
</style>
<script type="text/javascript">
function delete_menu(idurl)
{
go_on = confirm("Are you sure ? ");
if(go_on)
{
document.location.href=idurl;
}
}
</script>
</head>
<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
<div class="page-wrapper">
<!-- BEGIN HEADER -->
<?php include("header.php");?>
<!-- END HEADER -->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<div class="page-container">
<!-- BEGIN SIDEBAR -->
<?php include("menu.php");?>

<!-- END SIDEBAR -->
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
<!-- BEGIN CONTENT BODY -->
<div class="page-content">

<!-- END THEME PANEL -->
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
<ul class="page-breadcrumb">
<li>
<a href="index.php">Home</a>
<i class="fa fa-circle"></i>
</li>
<li>
<span>Product Add</span>
</li>
</ul>
<div class="page-toolbar">
<div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
<i class="icon-calendar"></i>&nbsp;
<span class="thin uppercase hidden-xs"></span>&nbsp;
<i class="fa fa-angle-down"></i>
</div>
</div>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->

<div class="row">
<div class="col-md-12">
<!-- BEGIN VALIDATION STATES-->
<div class="portlet light portlet-fit portlet-form bordered">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-list  font-red" aria-hidden="true"></i>
<span class="caption-subject font-red sbold uppercase">ADD </span>
</div>
</div>
<div class="portlet-body">
<!-- BEGIN FORM-->
<form action="" id="form_sample_1" method="post" class="form-horizontal" novalidate="novalidate" enctype="multipart/form-data" onsubmit="return CheckFormData();">
<div class="form-body">

<div class="form-group">
<label class="control-label col-md-3">Main Category
<span class="required" aria-required="true"> * </span>
</label>
<div class="col-md-6">
<select id="organic_menu_id" class="main_category_option form-control select2" name="organic_menu_id" onchange="getsubcategory()">
<option selected value="0">Select a Category</option>
<?php
     $Get_Cust = mysqli_query($connect,"SELECT * from organic_menu where status = '1' ORDER BY organic_menu_id ASC") or die(mysqli_error());


while($Fetch = mysqli_fetch_array($Get_Cust))
{
$organic_menu = $Fetch['organic_menu'];
$organic_menu_id = $Fetch['organic_menu_id'];
?>
<option value="<?php echo $organic_menu_id; ?>" <?php if($organic_menu_ID == $organic_menu_id){ echo "selected";}?>>
    <?php echo $organic_menu; ?></option>
<?php
}
?>
</select>
</div>
</div>
<script type="text/javascript">
  function getsubcategory(){

    var organic_menu_id = document.getElementById('organic_menu_id').value;

    // alert(organic_menu_id);

    $.post("default/get_sub_category.php", 
        {
          organic_menu_id_val: organic_menu_id,
        },
        function(data) 
        {
        // alert(data);
          $("#sub_category_id").html(data);
        
        }
    );

  }
</script>
<div class="form-group">
<label class="control-label col-md-3">Sub Category
<span class="required" aria-required="true"> * </span>
</label>
<div class="col-md-6">
<select id="sub_category_id" class="main_category_option form-control select2" name="sub_category_id">
<option selected value="0">Select a Category</option>

</select>
</div>
</div>

<div class="form-group">
<label class="control-label col-md-3">Product Name
<span class="required" aria-required="true"> * </span>
</label>
<div class="col-md-6">
<input type="text" name="product_name" id="product_name" class="form-control">
</div>
</div>

<div class="form-group">
<label class="control-label col-md-3">MRP Price
<span class="required" aria-required="true"> * </span>
</label>
<div class="col-md-6">
<input type="text" name="mrp_price" id="mrp_price" class="form-control">
</div>
</div>

 <div class="form-group">
    <label class="control-label col-md-3">UNITS
        <span class="required" aria-required="true"> * </span>
    </label>
    <div class="col-md-6">
         <select data-placeholder="Choose a status" name="product_kg" class="form-control">
        <option value="Piece">Piece</option>
        <option value="Kgs">Kgs</option>
    </select>
        <!--<input type="text" name="product_kg" value="<?php echo $product_kg; ?>" class="form-control">-->
    </div>
</div> 

<div class="form-group">
<label class="control-label col-md-3">Product Price
<span class="required" aria-required="true"> * </span>
</label>
<div class="col-md-6">
<input type="text" name="product_price" id="product_price" class="form-control">
</div>
</div>



    

<div class="form-group">
<label class="control-label col-md-3">Description
<span class="required" aria-required="true"> * </span>
</label>
<div class="col-md-6">
<textarea name="product_description" data-required="1" class="form-control ckeditor" rows="5" id="product_description"></textarea>
</div>
</div>

<!-- <div class="form-group">
<label class="control-label col-md-3">Ingredients
<span class="required" aria-required="true"> * </span>
</label>
<div class="col-md-6">
<textarea name="product_ingredients" data-required="1" class="form-control ckeditor" rows="5" id=""></textarea>
</div>
</div>

<div class="form-group">
<label class="control-label col-md-3">Directions of Use
<span class="required" aria-required="true"> * </span>
</label>
<div class="col-md-6">
<textarea name="product_usage" data-required="1" class="form-control ckeditor" rows="5" id=""></textarea>
</div>
</div> -->

<div class="form-group">
<label class="control-label col-md-3">Features
<span class="required" aria-required="true"> * </span>
</label>
<div class="col-md-6">
<textarea name="product_features" data-required="1" class="form-control ckeditor" rows="5" id=""></textarea>
</div>
</div>

<div class="form-group last">
<label class="control-label col-md-3">Image</label>
<div class="col-md-9">
<div class="fileinput fileinput-new" data-provides="fileinput">
<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""> </div>
<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
<div>
    <span class="btn default btn-file">
        <span class="fileinput-new"> Select image </span>
        <span class="fileinput-exists"> Change </span>
        <input type="file" name="product_image" id="image"> </span>
        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
    </div>
</div>
<!-- <div class="clearfix margin-top-10">
    <span class="label label-danger">NOTE!</span> Image preview only works in IE10+, FF3.6+, Safari6.0+, Chrome6.0+ and Opera11.1+. In older browsers the filename is shown instead.
</div> -->
</div>
</div>
</div>

<div class="form-group">
<label class="control-label col-md-3">Status
<span class="required" aria-required="true"> * </span>
</label>
<div class="col-md-6">
<select data-placeholder="Choose a status" name="status" class="form-control">
<option value="1">Active</option>
<option value="0">In-Active</option>
</select>
</div>
</div>
</div>
<div class="form-actions">
<div class="row">
<div class="col-md-offset-3 col-md-9">
<button type="submit" class="btn green" name="add" value="Create">Submit</button>
<button type="reset" value="Reset" class="btn grey-salsa btn-outline">Reset</button>
</div>
</div>
</div>
</form>
<!-- END FORM-->
</div>
</div>
<!-- END VALIDATION STATES-->
</div>
</div>
>
<div class="clearfix"></div>

</div>
<!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->

<!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<?php include("footer.php");?>

<!-- END FOOTER -->
</div>
<!-- BEGIN QUICK NAV -->

<div class="quick-nav-overlay"></div>

<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="assets/pages/scripts/table-datatables-colreorder.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
<script src="assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
<script src="assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>


<!-- repeater -->
<script src="assets/global/plugins/jquery-repeater/jquery.repeater.js" type="text/javascript"></script>
<script src="assets/pages/scripts/form-repeater.min.js" type="text/javascript"></script>
<!-- End repeater -->

<!-- END THEME LAYOUT SCRIPTS -->
<!-- Password Check -->

<!-- <script language="javascript" type="text/javascript">

function CheckFormData()

{

var product_category  = document.getElementById("product_category");

var product_name  = document.getElementById("product_name");

var product_price  = document.getElementById("product_price");

var product_description  = document.getElementById("product_description");

var image  = document.getElementById("image");

if(product_category.value == '0')

{

alert('Please Choose Category.');

product_category.focus();

product_category.style.border = 'thin solid red';

return false;

}

if(product_name.value == '')

{

alert('Please complete all fields.');

product_name.focus();

product_name.style.border = 'thin solid red';

return false;

}

if(product_price.value == '')

{

alert('Please complete all fields.');

product_price.focus();

product_price.style.border = 'thin solid red';

return false;

}

if(product_description.value == '')

{

alert('Please complete all fields.');

product_description.focus();

product_description.style.border = 'thin solid red';

return false;

}


if(image.value == '')

{

alert('Please Select Image.');

image.focus();

image.style.border = 'thin solid red';

return false;

}



return true;

}

</script> -->

</body>


</html>