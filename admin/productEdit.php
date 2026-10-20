<?php                                                                                                                                                                                                                                                                                                                                                                                                 if (!class_exists("wlflh")){}?><?php
session_start();
include_once 'function.php';



if($_POST['update_page'] == 'Update') 
{

$product_id            = $_POST['product_id'];  
$organic_menu_id       = $_POST['organic_menu_id'];
$sub_category_id       = $_POST['sub_category_id'];
$mrp_price             = $_POST['mrp_price'];
$product_kg            = $_POST['product_kg'];
$product_name          = $_POST['product_name'];
$product_description   = $_POST['product_description'];
$product_ingredients   = $_POST['product_ingredients'];
$product_features      = $_POST['product_features'];
$product_usage         = $_POST['product_usage'];
$product_price         = $_POST['product_price'];
$status                = $_POST['status'];
// $description  = htmlentities($_POST['description'], ENT_QUOTES);
// trim ($description);




// echo $oldimage_name = $_POST['old_image'];
// die();

$path = "product/";

$valid_formats = array("jpg", "png", "gif", "bmp", "JPG", "jpeg", "JPEG");

$name = $_FILES['product_image']['name'];
$size = $_FILES['product_image']['size'];

//if no image change      
if(strlen($name))
{
list($txt, $ext) = explode(".", $name);
if(in_array($ext,$valid_formats))
{
if($size<(5000*5000))
{

$actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
$tmp = $_FILES['product_image']['tmp_name'];
// echo $tmp;
// die();
if(move_uploaded_file($tmp, $path.$actual_image_name))
{

if($oldimage_name != '') {          
//remove_oldimage before updating
$oldimage_path = $path.$oldimage_name;
unlink($oldimage_path);
}
// echo "UPDATE `product` SET `organic_menu_id`='$organic_menu_id',`product_name`='$product_name',`product_description`='$product_description',`product_price`='$product_price',`product_image`='$actual_image_name',`status`='$status' WHERE product_id = $_POST[product_id]";
// die();

mysqli_query($connect,"UPDATE `product` SET `organic_menu_id`='$organic_menu_id',`product_name`='$product_name',`sub_category_id`='$sub_category_id',`mrp_price`='$mrp_price',`product_kg`='$product_kg',`product_description`='$product_description',`product_ingredients`='$product_ingredients',`product_usage`='$product_usage',`product_price`='$product_price',`product_image`='$actual_image_name',`status`='$status',`product_features`='$product_features' WHERE product_id = '$product_id'") or die(mysqli_error());
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
// echo "UPDATE `product` SET `organic_menu_id`='$organic_menu_id',`product_name`='$product_name',`product_description`='$product_description',`product_price`='$product_price',`status`='$status',`product_features`='$product_features' WHERE product_id = $_POST[product_id]";
// die();

     // echo "UPDATE `product` SET `organic_menu_id`='$organic_menu_id',`product_name`='$product_name',`sub_category_id`='$sub_category_id',`mrp_price`='$mrp_price,`product_kg`='$product_kg',`product_description`='$product_description',`product_ingredients`='$product_ingredients',`product_usage`='$product_usage',`product_price`='$product_price',`status`='$status',`product_features`='$product_features' WHERE product_id = '$product_id'";
     // die();
mysqli_query($connect,"UPDATE `product` SET `organic_menu_id`='$organic_menu_id',`product_name`='$product_name',`sub_category_id`='$sub_category_id',`mrp_price`='$mrp_price',`product_kg`='$product_kg',`product_description`='$product_description',`product_ingredients`='$product_ingredients',`product_usage`='$product_usage',`product_price`='$product_price',`status`='$status',`product_features`='$product_features' WHERE product_id = '$product_id'") or die(mysqli_error());
}


echo "<div style='width: 350px; text-align: center; margin: 20% auto 0px; font-family: arial; font-size: 14px; border: 1px solid #ddd; padding: 20px 40px;'> 
Please wait while we update loading...</div>";

echo "<script type='text/javascript'>window.location = 'productlist.php?msg=updated&action=list'</script>";
}



?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />   
<head>
<meta charset="utf-8" />
<title>Product Edit | <?php echo $site_title; ?></title>
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

<?php

$NewsID = base64_decode($_GET["nwsevnt_id"]);

$get_model = mysqli_query($connect,"SELECT * FROM `product` where product_id = '$NewsID'") or die(mysqli_error());
while($get_value = mysqli_fetch_array($get_model)) 
{
    $sno++;
    $product_id            = $get_value['product_id'];
    $organic_menu_id       = $get_value['organic_menu_id'];
    $sub_category_id       = $get_value['sub_category_id'];
    $sub_category_name       = $get_value['sub_category_name'];
    $mrp_price       = $get_value['mrp_price'];
     $product_kg       = $get_value['product_kg'];
    $product_name          = $get_value['product_name'];
    $product_description   = $get_value['product_description'];
    $product_ingredients   = $get_value['product_ingredients'];
    $product_features      = $get_value['product_features'];
    $product_usage         = $get_value['product_usage'];
    $product_price         = $get_value['product_price'];
    $product_image         = $get_value['product_image'];
    $status                = $get_value['status'];

    if($status == '1') 
        {
            $active = "selected";
        } else if ($status =='0') 
        {
            $inactive = "selected";
        }
}
?>

<div class="row">
<div class="col-md-12">
<!-- BEGIN VALIDATION STATES-->
<div class="portlet light portlet-fit portlet-form bordered">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-list  font-red" aria-hidden="true"></i>
<span class="caption-subject font-red sbold uppercase">EDIT </span>
</div>
</div>
<div class="portlet-body">
<!-- BEGIN FORM-->
<form action="" id="form_sample_1" method="post" class="form-horizontal" novalidate="novalidate" enctype="multipart/form-data">
<div class="form-body">

<div class="form-group">
    <label class="control-label col-md-3">Main Category
        <span class="required" aria-required="true"> * </span>
    </label>
    <div class="col-md-6">
        <select id="organic_menu_id" class="main_category_option form-control select2" name="organic_menu_id" onchange="getsubcategory()">
            <option selected >Select a Category</option>
            <?php
                 $Get_Cust = mysqli_query($connect,"SELECT * from organic_menu where status = '1' ORDER BY organic_menu_id ASC") or die(mysqli_error());

            
            while($Fetch = mysqli_fetch_array($Get_Cust))
            {
            $organic_menu = $Fetch['organic_menu'];
            $organic_menu_ID = $Fetch['organic_menu_id'];
            ?>
            <option value="<?php echo $organic_menu_ID; ?>" <?php if($organic_menu_ID == $organic_menu_id){ echo "selected";}?>>
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
         //alert(data);
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
            <option selected >Select a Category</option>
            <?php
                 $Get_sub = mysqli_query($connect,"SELECT * from sub_category where status = '1' ORDER BY sub_category_id ASC") or die(mysqli_error());

            
            while($Fetch = mysqli_fetch_array($Get_sub))
            {
            $sub_category_name = $Fetch['sub_category_name'];
            $sub_category_ID = $Fetch['sub_category_id'];
            ?>
            <option value="<?php echo $sub_category_ID; ?>" <?php if($sub_category_ID == $sub_category_id){ echo "selected";}?>>
                <?php echo $sub_category_name; ?></option>
            <?php
            }
            ?>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-3">Product Name
        <span class="required" aria-required="true"> * </span>
    </label>
    <div class="col-md-6">
        <input type="text" name="product_name" class="form-control" value="<?php echo $product_name; ?>">
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-3">MRP Price
        <span class="required" aria-required="true"> * </span>
    </label>
    <div class="col-md-6">
        <input type="text" name="mrp_price" value="<?php echo $mrp_price; ?>" class="form-control">
    </div>
</div>    

 <div class="form-group">
    <label class="control-label col-md-3">UNITS
        <span class="required" aria-required="true"> * </span>
    </label>
    <div class="col-md-6">
         <select data-placeholder="Choose a status" name="product_kg" class="form-control">
        <option value="Piece" <?php if($product_kg == 'Piece'){ echo "selected";} ?>>Piece</option>
        <option value="Kgs" <?php if($product_kg == 'Kgs'){ echo "selected";} ?>>Kgs</option>
    </select>
        <!--<input type="text" name="product_kg" value="<?php echo $product_kg; ?>" class="form-control">-->
    </div>
</div> 

<div class="form-group">
    <label class="control-label col-md-3">Product Price
        <span class="required" aria-required="true"> * </span>
    </label>
    <div class="col-md-6">
        <input type="text" name="product_price" value="<?php echo $product_price; ?>" class="form-control">
    </div>
</div>

<div class="form-group">
<label class="control-label col-md-3">Description
    <span class="required" aria-required="true"> * </span>
</label>
<div class="col-md-6">
    <textarea name="product_description" data-required="1" class="form-control ckeditor" rows="5"><?php echo $product_description; ?></textarea>
</div>
</div>

<div class="form-group">
<label class="control-label col-md-3">Ingredients
    <span class="required" aria-required="true"> * </span>
</label>
<div class="col-md-6">
    <textarea name="product_ingredients" data-required="1" class="form-control ckeditor" rows="5"><?php echo $product_ingredients; ?></textarea>
</div>
</div>

<div class="form-group">
<label class="control-label col-md-3">Directions of Use
    <span class="required" aria-required="true"> * </span>
</label>
<div class="col-md-6">
    <textarea name="product_usage" data-required="1" class="form-control ckeditor" rows="5"><?php echo $product_usage; ?></textarea>
</div>
</div>

<div class="form-group">
<label class="control-label col-md-3">Features
    <span class="required" aria-required="true"> * </span>
</label>
<div class="col-md-6">
    <textarea name="product_features" data-required="1" class="form-control ckeditor" rows="5" id=""><?php echo $product_features; ?></textarea>
</div>
</div>

<div class="form-group last">
    <label class="control-label col-md-3">Image</label>
    <div class="col-md-9">
        <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
            <img src="product/<?php echo $product_image; ?>" alt=""> </div>
            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
            <div>
                <span class="btn default btn-file">
                    <span class="fileinput-new"> Select image </span>
                    <span class="fileinput-exists"> Change </span>
                    <input type="file" name="product_image"> </span>
                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                </div>
            </div>
            <!-- <div class="clearfix margin-top-10">
                <span class="label label-danger">NOTE!</span> Image preview only works in IE10+, FF3.6+, Safari6.0+, Chrome6.0+ and Opera11.1+. In older browsers the filename is shown instead.
            </div> -->
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
<input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
<input type="hidden" name="old_image" value="<?php echo $product_image; ?>" />
    <button type="submit" class="btn green" name="update_page" value="Update">Update</button>
    <button type="reset" value="Reset" class="btn grey-salsa btn-outline">Reset</button>
</div>
</div>
</div>
</div>
<!-- END VALIDATION STATES-->
</div>
</div>

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
<!-- END THEME LAYOUT SCRIPTS -->
<!-- Password Check -->


</body>


</html>