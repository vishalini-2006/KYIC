<?php
include 'config.php';

if (isset($_POST['applybutton']) && $_POST['applybutton'] == 'add') {
    $phoneno = trim($_POST['phoneno'] ?? '');
    echo "<script type='text/javascript'>window.location = 'trackapplication.php?id=" . urlencode($phoneno) . "'</script>";
    exit;
}
$ID = $_GET['id'] ?? '';
?>
<!doctype html>
<html lang="en">
<head>
    <title>KYC Finserv - Track Application</title>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-11244105677"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'AW-11244105677');
    </script>

    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="public/front/image/kyc1.jpeg" rel="shortcut icon" />
    
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="public/front/css/sabka-loan.css">
    <link href="public/front/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/front/css/bootsnav.css" rel="stylesheet">
    <link href="public/front/css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="public/front/css/responsive-custom.css">
    
    <!--fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="public/front/js/jquery.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-default bootsnav">
        <div class="container">
            <?php include 'header.php'; ?>
        </div>
    </nav>

    <div class="sabkaloan-about-us" style="background: url('public/front/image/contact-banner.png') no-repeat center center; background-color: #0626e0;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 sabkaloan-banner-contact">
                    Track Your <span>Application</span>
                </div>
                <div class="col-md-12">
                    <hr class="contact-us-hr">
                </div>
            </div>
        </div>
    </div>

    <div class="contact-sabkaloan">
        <div class="container">
            <div class="row" style="display: flex; justify-content: center;">
                <div class="col-md-8 col-sm-10 col-xs-12">
                    <div class="thumbnail" style="background: #0626e0; border-radius: 16px; padding: 30px 25px; box-shadow: 0 6px 20px rgba(0,0,0,0.15);">
                        <div class="sabkaloan-tags" style="color:#fff; font-size: 24px;">Check Application Status</div>
                        <hr class="hr-tag" style="background:#ffd600; margin: 8px 0 18px;">
                        <p style="color:#fff; font-size: 14px;">Please enter your registered 10-digit mobile number to track the real-time processing status of your loan.</p>
                        
                        <form action="" method="POST" style="margin-bottom: 25px;">
                            <div class="row">
                                <div class="col-sm-8 col-xs-12" style="margin-bottom: 12px;">
                                    <input type="tel" name="phoneno" id="phoneno" class="form-control" placeholder="Enter 10 Digit Mobile Number" maxlength="10" value="<?php echo htmlspecialchars($ID); ?>" required style="height: 44px; border-radius: 8px;">
                                </div>
                                <div class="col-sm-4 col-xs-12">
                                    <button type="submit" name="applybutton" value="add" class="sabkaloan-apply" style="margin-top: 0; padding: 11px; height: 44px; background: #ffd600 !important; color: #0626e0 !important; font-weight: 700;">
                                        Track Status
                                    </button>
                                </div>
                            </div>
                        </form>

                        <?php
                        if (!empty($ID)) {
                            $clean_id = mysqli_real_escape_string($connect, $ID);
                            $query = "SELECT full_name, loan_status, reason, cibil_score, loan_amount, rate_of_intrest, distributed_loan_amount 
                                      FROM apply_from WHERE mobile_no='$clean_id' ORDER BY idd DESC LIMIT 1";
                            $result = mysqli_query($connect, $query);

                            if ($result && mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                                $full_name = $row['full_name'] ?? '';
                                $loan_status = !empty($row['loan_status']) ? $row['loan_status'] : 'In Review / Pending';
                                $reason = $row['reason'] ?? '';
                                $cibil = $row['cibil_score'] ?? 'Under Evaluation';
                                $loan_amount = $row['loan_amount'] ?? '';
                                $rate_of_intrest = $row['rate_of_intrest'] ?? '';
                                $distributed_loan_amount = $row['distributed_loan_amount'] ?? '';
                        ?>
                                <div style="background: rgba(255,255,255,0.12); padding: 20px; border-radius: 10px; margin-top: 15px; border: 1px solid rgba(255,255,255,0.2);">
                                    <h3 style="color:#fff; font-size: 20px; margin: 0 0 10px;">
                                        Applicant Name: <span style="color:#ffd600;"><?php echo htmlspecialchars($full_name); ?></span>
                                    </h3>
                                    <h4 style="color: #fff; font-size: 18px; margin: 0 0 10px;">
                                        Loan Status: <span style="color:#ffd600; font-weight: bold;"><?php echo htmlspecialchars($loan_status); ?></span>
                                    </h4>
                                    
                                    <?php if (!empty($loan_amount)): ?>
                                        <p style="color:#fff; font-size: 15px; margin: 5px 0;">Applied Loan Amount: <b>Rs. <?php echo htmlspecialchars($loan_amount); ?></b></p>
                                    <?php endif; ?>

                                    <?php if ($loan_status == 'Disbursement' || !empty($distributed_loan_amount)): ?>
                                        <p style="color:#a3e635; font-size: 16px; margin: 5px 0;">Disbursed Amount: <b>Rs. <?php echo htmlspecialchars($distributed_loan_amount); ?></b></p>
                                        <p style="color:#a3e635; font-size: 16px; margin: 5px 0;">Approved Rate of Interest: <b><?php echo htmlspecialchars($rate_of_intrest); ?> %</b></p>
                                    <?php endif; ?>

                                    <?php if ($loan_status === 'cancelled' && !empty($reason)): ?>
                                        <p style="color:#f87171; font-size: 15px; margin: 5px 0;">Reason: <b><?php echo htmlspecialchars($reason); ?></b></p>
                                    <?php endif; ?>
                                </div>
                        <?php
                            } else {
                                echo "<div style='background: rgba(255,255,255,0.12); padding: 15px; border-radius: 8px; color: #ffd600; font-size: 15px;'>No application record found for mobile number: <b>" . htmlspecialchars($ID) . "</b>. Please check the number or submit a new application.</div>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootsnavs Scripts -->
    <script src="public/front/js/bootstrap.min.js"></script>
    <script src="public/front/js/bootsnav.js"></script>
    <script type="text/javascript" src="public/front/js/fontawesome.js"></script>

    <?php include 'footer.php'; ?>
</body>
</html>
