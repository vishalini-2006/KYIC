<?php
session_start();
include_once 'function.php';

// Update record
if (isset($_POST['update'])) {
    $id = mysqli_real_escape_string($connect, $_POST['s_no']);
    $bank_name = mysqli_real_escape_string($connect, $_POST['bankname']);
    $employee_name = mysqli_real_escape_string($connect, $_POST['employeename']);
    $employee_number = mysqli_real_escape_string($connect, $_POST['employeenumber']);
    
    $update_query = "UPDATE bank_details SET 
                     bank_name = '$bank_name',
                     employee_name = '$employee_name',
                     employee_number = '$employee_number' 
                     WHERE s_no = '$id'";
    
    if (mysqli_query($connect, $update_query)) {
        echo "<script>alert('Record updated successfully');</script>";
        echo "<script>window.location = 'bank_details.php';</script>";
        exit();
    } else {
        $error = "Error updating record: " . mysqli_error($connect);
    }
}

// Fetch record for editing
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($connect, $_GET['id']);
    $query = "SELECT * FROM bank_details WHERE s_no = '$id'";
    $result = mysqli_query($connect, $query);
    
    if (mysqli_num_rows($result) == 0) {
        echo "<script>window.location = 'bank_details.php';</script>";
        exit();
    }
    
    $row = mysqli_fetch_assoc($result);
} else {
    echo "<script>window.location = 'bank_details.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Edit Bank Details | KYC Finserv</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
    <div class="page-wrapper">
        <?php include("header.php");?>
        <div class="clearfix"></div>
        
        <div class="page-container">
            <div class="page-sidebar-wrapper">
                <?php include("menu.php");?>
            </div>
            
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <a href="index.php">Home</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <a href="bank_details.php">Bank Details</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>Edit</span>
                            </li>
                        </ul>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light portlet-fit portlet-form bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-edit font-blue" aria-hidden="true"></i>
                                        <span class="caption-subject font-blue sbold uppercase">EDIT BANK DETAILS</span>
                                    </div>
                                    <div class="actions">
                                        <a href="bank_details.php" class="btn btn-sm default">
                                            <i class="fa fa-arrow-left"></i> Back
                                        </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <?php if (isset($error)) { ?>
                                        <div class="alert alert-danger"><?php echo $error; ?></div>
                                    <?php } ?>
                                    
                                    <form action="" method="post" class="form-horizontal">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Bank Name <span class="required">*</span></label>
                                                <div class="col-md-6">
                                                    <input type="text" name="bankname" class="form-control" 
                                                           value="<?php echo htmlspecialchars($row['bank_name']); ?>" required/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Employee Name <span class="required">*</span></label>
                                                <div class="col-md-6">
                                                    <input type="text" name="employeename" class="form-control" 
                                                           value="<?php echo htmlspecialchars($row['employee_name']); ?>" required/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Employee Number</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="employeenumber" class="form-control" 
                                                           value="<?php echo htmlspecialchars($row['employee_number']); ?>" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-offset-2 col-md-6">
                                                    <input type="hidden" name="s_no" value="<?php echo $row['s_no']; ?>" />
                                                    <button type="submit" name="update" class="btn green">
                                                        <i class="fa fa-save"></i> Update
                                                    </button>
                                                    <a href="bank_details.php" class="btn default">
                                                        <i class="fa fa-times"></i> Cancel
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php include("footer.php");?>
    </div>

    <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
    <script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
    <script src="assets/global/scripts/app.min.js" type="text/javascript"></script>
    <script src="assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
</body>
</html>