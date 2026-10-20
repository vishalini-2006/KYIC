<?php
session_start();
include_once 'function.php';

//

//SELECT * FROM `giftcode` WHERE `giftcodeid`, `giftcode`, `status`, `amount`

if ($_GET['action'] == 'delete') {
    
    $id  = $_GET['nwsevnt_id'];

//`giftcodeid`, `giftcode`, `status`, `amount`SELECT * FROM `giftcode` WHERE 1

    $sql = "DELETE FROM giftcode WHERE giftcodeid = $id;";
    $query = mysqli_query($connect,$sql) or die("There was a problem while deleting: " . mysqli_error());
    
    echo "<div style='width: 350px; text-align: center; margin: 20% auto 0px; font-family: arial; font-size: 14px; border: 1px solid #ddd; padding: 20px 40px;'>Please wait while we update the record loading...</div>";
    
    if ($query) {


        echo "<script type='text/javascript'>window.location = 'giftcode.php?msg=deleted&action=list'</script>";
    }
    
}

// Edit
// add Details
if ($_POST['status'] == 'submit') {
// $trans_date = date('Y-m-d');

$giftcode      = $_POST['giftcode'];
$amount = $_POST['amount'];
$status = $_POST['status'];

//`giftcodeid`, `giftcode`, `status`, `amount`SELECT * FROM `giftcode` WHERE 1
mysqli_query($connect,"UPDATE `giftcode` SET `giftcode`='$giftcode' WHERE giftcodeid = '$giftcodeid'") or die(mysqli_error());


echo "<div style='width: 350px; text-align: center; margin: 20% auto 0px; font-family: arial; font-size: 14px; border: 1px solid #ddd; padding: 20px 40px;'> 
        Please wait while we update loading...</div>";
    
    echo "<script type='text/javascript'>window.location = 'giftcode.php?msg=added&action=list'</script>";
}

if ($_POST['submit'] == 'submit') {

//`giftcodeid`, `giftcode`, `status`, `amount`SELECT * FROM `giftcode` WHERE 1
$newsid = $_POST['giftcodeid'];

  $status     = $_POST['status'];
// echo "UPDATE giftcode SET `status` = '$status' where giftcodeid = '$newsid'";
mysqli_query($connect,"UPDATE giftcode SET `status` = '$status' where giftcodeid = '$newsid'") or die(mysqli_error());
echo "<div style='width: 350px; text-align: center; margin: 20% auto 0px; font-family: arial; font-size: 14px; border: 1px solid #ddd; padding: 20px 40px;'> 
Please wait while we update loading...</div>";
echo "<script type='text/javascript'>window.location = 'giftcode.php?msg=updated&action=list'</script>";
}

// add Details
if ($_POST['add'] == 'Create') {
    


    $giftcode   = $_POST['giftcode'];
     $amount   = $_POST['amount'];
     $nooftimes = $_POST['nooftimes']; 
     
     if($nooftimes == '1'){
         
            mysqli_query($connect,"INSERT into giftcode (`giftcode`,`status`,`amount`) values ('$giftcode','0','$amount')") or die(mysqli_error($connect));
     }else{
     
// $target = $amount;
// $n = $nooftimes;

// while ($n) {
//     if (1 < $n--) {
//         $addend = rand(1, $target - ($n - 1));
//         $target -= $addend;
//         $addends[] = $addend;
//     } else {
        
//         $addends[] = $target;
//     }
// }
$arr = array();
$count = $nooftimes;    
$total = $amount;

for ($i = 0; $i < $count; $i++)
{
    $arr[] = 0;
}

for ($j = 0; $j < $total; $j++)
{
    $arr[rand(1,$total) % $count]++;
}

   $i = 1;
foreach ($arr as $result) {
    // echo $result;
//   echo "INSERT into giftcode (`giftcode`,`status`,`amount`) values ('$giftcode','0','$result')";
  mysqli_query($connect,"INSERT into giftcode (`giftcode`,`status`,`amount`) values ('$giftcode','0','$result')") or die(mysqli_error($connect));
   $i++;
}
// exit();
}

    echo "<div style='width: 350px; text-align: center; margin: 20% auto 0px; font-family: arial; font-size: 14px; border: 1px solid #ddd; padding: 20px 40px;'> 
        Please wait while we update loading...</div>";
    
    echo "<script type='text/javascript'>window.location = 'giftcode.php?msg=added&action=list'</script>";

}
?>



