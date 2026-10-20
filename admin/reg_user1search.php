<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
session_start();
include_once 'function.php';

//deleting record
//action=delete&catid
if ($_GET['action'] == 'delete') {
    
    $id  = $_GET['nwsevnt_id'];

//`reg_id`, `reg_name`, `reg_mailid`, `reg_pin`, `reg_newpin`, `reg_phone`SELECT * FROM `reg_user` WHERE 1

    $sql = "DELETE FROM reg_user WHERE reg_id = $id;";
    $query = mysqli_query($connect,$sql) or die("There was a problem while deleting: " . mysqli_error());
    
    echo "<div style='width: 350px; text-align: center; margin: 20% auto 0px; font-family: arial; font-size: 14px; border: 1px solid #ddd; padding: 20px 40px;'>Please wait while we update the record loading...</div>";
    
    if ($query) {


        echo "<script type='text/javascript'>window.location = 'reg_users1.php?msg=deleted&action=list'</script>";
    }
    
}

if ($_POST['changepassword'] == 'submit') {

    $reg_id = $_POST['regid'];
     $password = $_POST['password'];
    

mysqli_query($connect,"UPDATE reg_user SET `reg_pin` = '$password'  where reg_id = '$reg_id'") or die(mysqli_error());
echo "<div style='width: 350px; text-align: center; margin: 20% auto 0px; font-family: arial; font-size: 14px; border: 1px solid #ddd; padding: 20px 40px;'> 
Please wait while we update loading...</div>";
echo "<script type='text/javascript'>window.location = 'reg_users1.php?msg=updated&action=list'</script>";

}

