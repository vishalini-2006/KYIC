<?php
session_start();
include_once 'function.php';

// Add Record
if(isset($_POST['add']) && $_POST['add'] == 'Create') {
    $full_name = $_POST['full_name'];
    $employment_type = $_POST['employment_type'];
    $pan = $_POST['pan'];
    $dob = $_POST['dob'];
    $state = $_POST['state'];
    $pin_code = $_POST['pin_code'];
    $mobile_no = $_POST['mobile_no'];
    $email = $_POST['email'];
    $aadhar_no = $_POST['aadhar_no'];
    $gender = $_POST['gender'];
    $city = $_POST['city'];
    $loan_amount = $_POST['loan_amount'];
    $referedby = $_POST['referedby'];
    $loan_type = $_POST['loan_type'];

    mysqli_query($connect, "INSERT INTO apply_from (`full_name`,`referedby`,`employment_type`,`pan`,`dob`,`state`,`pin_code`,`mobile_no`,`email`,`aadhar_no`,`gender`,`city`,`loan_amount`,`loan_type`, `loan_status`) 
    VALUES ('$full_name','$referedby','$employment_type','$pan','$dob','$state','$pin_code','$mobile_no','$email','$aadhar_no','$gender','$city','$loan_amount','$loan_type', 'Disbursement')") or die(mysqli_error($connect));

    echo "<div style='width:350px; text-align:center; margin:20% auto; font-family:arial; font-size:14px; border:1px solid #ddd; padding:20px 40px;'> 
    Please wait while we update loading...</div>";
    echo "<script type='text/javascript'>window.location = 'disbursement.php?msg=added&action=list'</script>";
}

// Update Record
if(isset($_POST['update_page']) && $_POST['update_page'] == 'Update') {
    $newsid = $_POST['idd'];
    $full_name = $_POST['full_name'];
    $employment_type = $_POST['employment_type'];
    $pan = $_POST['pan'];
    $dob = $_POST['dob'];
    $state = $_POST['state'];
    $pin_code = $_POST['pin_code'];
    $mobile_no = $_POST['mobile_no'];
    $email = $_POST['email'];
    $aadhar_no = $_POST['aadhar_no'];
    $gender = $_POST['gender'];
    $city = $_POST['city'];
    $loan_amount = $_POST['loan_amount'];
    $referedby = $_POST['referedby'];
    $loan_type = $_POST['loan_type'];

    mysqli_query($connect, "UPDATE apply_from SET 
        `full_name`='$full_name',
        `referedby`='$referedby',
        `employment_type`='$employment_type',
        `pan`='$pan',
        `dob`='$dob',
        `state`='$state',
        `pin_code`='$pin_code',
        `mobile_no`='$mobile_no',
        `email`='$email',
        `aadhar_no`='$aadhar_no',
        `gender`='$gender',
        `city`='$city',
        `loan_amount`='$loan_amount',
        `loan_type`='$loan_type' 
        WHERE idd='$newsid'") or die(mysqli_error($connect));
    
    echo "<div style='width:350px; text-align:center; margin:20% auto; font-family:arial; font-size:14px; border:1px solid #ddd; padding:20px 40px;'> 
    Please wait while we update loading...</div>";
    echo "<script type='text/javascript'>window.location = 'disbursement.php?msg=updated&action=list'</script>";
}

// Update Status
if(isset($_POST['updateadd']) && $_POST['updateadd'] == 'Submit') {
    $newsid = $_POST['idd'];
    $loan_status = $_POST['loan_status'];
    $d_loan_amount = $_POST['distributed_loan_amount'];
    $r_of_intrest = $_POST['rate_of_intrest'];

    mysqli_query($connect, "UPDATE apply_from SET 
        `loan_status`='$loan_status',
        `distributed_loan_amount`='$d_loan_amount', 
        `rate_of_intrest`='$r_of_intrest' 
        WHERE idd='$newsid'") or die(mysqli_error($connect));
    
    echo "<div style='width:350px; text-align:center; margin:20% auto; font-family:arial; font-size:14px; border:1px solid #ddd; padding:20px 40px;'> 
    Please wait while we update loading...</div>";
    
    if($loan_status == 'Case login'){
        echo "<script type='text/javascript'>window.location = 'caselogin.php?msg=updated&action=list'</script>";
    }elseif($loan_status == 'Questioned documents examination (QDE)'){
        echo "<script type='text/javascript'>window.location = 'qde.php?msg=updated&action=list'</script>";
    }elseif($loan_status == 'Probability of Default Examination (PDE)'){
        echo "<script type='text/javascript'>window.location = 'pde.php?msg=updated&action=list'</script>";
    }elseif($loan_status == 'Credit appraisal'){
        echo "<script type='text/javascript'>window.location = 'creditappraisal.php?msg=updated&action=list'</script>";
    }elseif($loan_status == 'Financial sanction'){
        echo "<script type='text/javascript'>window.location = 'financial.php?msg=updated&action=list'</script>";
    }elseif($loan_status == 'Final sanction'){
        echo "<script type='text/javascript'>window.location = 'final.php?msg=updated&action=list'</script>";
    }elseif($loan_status == 'Legal/Tech clearance'){
        echo "<script type='text/javascript'>window.location = 'legal.php?msg=updated&action=list'</script>";
    }elseif($loan_status == 'Loan docket creation'){
        echo "<script type='text/javascript'>window.location = 'local.php?msg=updated&action=list'</script>";
    }elseif($loan_status == 'Disbursement'){
        echo "<script type='text/javascript'>window.location = 'disbursement.php?msg=updated&action=list'</script>";
    }elseif($loan_status == 'Loan Account Number Generation'){
        echo "<script type='text/javascript'>window.location = 'loannumber.php?msg=updated&action=list'</script>";
    }else{
        echo "<script type='text/javascript'>window.location = 'disbursement.php'</script>";
    }
}

// Delete Record
if(isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = intval($_GET['nwsevnt_id']);
    mysqli_query($connect, "DELETE FROM apply_from WHERE idd=$id") or die(mysqli_error($connect));
    
    echo "<div style='width:350px; text-align:center; margin:20% auto; font-family:arial; font-size:14px; border:1px solid #ddd; padding:20px 40px;'>
    Please wait while we update the record loading...</div>";
    echo "<script type='text/javascript'>window.location = 'disbursement.php?msg=deleted&action=list'</script>";
}

// Get total disbursement count
$count_query = mysqli_query($connect, "SELECT COUNT(*) as total FROM apply_from WHERE loan_status='Disbursement'");
$count_data = mysqli_fetch_assoc($count_query);
$total_disbursement = $count_data['total'];
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="ta" xml:lang="ta">
<head>
    <meta charset="utf-8" />
    <title>Disbursement Applications | <?php echo $site_title; ?></title>
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
        .status-badge {
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: bold;
            color: white;
            display: inline-block;
        }
        .status-disbursement { 
            background-color: #5cb85c; 
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
        }
        .filter-box {
            margin-bottom: 15px;
            padding: 15px;
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .action-buttons a {
            margin-right: 5px;
        }
        .total-box {
            background: #102bb2;
            color: white;
            padding: 8px 15px;
            border-radius: 4px;
            font-weight: bold;
            display: inline-block;
        }
        .amount-disbursed {
            font-weight: bold;
            color: #5cb85c;
        }
    </style>
    
    <script>
        function delete_menu(idurl) {
            if(confirm("Are you sure you want to delete this record?")) {
                document.location.href = idurl;
            }
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
                            <li><span>Disbursement Applications</span></li>
                        </ul>
                        <div class="page-toolbar">
                            <div class="total-box">
                                <i class="fa fa-money"></i> Total Disbursed: <?php echo $total_disbursement; ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Success/Error Messages -->
                    <?php if(isset($_GET['msg'])): ?>
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                            <?php 
                            if($_GET['msg'] == 'added') echo "Record added successfully!";
                            if($_GET['msg'] == 'updated') echo "Record updated successfully!";
                            if($_GET['msg'] == 'deleted') echo "Record deleted successfully!";
                            ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php
                    // Main List View - SHOW ONLY DISBURSEMENT RECORDS
                    if(!isset($_GET['action']) || $_GET['action'] == 'list'):
                    ?>
                    <!-- Page Title -->
                    <h3 class="page-title">Disbursement Applications 
                        <small>Disbursed Loan Records</small>
                    </h3>
                    
                    <!-- Filter and Actions -->
                    <div class="filter-box">
                        <div class="row">
                            <div class="col-md-8">
                                <form method="GET" action="" class="form-inline">
                                    <input type="hidden" name="action" value="list">
                                    <div class="form-group">
                                        <label>From Date:</label>
                                        <input type="date" name="from_date" class="form-control" style="width:150px; margin:0 5px;" value="<?php echo isset($_GET['from_date']) ? $_GET['from_date'] : ''; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>To Date:</label>
                                        <input type="date" name="to_date" class="form-control" style="width:150px; margin:0 5px;" value="<?php echo isset($_GET['to_date']) ? $_GET['to_date'] : ''; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Search:</label>
                                        <input type="text" name="search" class="form-control" placeholder="Name or Mobile" style="width:200px; margin:0 5px;" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Apply Filter</button>
                                    <a href="disbursement.php?action=list" class="btn btn-default">Reset</a>
                                </form>
                            </div>
                            <div class="col-md-4 text-right">
                                <a href="?action=add" class="btn btn-success">
                                    <i class="fa fa-plus"></i> Add New Application
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Main Table - ONLY DISBURSEMENT RECORDS -->
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-money"></i> Disbursed Loan Applications
                            </div>
                        </div>
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover" id="sample_2">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>KYCC</th>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Employment</th>
                                        <th>Loan Amount</th>
                                        <th>Disbursed Amount</th>
                                        <th>Interest Rate</th>
                                        <th>Loan Type</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sno = 0;
                                    $from_date = isset($_GET['from_date']) ? $_GET['from_date'] : '';
                                    $to_date = isset($_GET['to_date']) ? $_GET['to_date'] : '';
                                    $search = isset($_GET['search']) ? $_GET['search'] : '';
                                    
                                    // Build query for DISBURSEMENT only
                                    $query = "SELECT * FROM apply_from WHERE loan_status='Disbursement'";
                                    
                                    // Add date filter
                                    if(!empty($from_date) && !empty($to_date)) {
                                        $query .= " AND DATE(adate) BETWEEN '$from_date' AND '$to_date'";
                                    } elseif(!empty($from_date)) {
                                        $query .= " AND DATE(adate) >= '$from_date'";
                                    } elseif(!empty($to_date)) {
                                        $query .= " AND DATE(adate) <= '$to_date'";
                                    }
                                    
                                    // Add search filter
                                    if(!empty($search)) {
                                        $query .= " AND (full_name LIKE '%$search%' OR mobile_no LIKE '%$search%')";
                                    }
                                    
                                    $query .= " ORDER BY idd DESC";
                                    
                                    $get_organic = mysqli_query($connect, $query) or die(mysqli_error($connect));
                                    
                                    if(mysqli_num_rows($get_organic) > 0) {
                                        while($row = mysqli_fetch_assoc($get_organic)):
                                            $sno++;
                                            $product_id = $row['idd'];
                                    ?>
                                    <tr>
                                        <td><?php echo $sno; ?></td>
                                        <td><strong>KYCC<?php echo $product_id; ?></strong></td>
                                        <td><?php echo date('d-m-Y', strtotime($row['adate'])); ?></td>
                                        <td><?php echo $row['full_name']; ?></td>
                                        <td><?php echo $row['mobile_no']; ?></td>
                                        <td><?php echo $row['employment_type']; ?></td>
                                        <td>₹ <?php echo number_format($row['loan_amount']); ?></td>
                                        <td class="amount-disbursed">
                                            <?php if($row['distributed_loan_amount']): ?>
                                                ₹ <?php echo number_format($row['distributed_loan_amount']); ?>
                                            <?php else: ?>
                                                <span class="label label-warning">Not Set</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($row['rate_of_intrest']): ?>
                                                <?php echo $row['rate_of_intrest']; ?>%
                                            <?php else: ?>
                                                <span class="label label-warning">Not Set</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $row['loan_type']; ?></td>
                                        <td>
                                            <span class="status-disbursement">
                                                <i class="fa fa-check-circle"></i> Disbursed
                                            </span>
                                        </td>
                                        <td class="action-buttons">
                                            <a class="btn btn-warning btn-xs" href="disbursement.php?action=edit&nwsevnt_id=<?php echo base64_encode($product_id); ?>">
                                                <i class="fa fa-pencil"></i> Edit
                                            </a>
                                            <a class="btn btn-success btn-xs" href="inv.php?id=<?php echo $product_id; ?>" target="_blank">
                                                <i class="fa fa-print"></i> Print
                                            </a>
                                            <a class="btn btn-xs red" onClick="delete_menu('disbursement.php?action=delete&nwsevnt_id=<?php echo $product_id; ?>')" href="javascript:;">
                                                <i class="fa fa-trash"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                    <?php 
                                        endwhile;
                                    } else {
                                        echo '<tr><td colspan="12" class="text-center">No disbursement records found</td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                            
                            <!-- Record Count -->
                            <div class="row">
                                <div class="col-md-12">
                                    <p><strong>Total Disbursement Records: <?php echo $sno; ?></strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <?php
                    // Add Form
                    if(isset($_GET['action']) && $_GET['action'] == 'add'):
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light portlet-fit portlet-form bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-plus font-red"></i>
                                        <span class="caption-subject font-red sbold uppercase">Add New Disbursement Application</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <form action="" method="post" class="form-horizontal">
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
                                                <label class="col-md-3 control-label">PAN</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="pan" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Date of Birth</label>
                                                <div class="col-md-6">
                                                    <input type="date" name="dob" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">State</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="state" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Pin Code</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="pin_code" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Mobile Number <span class="required">*</span></label>
                                                <div class="col-md-6">
                                                    <input type="text" name="mobile_no" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Email</label>
                                                <div class="col-md-6">
                                                    <input type="email" name="email" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Aadhar Number</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="aadhar_no" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Gender</label>
                                                <div class="col-md-6">
                                                    <select name="gender" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">City</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="city" class="form-control">
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
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Referred By</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="referedby" class="form-control" value="<?php echo $Admin_admin_id; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Disbursed Amount</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="distributed_loan_amount" class="form-control" placeholder="Enter disbursed amount">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Interest Rate (%)</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="rate_of_intrest" class="form-control" placeholder="Enter interest rate">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" class="btn green" name="add" value="Create">Submit</button>
                                                    <button type="reset" class="btn grey-salsa btn-outline">Reset</button>
                                                    <a href="disbursement.php?action=list" class="btn btn-default">Cancel</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <?php
                    // Edit Form
                    if(isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['nwsevnt_id'])):
                        $NewsID = base64_decode($_GET["nwsevnt_id"]);
                        $get_about_edit = mysqli_query($connect, "SELECT * FROM apply_from WHERE idd='$NewsID'") or die(mysqli_error($connect));
                        $get_edit = mysqli_fetch_assoc($get_about_edit);
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light portlet-fit portlet-form bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-pencil font-red"></i>
                                        <span class="caption-subject font-red sbold uppercase">Edit Disbursement Application - KYCC<?php echo $get_edit['idd']; ?></span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <form action="" method="post" class="form-horizontal">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Full Name <span class="required">*</span></label>
                                                <div class="col-md-6">
                                                    <input type="text" name="full_name" value="<?php echo $get_edit['full_name']; ?>" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Employment Type <span class="required">*</span></label>
                                                <div class="col-md-6">
                                                    <input type="text" name="employment_type" value="<?php echo $get_edit['employment_type']; ?>" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">PAN</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="pan" value="<?php echo $get_edit['pan']; ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Date of Birth</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="dob" value="<?php echo $get_edit['dob']; ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">State</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="state" value="<?php echo $get_edit['state']; ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Pin Code</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="pin_code" value="<?php echo $get_edit['pin_code']; ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Mobile Number <span class="required">*</span></label>
                                                <div class="col-md-6">
                                                    <input type="text" name="mobile_no" value="<?php echo $get_edit['mobile_no']; ?>" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Email</label>
                                                <div class="col-md-6">
                                                    <input type="email" name="email" value="<?php echo $get_edit['email']; ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Aadhar Number</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="aadhar_no" value="<?php echo $get_edit['aadhar_no']; ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Gender</label>
                                                <div class="col-md-6">
                                                    <select name="gender" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="Male" <?php if($get_edit['gender']=='Male') echo 'selected'; ?>>Male</option>
                                                        <option value="Female" <?php if($get_edit['gender']=='Female') echo 'selected'; ?>>Female</option>
                                                        <option value="Other" <?php if($get_edit['gender']=='Other') echo 'selected'; ?>>Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">City</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="city" value="<?php echo $get_edit['city']; ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Loan Amount <span class="required">*</span></label>
                                                <div class="col-md-6">
                                                    <input type="text" name="loan_amount" value="<?php echo $get_edit['loan_amount']; ?>" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Loan Type <span class="required">*</span></label>
                                                <div class="col-md-6">
                                                    <input type="text" name="loan_type" value="<?php echo $get_edit['loan_type']; ?>" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Referred By</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="referedby" value="<?php echo $get_edit['referedby']; ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Disbursed Amount</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="distributed_loan_amount" value="<?php echo $get_edit['distributed_loan_amount']; ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Interest Rate (%)</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="rate_of_intrest" value="<?php echo $get_edit['rate_of_intrest']; ?>" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <input type="hidden" name="idd" value="<?php echo $get_edit['idd']; ?>">
                                                    <button type="submit" class="btn green" name="update_page" value="Update">Update</button>
                                                    <a href="disbursement.php?action=list" class="btn btn-default">Cancel</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                </div>
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
    
    <!-- BEGIN THEME SCRIPTS -->
    <script src="assets/global/scripts/app.min.js"></script>
    <script src="assets/layouts/layout/scripts/layout.min.js"></script>
    <script src="assets/layouts/layout/scripts/demo.min.js"></script>
    <!-- END THEME SCRIPTS -->
    
</body>
</html>