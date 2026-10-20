<?php
session_start();
include_once 'function.php';

/* ---------- ADD ---------- */
if(isset($_POST['add']) && $_POST['add']=='Create'){
    $full_name = $_POST['full_name'];
    $employment_type = $_POST['employment_type'];
    $mobile_no = $_POST['mobile_no'];
    $loan_amount = $_POST['loan_amount'];
    $loan_type = $_POST['loan_type'];
    
    mysqli_query($connect,"INSERT INTO apply_from
    (full_name, employment_type, mobile_no, loan_amount, loan_type, loan_status)
    VALUES
    ('$full_name','$employment_type','$mobile_no','$loan_amount','$loan_type', 'Final sanction')");
    
    header("Location: final.php?msg=added");
    exit;
}

/* ---------- UPDATE / EDIT ---------- */
if(isset($_POST['update_page']) && $_POST['update_page']=='Update'){
    $id = $_POST['idd'];
    $full_name = $_POST['full_name'];
    $employment_type = $_POST['employment_type'];
    $mobile_no = $_POST['mobile_no'];
    $loan_amount = $_POST['loan_amount'];
    $loan_type = $_POST['loan_type'];
    
    mysqli_query($connect,"UPDATE apply_from SET 
        full_name='$full_name',
        employment_type='$employment_type',
        mobile_no='$mobile_no',
        loan_amount='$loan_amount',
        loan_type='$loan_type' 
        WHERE idd='$id'");
    
    header("Location: final.php?msg=updated");
    exit;
}

/* ---------- UPDATE STATUS ---------- */
if(isset($_POST['update_status']) && $_POST['update_status']=='Update Status'){
    $id = $_POST['idd'];
    $loan_status = $_POST['loan_status'];
    $distributed_amount = $_POST['distributed_amount'];
    $interest_rate = $_POST['interest_rate'];
    
    $update_query = "UPDATE apply_from SET 
        loan_status='$loan_status'";
    
    if(!empty($distributed_amount)) {
        $update_query .= ", distributed_loan_amount='$distributed_amount'";
    }
    if(!empty($interest_rate)) {
        $update_query .= ", rate_of_intrest='$interest_rate'";
    }
    
    $update_query .= " WHERE idd='$id'";
    
    mysqli_query($connect, $update_query);
    
    // Redirect based on new status
    if($loan_status == 'Legal/Tech clearance') {
        header("Location: legal.php?msg=updated");
    } elseif($loan_status == 'Loan docket creation') {
        header("Location: local.php?msg=updated");
    } elseif($loan_status == 'Disbursement') {
        header("Location: disbursement.php?msg=updated");
    } else {
        header("Location: final.php?msg=updated");
    }
    exit;
}

/* ---------- DELETE ---------- */
if(isset($_GET['action']) && $_GET['action']=='delete'){
    $id = intval($_GET['nwsevnt_id']);
    mysqli_query($connect,"DELETE FROM apply_from WHERE idd='$id'");
    header("Location: final.php?msg=deleted");
    exit;
}

// Get total final sanction count
$count_query = mysqli_query($connect, "SELECT COUNT(*) as total FROM apply_from WHERE loan_status='Final sanction'");
$count_data = mysqli_fetch_assoc($count_query);
$total_records = $count_data['total'];
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="ta" xml:lang="ta">
<head>
    <meta charset="utf-8" />
    <title>Final Sanction Applications | <?php echo $site_title; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">    
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    
    <!-- BEGIN THEME STYLES -->
    <link href="assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
    
    <style>
        .dt-buttons { display: none; }
        .success-msg { 
            color: green; 
            padding: 10px; 
            background: #e8f5e9; 
            border: 1px solid #c8e6c9; 
            margin: 10px 0; 
            border-radius: 4px; 
        }
        .status-badge {
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: bold;
            color: white;
            display: inline-block;
        }
        .status-final { 
            background-color: #f0ad4e; 
            color: white;
        }
        .total-box {
            background: #e7505a;
            color: white;
            padding: 8px 15px;
            border-radius: 4px;
            font-weight: bold;
            display: inline-block;
        }
        .filter-box {
            margin-bottom: 20px;
            padding: 15px;
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .action-buttons a {
            margin-right: 5px;
        }
    </style>
    
    <script>
        function delete_menu(idurl) {
            if(confirm("Are you sure you want to delete this record?")) {
                document.location.href = idurl;
            }
        }
        
        function updateStatus(id) {
            var form = document.getElementById('status-form-' + id);
            form.submit();
        }
    </script>
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
            <?php include("menu.php");?>
            <!-- END SIDEBAR -->
            
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <!-- BEGIN PAGE BAR -->
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li><a href="index.php">Home</a><i class="fa fa-circle"></i></li>
                            <li><span>Final Sanction Applications</span></li>
                        </ul>
                        <div class="page-toolbar">
                            <div class="total-box">
                                <i class="fa fa-check-circle"></i> Total: <?php echo $total_records; ?>
                            </div>
                        </div>
                    </div>
                    <!-- END PAGE BAR -->

                    <!-- Success/Error Messages -->
                    <?php if(isset($_GET['msg'])): ?>
                        <div class="success-msg">
                            <?php 
                            if($_GET['msg'] == 'added') echo "Record added successfully!";
                            if($_GET['msg'] == 'updated') echo "Record updated successfully!";
                            if($_GET['msg'] == 'deleted') echo "Record deleted successfully!";
                            ?>
                        </div>
                    <?php endif; ?>

                    <!-- Action Buttons -->
                    <div class="row" style="margin: 20px 0;">
                        <div class="col-md-12">
                            <a href="?action=add" class="btn btn-success">
                                <i class="fa fa-plus"></i> Add New Application
                            </a>
                            <a href="final.php" class="btn btn-primary">
                                <i class="fa fa-list"></i> Refresh
                            </a>
                        </div>
                    </div>

                    <!-- Filter Box -->
                    <div class="filter-box">
                        <form method="GET" action="" class="form-inline">
                            <div class="form-group">
                                <label>Filter by Date:</label>
                                <input type="date" name="from_date" class="form-control" placeholder="From" style="width:150px; margin:0 5px;">
                                <input type="date" name="to_date" class="form-control" placeholder="To" style="width:150px; margin:0 5px;">
                            </div>
                            <div class="form-group">
                                <label>Search:</label>
                                <input type="text" name="search" class="form-control" placeholder="Name or Mobile" style="width:200px; margin:0 5px;">
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-filter"></i> Apply Filter
                            </button>
                            <a href="final.php" class="btn btn-default">
                                <i class="fa fa-refresh"></i> Reset
                            </a>
                        </form>
                    </div>

                    <?php
                    /* ---------- ADD FORM ---------- */
                    if(isset($_GET['action']) && $_GET['action'] == 'add'):
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light portlet-fit portlet-form bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-plus font-green"></i>
                                        <span class="caption-subject font-green bold uppercase">Add New Application</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <form method="post" class="form-horizontal">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Full Name <span class="required">*</span></label>
                                                <div class="col-md-6">
                                                    <input type="text" name="full_name" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Employment Type <span class="required">*</span></label>
                                                <div class="col-md-6">
                                                    <input type="text" name="employment_type" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Mobile Number <span class="required">*</span></label>
                                                <div class="col-md-6">
                                                    <input type="text" name="mobile_no" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Loan Amount <span class="required">*</span></label>
                                                <div class="col-md-6">
                                                    <input type="text" name="loan_amount" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Loan Type <span class="required">*</span></label>
                                                <div class="col-md-6">
                                                    <input type="text" name="loan_type" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" name="add" value="Create" class="btn green">Submit</button>
                                                    <a href="final.php" class="btn default">Cancel</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    /* ---------- EDIT FORM ---------- */
                    elseif(isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])):
                        $id = intval($_GET['id']);
                        $edit_query = mysqli_query($connect, "SELECT * FROM apply_from WHERE idd='$id'");
                        $edit_data = mysqli_fetch_assoc($edit_query);
                        if(!$edit_data) {
                            echo "<div class='alert alert-danger'>Record not found!</div>";
                        } else {
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light portlet-fit portlet-form bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-pencil font-green"></i>
                                        <span class="caption-subject font-green bold uppercase">Edit Application - KYCC<?php echo $edit_data['idd']; ?></span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <form method="post" class="form-horizontal">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Full Name <span class="required">*</span></label>
                                                <div class="col-md-6">
                                                    <input type="text" name="full_name" value="<?php echo $edit_data['full_name']; ?>" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Employment Type <span class="required">*</span></label>
                                                <div class="col-md-6">
                                                    <input type="text" name="employment_type" value="<?php echo $edit_data['employment_type']; ?>" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Mobile Number <span class="required">*</span></label>
                                                <div class="col-md-6">
                                                    <input type="text" name="mobile_no" value="<?php echo $edit_data['mobile_no']; ?>" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Loan Amount <span class="required">*</span></label>
                                                <div class="col-md-6">
                                                    <input type="text" name="loan_amount" value="<?php echo $edit_data['loan_amount']; ?>" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Loan Type <span class="required">*</span></label>
                                                <div class="col-md-6">
                                                    <input type="text" name="loan_type" value="<?php echo $edit_data['loan_type']; ?>" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <input type="hidden" name="idd" value="<?php echo $edit_data['idd']; ?>">
                                                    <button type="submit" name="update_page" value="Update" class="btn green">Update</button>
                                                    <a href="final.php" class="btn default">Cancel</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                        }
                    /* ---------- LIST VIEW - FINAL SANCTION ONLY ---------- */
                    else: 
                        // Build query for FINAL SANCTION only
                        $query = "SELECT * FROM apply_from WHERE loan_status='Final sanction'";
                        
                        // Apply filters if set
                        if(isset($_GET['from_date']) && !empty($_GET['from_date'])) {
                            $from_date = mysqli_real_escape_string($connect, $_GET['from_date']);
                            $query .= " AND DATE(adate) >= '$from_date'";
                        }
                        if(isset($_GET['to_date']) && !empty($_GET['to_date'])) {
                            $to_date = mysqli_real_escape_string($connect, $_GET['to_date']);
                            $query .= " AND DATE(adate) <= '$to_date'";
                        }
                        if(isset($_GET['search']) && !empty($_GET['search'])) {
                            $search = mysqli_real_escape_string($connect, $_GET['search']);
                            $query .= " AND (full_name LIKE '%$search%' OR mobile_no LIKE '%$search%')";
                        }
                        
                        $query .= " ORDER BY idd DESC";
                        $get_organic = mysqli_query($connect, $query);
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet box red">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-check-circle"></i> Final Sanction Applications
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>KYCC</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Employment</th>
                                                <th>Loan Amount</th>
                                                <th>Loan Type</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sno = 0;
                                            if(mysqli_num_rows($get_organic) > 0) {
                                                while($row = mysqli_fetch_assoc($get_organic)){
                                                    $sno++;
                                            ?>
                                            <tr>
                                                <td><?php echo $sno; ?></td>
                                                <td><strong>KYCC<?php echo $row['idd']; ?></strong></td>
                                                <td><?php echo $row['full_name']; ?></td>
                                                <td><?php echo $row['mobile_no']; ?></td>
                                                <td><?php echo $row['employment_type']; ?></td>
                                                <td>₹ <?php echo number_format($row['loan_amount']); ?></td>
                                                <td><?php echo $row['loan_type']; ?></td>
                                                <td>
                                                    <span class="status-badge status-final">
                                                        <i class="fa fa-check"></i> Final Sanction
                                                    </span>
                                                </td>
                                                <td class="action-buttons">
                                                    <!-- Status Update Form -->
                                                    <form id="status-form-<?php echo $row['idd']; ?>" method="post" style="display:inline;">
                                                        <input type="hidden" name="idd" value="<?php echo $row['idd']; ?>">
                                                        <select name="loan_status" class="form-control" style="width:120px; display:inline; margin-right:5px;" onchange="updateStatus(<?php echo $row['idd']; ?>)">
                                                            <option value="">Change Status</option>
                                                            <option value="Legal/Tech clearance">Legal/Tech clearance</option>
                                                            <option value="Loan docket creation">Loan docket creation</option>
                                                            <option value="Disbursement">Disbursement</option>
                                                        </select>
                                                        <input type="hidden" name="update_status" value="Update Status">
                                                    </form>
                                                    
                                                    <a href="?action=edit&id=<?php echo $row['idd']; ?>" class="btn btn-warning btn-xs">
                                                        <i class="fa fa-pencil"></i> Edit
                                                    </a>
                                                    <a href="javascript:;" onclick="delete_menu('final.php?action=delete&nwsevnt_id=<?php echo $row['idd']; ?>')" class="btn btn-danger btn-xs">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php 
                                                }
                                            } else {
                                                echo '<tr><td colspan="9" class="text-center">No Final Sanction records found</td></tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    
                                    <!-- Summary -->
                                    <div class="row" style="margin-top:15px;">
                                        <div class="col-md-12">
                                            <p>
                                                <strong>Total Final Sanction Records: <?php echo $sno; ?></strong>
                                                <?php if(isset($_GET['from_date']) || isset($_GET['to_date']) || isset($_GET['search'])): ?>
                                                    <a href="final.php" class="btn btn-xs btn-default" style="margin-left:10px;">Clear Filters</a>
                                                <?php endif; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

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

    <!-- BEGIN CORE PLUGINS -->
    <script src="assets/global/plugins/jquery.min.js"></script>
    <script src="assets/global/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/global/plugins/js.cookie.min.js"></script>
    <script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/global/plugins/jquery.blockui.min.js"></script>
    <script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <!-- END CORE PLUGINS -->
    
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="assets/global/scripts/datatable.js"></script>
    <script src="assets/global/plugins/datatables/datatables.min.js"></script>
    <script src="assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="assets/global/scripts/app.min.js"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="assets/layouts/layout/scripts/layout.min.js"></script>
    <script src="assets/layouts/layout/scripts/demo.min.js"></script>
    <!-- END THEME LAYOUT SCRIPTS -->

    <script>
        // Initialize tooltips
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</body>
</html>