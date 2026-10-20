<?php
session_start();
include_once 'function.php';

//deleting record
//action=delete&catid

if ($_GET['action'] == 'approve') {
    
    $id  = $_GET['nwsevnt_id'];
    $regid  = $_GET['reg'];
    $amt = $_GET['amt'];
///`paymentid`, `paymentdate`, `reg_id`, `paymentamount`, `referenceno`, `qrid`, `paymentstatus`SELECT * FROM `payments` WHERE 1
    $sql = "UPDATE `payments` SET `paymentstatus`='1' WHERE paymentid = $id;";
    
    //`trans_id`, `cus_id`, `trans_date`, `trans_des`, `amt_credit`, `amt_debit`, `status`SELECT * FROM `transaction` WHERE 1
    
        $sql4 = "UPDATE `transaction` SET `status`='1' WHERE cus_id = $regid and amt_credit = $amt ORDER BY trans_id DESC LIMIT 1";
        



 
        
    $query = mysqli_query($connect,$sql) or die("There was a problem while deleting: " . mysqli_error());
      $query4 = mysqli_query($connect,$sql4) or die("There was a problem while updating: " . mysqli_error());
    echo "<div style='width: 350px; text-align: center; margin: 20% auto 0px; font-family: arial; font-size: 14px; border: 1px solid #ddd; padding: 20px 40px;'>Please wait while we update the record loading...</div>";
    
    if ($query && $query4) {


        echo "<script type='text/javascript'>window.location = 'paymentsn.php?msg=deleted&action=list'</script>";
    }
    
}

if ($_GET['action'] == 'delete') {
    
    $id  = $_GET['nwsevnt_id'];
    $regid  = $_GET['regid'];
     $pdate  = $_GET['pdate'];
    $amt = $_GET['amt'];


// echo "DELETE FROM transaction WHERE cus_id = $regid and pdate = $pdate and amt_credit = $amt LIMIT 1;";
// exit();

    mysqli_query($connect,"DELETE FROM payments WHERE paymentid = $id;") or die(mysqli_error($connect));
    mysqli_query($connect,"DELETE FROM transaction WHERE cus_id = $regid and trans_date = $pdate and amt_credit = $amt LIMIT 1;") or die(mysqli_error($connect)); 


    

    echo "<div style='width: 350px; text-align: center; margin: 20% auto 0px; font-family: arial; font-size: 14px; border: 1px solid #ddd; padding: 20px 40px;'>Please wait while we update the record loading...</div>";
    



        echo "<script type='text/javascript'>window.location = 'paymentsn.php?msg=deleted&action=list'</script>";
 
    
}
?>
<!DOCTYPE html>
<html lang="en">
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />   
  <head>
    <meta charset="utf-8" />
    <title>Payment List | 
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

        function approvenow(idurl)
      {
        go_on = confirm("Are you sure want to approve the payment? ");
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
                  <span>Payment List
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
            <div class="row">
              <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box red">
                  <div class="portlet-title">
                    <div class="caption">
                      <i class="fa fa-globe">
                      </i>Payment List
                    </div>
                    <div class="actions">
  
                    </div>
                  </div>
                  <div class="portlet-body">
                    <?php pageStatus($status); ?>
                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                      <thead>
                        <tr class="">
                          <th> S.NO 
                          </th>
                          <th> Date
                          </th>
                          <th> Payment by
                          </th>
                          <th> Amount
                          </th>
                          <th> Reference no
                          </th>
                           <th> QR account
                          </th>
                          <th>Approve
                          </th>
                          <th>Modify
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
$sno =0;
//`paymentid`, `reg_id`, `paymentamount`, `referenceno`, `qrid`SELECT * FROM `payments` WHERE 1

$get_customer = mysqli_query($connect,"SELECT * FROM payments where paymentstatus = 0 ORDER BY paymentid DESC") or die(mysqli_error());
while($get_value = mysqli_fetch_array($get_customer)) 
{
$sno++;    
$paymentid = $get_value['paymentid'];    
$reg_id=$get_value['reg_id']; 
$paymentamount=$get_value['paymentamount']; 
$referenceno=$get_value['referenceno']; 
$qrid=$get_value['qrid']; 
$paymentdate=$get_value['paymentdate']; 
$paymentstatus=$get_value['paymentstatus']; 
$screenshot=$get_value['screenshot']; 

?>
                        <tr>
                          <td>
                            <?php echo $sno;?> 
                          </td>
                          <td>
                            <?php echo date('d-m-Y',strtotime($paymentdate));?> 
                          </td>
                          <td>
                            <?php echo regusersDB($reg_id); ?> -  <?php echo 'FGL'.$reg_id; ?>
                          </td>
                          <td>
                            <?php echo $paymentamount;?> 
                          </td>
                          <td>
                            <?php echo $referenceno; ?>
                          </td>

                                     <td>
                            <?php echo qrDB($qrid); ?>
                          </td>


                                     <td>
                          <?php
                            if($paymentstatus == '0'){ ?>

                               <a class="btn btn-xs btn-danger"  onClick="approvenow('paymentsn.php?action=approve&nwsevnt_id=<?php echo $paymentid; ?>&reg=<?php echo $reg_id; ?>&amt=<?php echo $paymentamount; ?>')" href="javascript:;"> Approve now</a>

                              <?php
                            }else if($paymentstatus == '1'){
                            ?>
                             <a class="btn btn-xs btn-success" href="javascript:;">Approved</a>
                             <?php
                           }
                           ?>
                          </td>
                          
                          
                          <td>
                          <a class="btn btn-info btn-xs" data-toggle="modal" href="#image<?php echo $paymentid; ?>">
                              <i class="fa fa-eye" aria-hidden="true">
                              </i> View screenshot
                            </a>
    <a class="btn btn-xs btn-danger"  onClick="delete_menu('paymentsn.php?action=delete&nwsevnt_id=<?php echo $paymentid; ?>&amt=<?php echo $paymentamount; ?>&pdate=<?php echo $paymentdate; ?>&regid=<?php echo $reg_id; ?>')" href="javascript:;"><i class="fa fa-trash"></i> Delete</a>
                                                            
                          </td>
                <!--============================================= Image View Pop Up =============================================-->
                          <div class="modal fade" id="image<?php echo $paymentid; ?>" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                  </button>
                                  
                                </div>
                                <div class="modal-body">
                                  <img src="blog/<?php echo $screenshot; ?>" class="img-responsive">
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
                        <?php
} 
?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>   
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
re