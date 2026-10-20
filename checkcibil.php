<?php
include 'config.php';
$id = $_GET['id'] ?? '';
?>
<!doctype html>
<html lang="en">
<head>
    <title>KYC Finserv - Check CIBIL Score</title>
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

    <div class="sabkaloan-about-us" style="background: url('public/front/image/instant-personal-loans.jpg') no-repeat center center;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 sabkaloan-banner-about">
                    Check Your Credit Score Online - Free &amp; Secure
                </div>
            </div>
        </div>
    </div>

    <div class="centered-container">
        <div class="cform-container" style="text-align: center;">
            <h2 class="applycation-form" style="font-size: 26px; margin-bottom: 8px;">Check Your Free CIBIL Score</h2>
            <hr class="hr-line">
            <p style="color: #666; font-size: 15px; margin-bottom: 25px;">
                Know your credit score before applying for a loan to get the highest eligibility and best interest rates.
            </p>
            
            <div style="margin: 25px 0;">
                <a href="https://myscore.cibil.com/CreditView/enrollShort_new.page?enterprise=CIBIL&offer=FACRA" target="_blank" class="sabkaloan-apply" style="display: inline-block; width: auto; padding: 14px 30px; font-size: 16px; border-radius: 8px;">
                    Go to Official CIBIL Portal <i class="fa fa-external-link"></i>
                </a>
            </div>

            <div style="margin-top: 30px; border-top: 1px solid #e2e8f0; padding-top: 25px;">
                <h4 style="font-weight: 700; color: #1c2c5e;">Experian Credit Score Verification</h4>
                <div style="width: 100%; height: 500px; border: 1px solid #ddd; border-radius: 10px; overflow: hidden; margin-top: 15px;">
                    <iframe src="https://consumer.experian.in/ECV-OLN/view/angular/#/" style="width: 100%; height: 100%; border: none;"></iframe>
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
