<?php
session_start();
include_once 'function.php';

$get_customer = mysqli_query($connect,"SELECT * FROM apply_from where `loan_status` IS NULL ") or die(mysqli_error());
$tcount = mysqli_num_rows($get_customer);

$get_new_form = mysqli_query($connect,"SELECT * FROM formw ") or die(mysqli_error());
$tcount_form = mysqli_num_rows($get_new_form);

$get_customeree = mysqli_query($connect,"SELECT * FROM apply_from ") or die(mysqli_error());
$tcountee = mysqli_num_rows($get_customeree);

$get_customereeprocessed = mysqli_query($connect,"SELECT * FROM apply_from WHERE `loan_status` IS NOT NULL AND loan_status != 'cancelled';") or die(mysqli_error());
$tcounteeprocessed = mysqli_num_rows($get_customereeprocessed);

$get_customereeDisbursement = mysqli_query($connect,"SELECT * FROM apply_from WHERE `loan_status`= 'Disbursement' ") or die(mysqli_error());
$tcounteeDisbursement = mysqli_num_rows($get_customereeDisbursement);

$get_product = mysqli_query($connect,"SELECT * FROM contact_us ") or die(mysqli_error());
$tproduct = mysqli_num_rows($get_product);

$get_productreferences = mysqli_query($connect,"SELECT * FROM reference ") or die(mysqli_error());
$tproductref = mysqli_num_rows($get_productreferences);

$get_customerd = mysqli_query($connect,"SELECT * FROM apply_from where loan_status = 'cancelled' ") or die(mysqli_error());
$tcountca = mysqli_num_rows($get_customerd);

$get_customerdtt = mysqli_query($connect,"SELECT * FROM apply_from where loan_status = 'cancelled' and referedby = '$Admin_admin_id' ") or die(mysqli_error());
$tdisbursement = mysqli_num_rows($get_customerdtt);

// Get bank-wise count from bank_details table
$bank_wise_query = "SELECT bank_name, COUNT(*) as total_count 
                    FROM bank_details 
                    WHERE bank_name IS NOT NULL AND bank_name != '' 
                    GROUP BY bank_name 
                    ORDER BY total_count DESC";
$bank_wise_result = mysqli_query($connect, $bank_wise_query);
$total_banks = mysqli_num_rows($bank_wise_result);

