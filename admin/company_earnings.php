<?php
session_start();
include_once 'function.php';
?>
<!DOCTYPE html>
<html lang="en">
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />   
  <head>
    <meta charset="utf-8" />
    <title>Wallet List | 
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
                  <span>Company Earnings
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
                      </i>Today Company Earnings
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
                           <th> Today wallet payment
                          </th>
                          <th> Today Total withdraw
                          </th>
                          <th> Today Total Earnings
                          </th>
       
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $thisdate = date('Y-m-d');
//`trans_id`, `cus_id`, `trans_date`, `trans_des`, `amt_credit`, `amt_debit`, `status`SELECT * FROM `transaction` WHERE 1
$walletadmintoday = mysqli_query($connect, "SELECT SUM(amt_credit) as creditnow2t from transaction where  status = '1'and trans_des LIKE '%Wallet payment%'  and `trans_date` = '$thisdate'") or die(mysqli_error());
while ($FETCH_adminbalancec2 = mysqli_fetch_array($walletadmintoday))
{
$creditnow2day = $FETCH_adminbalancec2['creditnow2t'];
}

              //`trans_id`, `cus_id`, `trans_date`, `trans_des`, `amt_credit`, `amt_debit`, `status`SELECT * FROM `transaction` WHERE 1
$walletadmincedit22today = mysqli_query($connect, "SELECT SUM(amt_debit) as debitnow2 from transaction where  status = '1'and trans_des LIKE '%Wallet withdraw%'  and `trans_date` = '$thisdate'") or die(mysqli_error());
while ($FETCH_adminbalancec22today = mysqli_fetch_array($walletadmincedit22today))
{
$debitnow2 = $FETCH_adminbalancec22today['debitnow2'];
// $debitnow2 = ($debitnow2 * 100) / 95;

}


?>
                        <tr>
                          <td>
                          1
                          </td>
                         
                          <td>
                            Rs.<?php echo $creditnow2day; ?>/-
                          </td>
                          <td>
                        Rs.<?php echo $debitnow2; ?>/-
                          </td>
                          <td>
                              <?php echo $creditnow2day - $debitnow2; ?>
                          </td>
                        </tr>
 
                      </tbody>
                    </table>
                   
                    
                    <table>
                        <tr>
                            <th>Today total withdraw:</th>
                            
                            
                       <!--`trans_id`, `cus_id`, `trans_date`, `trans_des`, `amt_credit`, `amt_debit`, `status`, `fromaccount`SELECT * FROM `transaction` WHERE 1-->
                       
<?php
// $thisdate = date('Y-m-d');
// echo "SELECT SUM(amt_debit) as amt_debit from transaction where `trans_date` = '$thisdate' and  `trans_des` = 'Wallet withdraw'";
$totalamt = mysqli_query($connect, "SELECT SUM(amt_debit) as amt_debit from transaction where `trans_date` = '$thisdate' and  `trans_des` = 'Wallet withdraw'") or die(mysqli_error());
while ($FETCH_todayamt = mysqli_fetch_array($totalamt))
{
 $totalwithdraw = $FETCH_todayamt['amt_debit'];
//  $tds = $totalwithdraw * 1.05;
// $remaining = $totalwithdraw - $tds;
}
  ?>                     
                       
                       
                         
                        </tr>
                    </table>
                    
                       <h3>
                       Rs.<?php echo round($totalwithdraw); ?>/-
                   </h3>
                    
                  </div>
                  
                </div>
              </div>
            </div>   
            <div class="clearfix">
            </div>
            
                       <div class="row">
              <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box red">
                  <div class="portlet-title">
                    <div class="caption">
                      <i class="fa fa-globe">
                      </i>Date wise
                    </div>
                    <div class="actions">
  
                    </div>
                  </div>
                  <div class="portlet-body">
                      <?php
                      
                      
if ($_POST['search'] == 'Search')
{
    
      $id  = $_POST['id'];
       $fromdate  = $_POST['fromdate'];
        $todate  = $_POST['todate'];
    
    
}
                      
                      
                      
                      ?>
                      
                      
                      
                      
                <form action="" method="POST">
                    <input type="date" name="fromdate" class="form-control" />
                    
                          <input type="date" name="todate" class="form-control" />
                          <input type="submit" name="search" value="Search" />
                    
                </form>
                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                      <thead>
                        <tr class="">
                          <th> S.NO 
                          </th>
                           <th> Today wallet payment
                          </th>
                          <th> Today Total withdraw
                          </th>
                          <th> Today Total Earnings
                          </th>
       
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $thisdate = date('Y-m-d');
                        // echo "SELECT SUM(amt_credit) as creditnow2t from transaction where  status = '1'and trans_des LIKE '%Wallet payment%'  and `trans_date` BETWEEN '$fromdate' AND '$todate'";
//`trans_id`, `cus_id`, `trans_date`, `trans_des`, `amt_credit`, `amt_debit`, `status`SELECT * FROM `transaction` WHERE 1
$walletadmintoday = mysqli_query($connect, "SELECT SUM(amt_credit) as creditnow2t from transaction where  status = '1'and trans_des LIKE '%Wallet payment%'  and `trans_date` BETWEEN '$fromdate' AND '$todate'") or die(mysqli_error());
while ($FETCH_adminbalancec2 = mysqli_fetch_array($walletadmintoday))
{
$creditnow2day = $FETCH_adminbalancec2['creditnow2t'];
}

              //`trans_id`, `cus_id`, `trans_date`, `trans_des`, `amt_credit`, `amt_debit`, `status`SELECT * FROM `transaction` WHERE 1
$walletadmincedit22today = mysqli_query($connect, "SELECT SUM(amt_debit) as debitnow2 from transaction where  status = '1'and trans_des LIKE '%Wallet withdraw%'  and `trans_date` BETWEEN '$fromdate' AND '$todate'") or die(mysqli_error());
while ($FETCH_adminbalancec22today = mysqli_fetch_array($walletadmincedit22today))
{
$debitnow2 = $FETCH_adminbalancec22today['debitnow2'];
// $debitnow2 = ($debitnow2 * 100) / 95;

}



?>
<h2><?php echo date('d-m-Y',strtotime($fromdate)); ?> - <?php echo date('d-m-Y',strtotime($todate)); ?></h2>
                        <tr>
                          <td>
                          1
                          </td>
                         
                          <td>
                            Rs.<?php echo $creditnow2day; ?>/-
                          </td>
                          <td>
                        Rs.<?php echo $debitnow2; ?>/-
                          </td>
                          <td>
                              <?php echo $creditnow2day - $debitnow2; ?>
                          </td>
                         
                        </tr>
 
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
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