if ($_POST['add'] == 'submit') {

    $reg_id = $_POST['regid'];
     $wallet_withdraw1 = $_POST['wallet_withdraw1'];
     $trans_date = date('Y-m-d');
    

mysqli_query($connect,"INSERT into transaction (`cus_id`,`trans_date`,`trans_des`,`status`,`amt_debit`) 
values ('$reg_id','$trans_date','Wallet_withdraw_1','1','$wallet_withdraw1')") or die(mysqli_error());


echo "<div style='width: 350px; text-align: center; margin: 20% auto 0px; font-family: arial; font-size: 14px; border: 1px solid #ddd; padding: 20px 40px;'> 
Please wait while we update loading...</div>";
echo "<script type='text/javascript'>window.location = 'reg_users1.php?msg=updated&action=list'</script>";

}


if ($_POST['submit'] == 'submit') {


$newsid = $_POST['regid'];

  $status     = $_POST['status'];

mysqli_query($connect,"UPDATE reg_user SET `status` = '$status' where reg_id = '$newsid'") or die(mysqli_error());
echo "<div style='width: 350px; text-align: center; margin: 20% auto 0px; font-family: arial; font-size: 14px; border: 1px solid #ddd; padding: 20px 40px;'> 
Please wait while we update loading...</div>";
echo "<script type='text/javascript'>window.location = 'reg_users1.php?msg=updated&action=list'</script>";
}


?>
<!DOCTYPE html>
<html lang="en">
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />   
  <head>
    <meta charset="utf-8" />
    <title>REG USERS List | 
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
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
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
                  <span>User List
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
            <?php
            if(isset($_GET['action']) =='' || $_GET['action'] == 'list') {
                ?>
            <br>
            <div class="row">
              <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box red">
                  <div class="portlet-title">
                    <div class="caption">
                      <i class="fa fa-globe">
                      </i>User List
                    </div>
                    <div class="actions">
                                                           <a href="regadd.php?action=add" class="btn btn-default btn-sm">
<i class="fa fa-plus"></i> Add </a>
                    </div>
                  </div>
                  <div class="portlet-body">
                      <form action="" method="POST">
                          
                          
                        <div class="form-group">
                                                    <label class="control-label col-md-3">Register user
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <label for="fruits">Select a USER:</label>
<input type="text" id="fruits" list="userlist" name="regid">
<datalist id="userlist">
    <select >
        <?php
        
$getsdsr = mysqli_query($connect,"SELECT * FROM reg_user ") or die(mysqli_error());
while($get_valueas = mysqli_fetch_array($getsdsr)) 
{
$reg_id = $get_valueas['reg_id'];    
$reg_name=$get_valueas['reg_phone'];
$reg_name2 = 'FGL'.$reg_id;
        ?>
        <option value="<?php echo $reg_id; ?>"><?php echo $reg_name; ?></option>
        <?php
}
?>

    </select>
</datalist>

                                  
                               </div>
                               </div>
                               <input type="submit" name="submit" value="submitnow" />
                      </form>
                      
                         <?php
$sno =0;
if ($_POST['submit'] == 'submitnow') {
// $trans_date = date('Y-m-d');

 $IDREG = $_POST['regid'];

?>
                      
                      
                      
                      
                         <table class="table table-striped table-bordered table-hover" id="sample_2">

                      <thead>
                        <tr class="">
                          <th> S.NO 
                          </th>
                        
                          
                          <th> Phone
                          </th>

                          <th> Password
                          </th>
                          
                           <th> Referals
                          </th>
                       
          
                          <th>Modify</th>
                          <th>Status</th>
                     
                        
                        <th>Others</th>
                        
                        </tr>
                      </thead>
                      <?php
                                                $sno =0;
                                               // echo "SELECT * FROM project where status = '1' ";
                                               // die();
                            $get_data = mysqli_query($connect,"SELECT * FROM reg_user where reg_id = '$IDREG'") or die(mysqli_error());
                                                                                               
                                                while($get_value = mysqli_fetch_array($get_data)) 
                                                {
                                                    $sno++;
                                                    $reg_id            = $get_value['reg_id'];
                                                    $user_name            = $get_value['reg_name'];
                                                    $email            = $get_value['reg_mailid'];
                                                    $mobile_no            = $get_value['reg_phone'];
                                                    $password            = $get_value['reg_pin'];
                                                    
                                                    $status = $get_value['status'];
if($status == 0){
    $status5 = "Active";
    
}else{
    $status5 = "In-Active";
}
                                                   
                                                ?>
                    
                                                  <tr>
                                                    <td><?php echo $sno; ?></td>
                                       
                                                    <td><?php echo $mobile_no; ?></td>
                                                    <td><?php echo $password; ?></td>
                                                    
                                                       <td>
                                                           
                                                           <?php
                                                                                   $reg_idd = 'FGL'.$reg_id;
                        $get_customerr = mysqli_query($connect,"SELECT * FROM reg_user where referedby = '$reg_idd'") or die(mysqli_error());
while($get_valuer = mysqli_fetch_array($get_customerr)) 
{
    $reg_sid=$get_valuer['reg_id']; 
 $reg_namer=$get_valuer['reg_phone']; 
 echo $reg_nameref = $reg_namer. " - FBL ".$reg_sid."<br>";
 
//  $combine
// echo $reg_nameref;
}

                                                           
                                                           ?>
                                                           
                                                       </td>
                                            
                                                          <td>
                                                              
                                                              
                               <form action="" method="POST">
                                        <input type="text" class="form-control" name="password" value="<?php echo $password; ?>" style="width:100px;" />
                                        <input type="hidden" name="regid" value="<?php echo $reg_id; ?>" />
                                        
                                        <input type="submit" name="changepassword" value="submit" />
                                    </form>
              
                            <a class="btn btn-xs red"  onClick="delete_menu('reg_users1.php?action=delete&nwsevnt_id=<?php echo $reg_id; ?>')" href="javascript:;">
                              <i class="icon-trash">
                              </i> Delete
                            </a>
                                                          </td>
                                                          
                                                          
                                                          
                                                          <td>
                            <?php echo $status5;?> 
                            <form action="" method="POST">
                                <select name="status">
                                    <option value="1" <?php if($status == '1'){ echo "selected";} ?>>In-active</option>
                                      <option value="0" <?php if($status == '0'){ echo "selected";} ?>>active</option>
                                </select>
                                <input type="hidden" name="regid" value="<?php echo $reg_id; ?>"/>
                                <input type="submit" name="submit" value="submit" />
                                
                            </form>
                          </td>
                                                          
                                                          
                                                          
                                                          
                                                           <td>
                            <a class="btn btn-info btn-xs" data-toggle="modal" href="#wallet_withdraw1<?php echo $reg_id; ?>">
                              <i class="fa fa-plus" aria-hidden="true">
                              </i> Add other money
                            </a>
                          </td>
                                                          
                          <!--============================================= Image View Pop Up =============================================-->
                          <div class="modal fade" id="wallet_withdraw1<?php echo $reg_id; ?>" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                  </button>
                                  <h4 class="modal-title">
                                   
                                  </h4>
                                </div>
                                
                                
                                <div class="modal-body">
                                  <form action="" method="POST">
                                        <input type="text" class="form-control" name="wallet_withdraw1" />
                                       <input type="hidden" name="regid" value="<?php echo $reg_id; ?>" />
                                      
                                        <input type="submit" name="add" value="submit" />
                                    </form>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close
                                  </button>
                                </div>
                              </div>
                              <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                          </div>
                          <!--=========================================== End Image Pop Up ============================================== -->

                                                          
        
                                                  </tr>


         
                      </tbody>
                      <?php
                                                }
                                                ?>
                    </table>
                    <?php
            }
            ?>
                  </div>
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
    <!--<script src="assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript">-->
    <!--</script>-->
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <!--<script src="assets/pages/scripts/components-select2.min.js" type="text/javascript">-->
    <!--</script>-->
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- SCRIPTS -->         
  </body>
</html>
re