// Get total records count from bank_details
$total_records_query = "SELECT COUNT(*) as total FROM bank_details";
$total_records_result = mysqli_query($connect, $total_records_query);
$total_records = mysqli_fetch_assoc($total_records_result)['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Dash Board | <?php echo $site_title; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Preview page of Metronic Admin Theme #1 for statistics, charts, recent events and reports" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
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
    
    <style type="text/css">
        .dt-buttons {
            display: none;
        }
        .bank-wise-section {
            margin-top: 20px;
        }
        .bank-card {
            margin-bottom: 20px;
        }
        .dashboard-stat.bank-stat {
            background-color: #3598dc !important;
        }
        .dashboard-stat.bank-stat.green1 { background-color: #2bb8c4 !important; }
        .dashboard-stat.bank-stat.green2 { background-color: #36c6d3 !important; }
        .dashboard-stat.bank-stat.purple { background-color: #8E44AD !important; }
        .dashboard-stat.bank-stat.orange { background-color: #E67E22 !important; }
        .dashboard-stat.bank-stat.red { background-color: #e7505a !important; }
        .dashboard-stat.bank-stat.yellow { background-color: #F1C40F !important; }
        .dashboard-stat.bank-stat.blue { background-color: #3598dc !important; }
        .dashboard-stat.bank-stat.dark { background-color: #2f353b !important; }
    </style>
    <script type="text/javascript">
        function delete_menu(idurl) {
            go_on = confirm("Are you sure ? ");
            if(go_on) {
                document.location.href=idurl;
            }
        }
    </script>
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
    <div class="page-wrapper">
        <!-- BEGIN HEADER -->
        <?php include("header.php");?>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"></div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <?php include("menu.php");?>
            </div>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE BAR -->
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <a href="index.php">Home</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>Dashboard</span>
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
                    
                    <?php if($Admin_level == '0') { ?>
                    
                    <!-- Main Stats Section -->
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-social-dribbble font-blue-sharp"></i>
                                <span class="caption-subject font-blue-sharp bold uppercase">KYC Finserv Overview</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 green" href="new_product.php">
                                        <div class="visual">
                                            <i class="fa fa-file-text"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="<?php echo $tcount_form; ?>"><?php echo $tcount_form; ?></span>
                                            </div>
                                            <div class="desc">Application Form New</div>
                                        </div>
                                    </a>
                                </div>
                                
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 blue" href="productpending.php">
                                        <div class="visual">
                                            <i class="fa fa-hourglass-half"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="<?php echo $tcount; ?>"><?php echo $tcount; ?></span>
                                            </div>
                                            <div class="desc">Total Pending Applications</div>
                                        </div>
                                    </a>
                                </div>
                                
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 green" href="product.php">
                                        <div class="visual">
                                            <i class="fa fa-list-alt"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="<?php echo $tcountee; ?>"><?php echo $tcountee; ?></span>
                                            </div>
                                            <div class="desc">Total Applications</div>
                                        </div>
                                    </a>
                                </div>
                                
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 green" href="processedapplication.php">
                                        <div class="visual">
                                            <i class="fa fa-check-circle"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="<?php echo $tcounteeprocessed; ?>"><?php echo $tcounteeprocessed; ?></span>
                                            </div>
                                            <div class="desc">Total Process Applications</div>
                                        </div>
                                    </a>
                                </div>
                                
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 green" href="disbursement.php">
                                        <div class="visual">
                                            <i class="fa fa-money"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="<?php echo $tcounteeDisbursement; ?>"><?php echo $tcounteeDisbursement; ?></span>
                                            </div>
                                            <div class="desc">Total Disbursement Applications</div>
                                        </div>
                                    </a>
                                </div>
                                
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 red" href="references.php">
                                        <div class="visual">
                                            <i class="fa fa-users"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="<?php echo $tproductref; ?>"><?php echo $tproductref; ?></span>
                                            </div>
                                            <div class="desc">Total References</div>
                                        </div>
                                    </a>
                                </div>
                                
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 red" href="cancelledloans.php">
                                        <div class="visual">
                                            <i class="fa fa-ban"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="<?php echo $tcountca; ?>"><?php echo $tcountca; ?></span>
                                            </div>
                                            <div class="desc">Total Cancelled Loans</div>
                                        </div>
                                    </a>
                                </div>
                                
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 yellow" href="cibilcheck.php" target="_blank">
                                        <div class="visual">
                                            <i class="fa fa-credit-card"></i>
                                        </div>
                                        <div class="details">
                                            <div class="desc">Check CIBIL (Rs. 108/- including GST)</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 bank-card">
                                    <div class="dashboard-stat dashboard-stat-v2 dark">
                                        <div class="visual">
                                            <i class="fa fa-bank"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="<?php echo $total_banks; ?>">
                                                    <?php echo $total_banks; ?>
                                                </span>
                                            </div>
                                            <div class="desc">Total Banks</div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
                    <!-- Bank Wise Count Section - Matching Your Design Style -->
                    <!--<div class="portlet light bordered bank-wise-section">-->
                    <!--    <div class="portlet-title">-->
                    <!--        <div class="caption">-->
                    <!--            <i class="fa fa-bank font-green"></i>-->
                    <!--            <span class="caption-subject font-green bold uppercase">BANKS WISE DETAILS</span>-->
                    <!--        </div>-->
                    <!--        <div class="actions">-->
                    <!--            <a href="bank_details.php" class="btn btn-circle btn-outline green">-->
                    <!--                <i class="fa fa-eye"></i> View All Bank Details-->
                    <!--            </a>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--    <div class="portlet-body">-->
                            <!-- Total Banks Box - Single Box as Requested -->
                            <!--<div class="row">-->
                            <!--    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 bank-card">-->
                            <!--        <div class="dashboard-stat dashboard-stat-v2 dark">-->
                            <!--            <div class="visual">-->
                            <!--                <i class="fa fa-bank"></i>-->
                            <!--            </div>-->
                            <!--            <div class="details">-->
                            <!--                <div class="number">-->
                            <!--                    <span data-counter="counterup" data-value="<?php echo $total_banks; ?>">-->
                            <!--                        <?php echo $total_banks; ?>-->
                            <!--                    </span>-->
                            <!--                </div>-->
                            <!--                <div class="desc">Total Banks</div>-->
                            <!--            </div>-->
                            <!--            <a class="more" href="bank_details.php">-->
                            <!--                View All <i class="m-icon-swapright m-icon-white"></i>-->
                            <!--            </a>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    
                    <?php } ?>
                    
                    <?php if($Admin_level == '1') { ?>
                    
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-social-dribbble font-blue-sharp"></i>
                                <span class="caption-subject font-blue-sharp bold uppercase">KYC Finserv</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 green" href="new_product.php?action=add">
                                        <div class="visual">
                                            <i class="fa fa-file-text"></i>
                                        </div>
                                        <div class="details">
                                            <div class="desc">Application Form New</div>
                                        </div>
                                    </a>
                                </div>
                                
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                                        <div class="visual">
                                            <i class="fa fa-money"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="<?php echo $tdisbursement; ?>"><?php echo $tdisbursement; ?></span>
                                            </div>
                                            <div class="desc">Total Disbursement</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 bank-card">
                                    <div class="dashboard-stat dashboard-stat-v2 dark">
                                        <div class="visual">
                                            <i class="fa fa-bank"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="<?php echo $total_banks; ?>">
                                                    <?php echo $total_banks; ?>
                                                </span>
                                            </div>
                                            <div class="desc">Total Banks</div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
                    <?php } ?>
                    
                    <div class="clearfix"></div>
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
        
        <!-- BEGIN FOOTER -->
        <?php include("footer.php");?>
        <!-- END FOOTER -->
    </div>
    
    <!-- BEGIN QUICK NAV -->
    <div class="quick-nav-overlay"></div>
    <!-- END QUICK NAV -->
    
    <!-- BEGIN CORE PLUGINS -->
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
    <!-- END THEME LAYOUT SCRIPTS -->
    
    <script>
        $(document).ready(function() {
            // CounterUp plugin initialization (if you have it)
            if ($.fn.counterup) {
                $('[data-counter="counterup"]').counterup({
                    delay: 10,
                    time: 1000
                });
            }
        });
    </script>
    
    <style>
        .col-lg-3 {
            margin-bottom: 20px;
        }
        .dashboard-stat .visual i {
            font-size: 35px;
        }
        .bank-wise-section .dashboard-stat {
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .bank-wise-section .dashboard-stat:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        /* Additional color classes */
        .dashboard-stat.dashboard-stat-v2.green1 {
            background-color: #2bb8c4;
        }
        .dashboard-stat.dashboard-stat-v2.green2 {
            background-color: #36c6d3;
        }
        .dashboard-stat.dashboard-stat-v2.purple {
            background-color: #8E44AD;
        }
        .dashboard-stat.dashboard-stat-v2.orange {
            background-color: #E67E22;
        }
        .dashboard-stat.dashboard-stat-v2.dark {
            background-color: #2f353b;
        }
    </style>
</body>
</html>