<!DOCTYPE html>
<html lang="en">
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />   
  <head>
    <meta charset="utf-8" />
    <title>Giftcode List | 
      <?php echo $site_title; ?>
    </title>
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
    <script src="//cdn.ckeditor.com/4.5.7/standard/ckeditor.js">
    </script>
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
      <div class="clearfix"> 
      </div>
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
                  <a href="index.php">Home
                  </a>
                  <i class="fa fa-circle">
                  </i>
                </li>
                <li>
                  <span>Giftcode List
                  </span>
                </li>
              </ul>
              <div class="page-toolbar">
                <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
                  <i class="icon-calendar">
                  </i>&nbsp;
                  <span class="thin uppercase hidden-xs">
                  </span>&nbsp;
                  <i class="fa fa-angle-down">
                  </i>
                </div>
              </div>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <br>
            
            
            <?php
      if(isset($_GET['action']) =='' || $_GET['action'] == 'list') {
         
                   
            ?>
            <div class="row">
              <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box red">
                  <div class="portlet-title">
                    <div class="caption">
                      <i class="fa fa-globe">
                      </i>Gifcode List
                    </div>
                    <div class="actions">
                                                           <a href="giftcode.php?action=add" class="btn btn-default btn-sm">
<i class="fa fa-plus"></i> Add </a>
                    </div>
                  </div>
                  <div class="portlet-body">
                    <?php pageStatus($status); ?>
                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                      <thead>
                        <tr class="">
                          <th> S.NO 
                          </th>
                          <th> code
                          </th>
                          <th> Amount
                          </th>
                      
                         
                        </tr>
                      </thead>
                      <tbody>
                        <?php
$sno =0;
//`giftcodeid`, `giftcode`, `status`, `amount`SELECT * FROM `giftcode` WHERE 1

$get_customer = mysqli_query($connect,"SELECT * FROM giftcode where status = '0'") or die(mysqli_error());
while($get_value = mysqli_fetch_array($get_customer)) 
{
$sno++;    
$giftcodeid = $get_value['giftcodeid'];    
$giftcode=$get_value['giftcode']; 
$status=$get_value['status']; 
$amount=$get_value['amount']; 
?>
                        <tr>
                          <td>
                            <?php echo $sno;?> 
                          </td>
                          <td>
                            <?php echo $giftcode;?>
                          </td>
                           <td>
                            <?php echo $amount;?>
                          </td>
                          
                          <td>
                            <?php echo $status;?> 
                            <form action="" method="POST">
                                <select name="status">
                                    <option value="1" <?php if($status == '1'){ echo "selected";} ?>>Redemed</option>
                                      <option value="0" <?php if($status == '0'){ echo "selected";} ?>>Unused</option>
                                </select>
                                <input type="hidden" name="giftcodeid" value="<?php echo $giftcodeid; ?>"/>
                                <input type="submit" name="submit" value="submit" />
                                
                            </form>
                          </td>
         
                        </tr>
                        <?php
} 
?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>  
            
            <?php
                               }
              if($_GET['action'] == 'add')
                               {
                               ?>
                               
                               
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
                                                    <label class="control-label col-md-3">Giftcode
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <input type="text" name="giftcode" id="giftcode" data-required="1" class="form-control">
                                  
                               </div>
                               </div>
                               
                                                       <div class="form-group">
                                                    <label class="control-label col-md-3">Amount
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <input type="text" name="amount" id="amount" data-required="1" class="form-control">
                                  
                               </div>
                               </div>
                               
                                                                     <div class="form-group">
                                                    <label class="control-label col-md-3">No of times
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <input type="text" name="nooftimes" id="nooftimes" data-required="1" class="form-control">
                                  
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
                              
                                    </div>
                                                  </form>
                                        <!-- END FORM-->
                                </div>
                                <!-- END VALIDATION STATES-->
                                </div>
                                </div>
                </div>
         
         <?php
                               }
                               ?>
            
            
            
            
            
            
            
            
            <div class="clearfix">
            </div>
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
    <div class="quick-nav-overlay">
    </div>
    <!-- END QUICK NAV -->
    <!--[if lt IE 9]>
<script src="assets/global/plugins/respond.min.js"></script>
<script src="assets/global/plugins/excanvas.min.js"></script> 
<script src="assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
    <!-- BEGIN CORE PLUGINS -->
    <script src="assets/global/plugins/jquery.min.js" type="text/javascript">
    </script>
    <script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript">
    </script>
    <script src="assets/global/plugins/js.cookie.min.js" type="text/javascript">
    </script>
    <script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript">
    </script>
    <script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript">
    </script>
    <script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript">
    </script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="assets/global/scripts/datatable.js" type="text/javascript">
    </script>
    <script src="assets/global/plugins/datatables/datatables.min.js" type="text/javascript">
    </script>
    <script src="assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript">
    </script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="assets/global/scripts/app.min.js" type="text/javascript">
    </script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="assets/pages/scripts/table-datatables-colreorder.min.js" type="text/javascript">
    </script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="assets/layouts/layout/scripts/layout.min.js" type="text/javascript">
    </script>
    <script src="assets/layouts/layout/scripts/demo.min.js" type="text/javascript">
    </script>
    <script src="assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript">
    </script>
    <script src="assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript">
    </script>
    <script src="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript">
    </script>
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript">
    </script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="assets/pages/scripts/components-select2.min.js" type="text/javascript">
    </script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- SCRIPTS -->         
  </body>
</html>
