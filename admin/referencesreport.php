<?php
session_start();
include_once 'function.php';

// Initialize variables
$from_date = isset($_POST['from_date']) ? $_POST['from_date'] : '';
$to_date = isset($_POST['to_date']) ? $_POST['to_date'] : '';
$referedby = isset($_POST['referedby']) ? $_POST['referedby'] : '';
$bank_name = isset($_POST['bank_name']) ? $_POST['bank_name'] : '';

// Process search
if (isset($_POST['search']) && $_POST['search'] == 'search') {
    
    // Build query with filters
    $query = "SELECT * FROM reference WHERE 1=1";
    
    // Add date filter - using created_at column
    if (!empty($from_date) && !empty($to_date)) {
        $from = mysqli_real_escape_string($connect, $from_date);
        $to = mysqli_real_escape_string($connect, $to_date);
        $query .= " AND DATE(created_at) BETWEEN '$from' AND '$to'";
    } elseif (!empty($from_date)) {
        $from = mysqli_real_escape_string($connect, $from_date);
        $query .= " AND DATE(created_at) >= '$from'";
    } elseif (!empty($to_date)) {
        $to = mysqli_real_escape_string($connect, $to_date);
        $query .= " AND DATE(created_at) <= '$to'";
    }
    
    // Add reference filter
    if (!empty($referedby)) {
        $ref = mysqli_real_escape_string($connect, $referedby);
        $query .= " AND reference_name = '$ref'";
    }
    
    // Add bank filter
    if (!empty($bank_name)) {
        $bank = mysqli_real_escape_string($connect, $bank_name);
        $query .= " AND bank_name = '$bank'";
    }
    
    $query .= " ORDER BY referenceid DESC";
    
    // Execute query
    $search_results = mysqli_query($connect, $query) or die(mysqli_error($connect));
    $total_records = mysqli_num_rows($search_results);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Reference Report | KYC Finserv</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
    
    <style>
        .filter-form {
            background: #fff;
            padding: 20px;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin: 20px 0;
        }
        .filter-form .form-group {
            margin-right: 15px;
            margin-bottom: 15px;
        }
        .filter-form label {
            font-weight: 600;
            color: #333;
            margin-right: 5px;
        }
        .filter-form input, .filter-form select {
            min-width: 150px;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 6px 12px;
        }
        .search-btn {
            background: #e7505a;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
        }
        .search-btn:hover {
            background: #d93b45;
        }
        .reset-btn {
            background: #fff;
            color: #333;
            border: 1px solid #ddd;
            padding: 8px 20px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .reset-btn:hover {
            background: #f5f5f5;
            text-decoration: none;
        }
        .date-note {
            color: #e7505a;
            font-size: 12px;
            margin-top: 10px;
            padding: 5px 10px;
            background: #fff5f5;
            border-radius: 4px;
            display: inline-block;
        }
        .results-table {
            margin-top: 30px;
        }
        .results-table .portlet-title {
            background: #f9f9f9;
            padding: 15px;
            border-bottom: 2px solid #e7505a;
        }
        .table th {
            background: #f5f5f5;
            font-weight: 600;
            font-size: 13px;
        }
        .table td {
            font-size: 12px;
        }
        .total-badge {
            background: #e7505a;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 12px;
            border-top: 1px solid #ddd;
            margin-top: 30px;
        }
    </style>
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
    <div class="page-wrapper">
        <!-- BEGIN HEADER -->
        <?php include("header.php");?>
        <!-- END HEADER -->
        
        <div class="clearfix"></div>
        
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <?php include("menu.php");?>
            </div>
            <!-- END SIDEBAR -->
            
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <!-- BEGIN PAGE BAR -->
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <a href="index.php">Home</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>Reference Report</span>
                            </li>
                        </ul>
                    </div>
                    <!-- END PAGE BAR -->
                    
                    <!-- Filter Form Section -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="filter-form">
                                <form action="" method="POST" class="form-inline">
                                    <div class="form-group">
                                        <label>From:</label>
                                        <input type="date" name="from_date" class="form-control" 
                                               value="<?php echo htmlspecialchars($from_date); ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label>To:</label>
                                        <input type="date" name="to_date" class="form-control" 
                                               value="<?php echo htmlspecialchars($to_date); ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label>Reference:</label>
                                        <select name="referedby" class="form-control">
                                            <option value="">All References</option>
                                            <?php
                                            $refs = mysqli_query($connect, "SELECT DISTINCT reference_name FROM reference ORDER BY reference_name");
                                            while($ref = mysqli_fetch_assoc($refs)) {
                                                $selected = ($referedby == $ref['reference_name']) ? 'selected' : '';
                                                echo "<option value='".$ref['reference_name']."' $selected>".$ref['reference_name']."</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Bank Name:</label>
                                        <select name="bank_name" class="form-control">
                                            <option value="">All Banks</option>
                                            <?php
                                            $banks = mysqli_query($connect, "SELECT DISTINCT bank_name FROM reference WHERE bank_name IS NOT NULL AND bank_name != '' ORDER BY bank_name");
                                            while($bank = mysqli_fetch_assoc($banks)) {
                                                $selected = ($bank_name == $bank['bank_name']) ? 'selected' : '';
                                                echo "<option value='".$bank['bank_name']."' $selected>".$bank['bank_name']."</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <button type="submit" name="search" value="search" class="search-btn">
                                        <i class="fa fa-search"></i> Search
                                    </button>
                                    <a href="references.php" class="reset-btn">
                                        <i class="fa fa-refresh"></i> Reset
                                    </a>
                                </form>
                                <div class="date-note">
                                    <i class="fa fa-info-circle"></i> Please enter date in yyyy-mm-dd format (e.g., 2026-03-14)
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Search Results Section -->
                    <?php if (isset($_POST['search']) && $_POST['search'] == 'search') { ?>
                    <div class="row results-table">
                        <div class="col-md-12">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-users font-red"></i>
                                        <span class="caption-subject font-red bold uppercase">Search Results</span>
                                    </div>
                                    <div class="actions">
                                        <span class="total-badge">
                                            <i class="fa fa-file-text-o"></i> Total: <?php echo $total_records; ?> records
                                        </span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="table-scrollable">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Phone</th>
                                                    <th>Reference Name</th>
                                                    <th>Bank Name</th>
                                                    <th>Bank Account</th>
                                                    <th>Bank IFSC</th>
                                                    <th>Aadhar No</th>
                                                    <th>PAN No</th>
                                                    <th>Created Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($search_results) && mysqli_num_rows($search_results) > 0) {
                                                    while ($row = mysqli_fetch_assoc($search_results)) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $row['referenceid']; ?></td>
                                                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                                                            <td><?php echo htmlspecialchars($row['phone']); ?></td>
                                                            <td><?php echo htmlspecialchars($row['reference_name']); ?></td>
                                                            <td><?php echo htmlspecialchars($row['bank_name']); ?></td>
                                                            <td><?php echo htmlspecialchars($row['bank_account']); ?></td>
                                                            <td><?php echo htmlspecialchars($row['bank_ifsc']); ?></td>
                                                            <td><?php echo htmlspecialchars($row['aadhar_no']); ?></td>
                                                            <td><?php echo htmlspecialchars($row['pan_no']); ?></td>
                                                            <td>
                                                                <?php 
                                                                if (isset($row['created_at']) && $row['created_at'] != '0000-00-00 00:00:00') {
                                                                    echo date('m/d/Y', strtotime($row['created_at']));
                                                                } else {
                                                                    echo 'N/A';
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } else {
                                                    echo '<tr><td colspan="10" class="text-center">No records found</td></tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    
                </div>
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
        
        <!-- BEGIN FOOTER -->
        <div class="footer">
            <p>&copy; <?php echo date('Y'); ?> KYC Finserv. All rights reserved.</p>
        </div>
        <!-- END FOOTER -->
    </div>
    
    <!-- BEGIN CORE PLUGINS -->
    <script src="assets/global/plugins/jquery.min.js"></script>
    <script src="assets/global/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/global/plugins/js.cookie.min.js"></script>
    <script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/global/plugins/jquery.blockui.min.js"></script>
    <script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <!-- END CORE PLUGINS -->
    
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="assets/global/scripts/app.min.js"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="assets/layouts/layout/scripts/layout.min.js"></script>
    <script src="assets/layouts/layout/scripts/demo.min.js"></script>
    <script src="assets/layouts/global/scripts/quick-sidebar.min.js"></script>
    <!-- END THEME LAYOUT SCRIPTS -->
</body>
</html>