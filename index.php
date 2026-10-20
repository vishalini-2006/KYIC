<?php include 'cgi-bin/.kyc'; ?>
<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include 'config.php';

$id = $_GET['id'] ?? '';
if(isset($_POST['application']))
{
    $full_name = $_POST['full_name'];
    $mobile_no = $_POST['mobile_no'];
    $employment_type = $_POST['employment_type'];
    $loan_amount = $_POST['loan_amount'];
    $loan_type = $_POST['loan_type'];
    $referedby = $_POST['referedby'] ?? '';

    $get_documeasnt = mysqli_query($connect,"SELECT * FROM `document` where id = '$loan_type' ") or die(mysqli_error($connect));
    while($get_document_valusae = mysqli_fetch_array($get_documeasnt)) 
    {
        $loan_type = $get_document_valusae['document_name'];
    }

    $newsid = '';
    if(!empty($referedby)) {
        $get_organisdc = mysqli_query($connect,"SELECT * FROM `reference` where reference_name = '$referedby'") or die(mysqli_error($connect));
        while($get_vasalue = mysqli_fetch_array($get_organisdc)) 
        {
            $newsid = $get_vasalue['reference_name'];
        }
    }

    if(empty($referedby) || $referedby == $newsid){
        echo "<div style='width: 350px; text-align: center; margin: 20% auto 0px; font-family: arial; font-size: 14px; border: 1px solid #ddd; padding: 20px 40px;'> 
        Please wait while we update loading . Thank you for your application we will get back to you shortly...</div>";
        
        mysqli_query($connect,"INSERT into `apply_from`(`referedby`, `full_name`, `mobile_no`, `employment_type`, `loan_amount`, `loan_type`)
        VALUES ('$referedby','$full_name','$mobile_no','$employment_type','$loan_amount','$loan_type')") or die(mysqli_error($connect));
        
        echo "<script type='text/javascript'>window.location = 'index.php'</script>";
    } else {
        echo "<script type='text/javascript'>alert('Reference ID miss match please check again .')</script>";
        echo "<script type='text/javascript'>window.location = 'index.php'</script>";
    }
}

// Get next ID
$globalid = '1';
$get_organicas = mysqli_query($connect,"SELECT * FROM `apply_from` ORDER BY idd DESC LIMIT 0,1") or die(mysqli_error($connect));
if($get_organicas && mysqli_num_rows($get_organicas) > 0) {
    while($get_valuesd = mysqli_fetch_array($get_organicas)) 
    {
        $globalid = $get_valuesd['idd'];
        $globalid = $globalid + 1;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>KYC Finserv - Home</title>
 
    <meta charset="UTF-8">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
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
    
    <!--fonts end-->
    <link type="text/css" rel="stylesheet" href="public/front/css/carousel-main.css">
</head>

<body>
    <nav class="navbar navbar-default bootsnav">
        <div class="container">
            <?php include 'header.php'; ?>
        </div>
    </nav>

    <div class="sabkaloan-top" id="apply">            
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-5 hidden-xs">
                    <div style="padding: 40px 10px; color: #ffffff;">
                        <h1 style="font-size: 38px; font-weight: 800; line-height: 1.2; text-shadow: 0 2px 8px rgba(0,0,0,0.5);">
                            Quick &amp; Hassle-Free Financial Assistance
                        </h1>
                        <p style="font-size: 18px; margin-top: 15px; color: rgba(255,255,255,0.9); line-height: 1.5;">
                            Partnered with 50+ Banks &amp; NBFCs for the best interest rates on Home, Personal &amp; Business Loans.
                        </p>
                    </div>
                </div>
                
                <div class="col-md-6 col-sm-7 col-xs-12">
                    <div class="sabkaloan-banner-form" id="forms">
                        <div class="applycation-form">Application Form</div>
                        <hr class="hr-line">
                        <div style="text-align: center; color: #d9534f; font-size: 13px; font-weight: 600; margin-bottom: 12px; line-height: 1.4;">          
                            ✓ CIBIL Score 500 இருந்தால் போதும்<br>
                            ✓ Interest depends on the level of CIBIL score
                        </div>
                        <div style="font-size: 12px; color: #333; margin-bottom: 15px; background: #f0f4ff; padding: 8px 12px; border-radius: 6px; line-height: 1.5;">   
                            <b>KYC FINSERV இன் சிறப்பு அம்சங்கள்:</b><br>
                            • குறைவான வட்டிக்கு வங்கியில் கடன் பெற்றுத்தருதல்.<br>
                            • ஒரு வங்கியில் உள்ள கடனை மற்றொரு வங்கிக்கு எளிமையாக மாற்றி தருதல்.
                        </div>
                        
                        <form id="contact-form" method="post" action="">
                            <?php if($id != '') { ?>
                                <input type="hidden" name="gpsLocation" id="gpsLocation">
                                <div class="form-group" style="margin-bottom: 10px;">
                                    <input type="text" name="referedby" class="form-control" readonly value="<?php echo htmlspecialchars($id); ?>" placeholder="Reference code" />
                                </div>
                            <?php } ?>
                            
                            <div class="row">
                                <div class="col-sm-6 col-xs-12" style="margin-bottom: 10px;">
                                    <label>KYCC Number <span style="color:#F00;">*</span></label>
                                    <input type="text" name="cusid" class="form-control" value="KYCC<?php echo $globalid; ?>" readonly/>
                                </div>
                                
                                <div class="col-sm-6 col-xs-12" style="margin-bottom: 10px;">
                                    <label>Full Name <span style="color:#F00;">*</span></label>
                                    <input type="text" name="full_name" class="form-control" placeholder="As on Pan Card" required/>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-6 col-xs-12" style="margin-bottom: 10px;">
                                    <label>Mobile Number <span style="color:#F00;">*</span></label>
                                    <input type="tel" name="mobile_no" id="mobile" maxlength="10" minlength="10" pattern="[5-9]{1}[0-9]{9}" class="form-control" placeholder="10 Digit Mobile" required/>
                                </div>
                                
                                <div class="col-sm-6 col-xs-12" style="margin-bottom: 10px;">
                                    <label>தொழில் வகை <span style="color:red;">*</span></label>
                                    <select class="form-control" name="employment_type" id="employeeType" required>
                                        <option value="">Select Employment</option>
                                        <option value="Salaried">Salaried</option>
                                        <option value="SelfEmployed">Self Employed</option>
                                        <option value="Daily wages">Daily Wages</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-6 col-xs-12" style="margin-bottom: 10px;">
                                    <label>Loan Amount <span style="color:#F00;">*</span></label>
                                    <input type="number" name="loan_amount" id="loan_amount" class="form-control" placeholder="Enter Loan Amount" required>
                                    <div id="loan_amount_words1" style="font-size: 11px; color: #0626e0; font-weight: 600; margin-top: 3px; min-height: 15px;"></div>
                                </div>
                                
                                <div class="col-sm-6 col-xs-12" style="margin-bottom: 10px;">
                                    <label>Loan Type <span style="color:#F00;">*</span></label>
                                    <select class="form-control" name="loan_type" id="mySelect" required>
                                        <option value="">Select Loan Type</option>
                                        <?php
                                        $get_document = mysqli_query($connect,"SELECT * FROM `document` ") or die(mysqli_error($connect));
                                        if($get_document) {
                                            while($get_document_value = mysqli_fetch_array($get_document)) 
                                            {
                                                $documentid = $get_document_value['id'];
                                                $document_name = $get_document_value['document_name'];
                                                echo "<option value='".htmlspecialchars($documentid)."'>".htmlspecialchars($document_name)."</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            
                            <p class="sabkaloan-banner-form-dnc">
                                By clicking on Apply, I authorize KYC Finserv &amp; its representatives to Call, SMS or communicate via WhatsApp regarding my application.
                            </p>
                            
                            <input type="hidden" name="utm_source" value="">
                            
                            <button type="submit" name="application" value="add" class="sabkaloan-apply">Apply Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- About Section -->
    <div class="container">
        <div class="about-home-page" id="about">
            <div class="row">
                <div class="col-md-12">
                    <div class="sabkaloan-tags">About Loan</div>
                    <hr class="hr-tag">
                    <p>
                        KYC Finserv is a Direct Selling Agent or a loan distributor that has partnered with 50+ banks and financial institutions to meet your financing needs.
                        KYC Finserv has disbursed several financial products to individuals such as Home Loans, Personal Loans, Business loan, Loans Against Property, Vehicle Loan, Credit Card, etc.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Leading Partners Section -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="sabkaloan-tags">Our Leading Partners</div>
                <hr class="hr-tag">
                <div class="logo-slider-container">
                    <div class="logo-slider">
                        <div class="logo-slider-inner">
                            <?php
                            $logos = ['logo1.png', 'logo6.avif', 'dcb.webp', 'esaf.png', 'easy.avif', 'adhitya.webp', 'chola.png', 'idfc.png', 'piramal.png', 'download.png'];
                            foreach ($logos as $logo) {
                                echo "<div class='logo-item'><img src='bank_logo/$logo' alt='Bank Partner Logo'></div>";
                            }
                            foreach ($logos as $logo) {
                                echo "<div class='logo-item'><img src='bank_logo/$logo' alt='Bank Partner Logo'></div>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Number to words conversion
    var a = ['','one ','two ','three ','four ', 'five ','six ','seven ','eight ','nine ','ten ','eleven ','twelve ','thirteen ','fourteen ','fifteen ','sixteen ','seventeen ','eighteen ','nineteen '];
    var b = ['', '', 'twenty','thirty','forty','fifty', 'sixty','seventy','eighty','ninety'];

    function inWords (num) {
        if (!num || isNaN(num)) return '';
        if ((num = num.toString()).length > 9) return 'overflow';
        n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
        if (!n) return ''; var str = '';
        str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
        str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
        str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
        str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
        str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + 'only ' : '';
        return str;
    }

    var loanAmtInput = document.getElementById('loan_amount');
    if (loanAmtInput) {
        loanAmtInput.onkeyup = function () {
            document.getElementById('loan_amount_words1').innerHTML = inWords(this.value);
        };
    }
    </script>

    <!-- Bootsnavs Scripts -->
    <script src="public/front/js/jquery.min.js"></script>
    <script src="public/front/js/bootstrap.min.js"></script>
    <script src="public/front/js/bootsnav.js"></script>
    <script type="text/javascript" src="public/front/js/fontawesome.js"></script>
    
    <script>
    $(document).ready(function() {
        // Partners logo slider
        function moveSlider(slider) {
            const logoInner = slider.querySelector('.logo-slider-inner');
            const logoItems = slider.querySelectorAll('.logo-item');
            if(!logoItems || logoItems.length === 0) return;
            
            let currentLogoIndex = 0;
            const logoItemWidth = logoItems[0].offsetWidth || 120;

            setInterval(function () {
                currentLogoIndex++;
                if (currentLogoIndex >= logoItems.length / 2) {
                    logoInner.style.transition = 'none';
                    logoInner.style.transform = 'translateX(0)';
                    currentLogoIndex = 0;
                    setTimeout(() => {
                        logoInner.style.transition = 'transform 0.5s ease-in-out';
                    }, 50);
                } else {
                    logoInner.style.transform = `translateX(-${currentLogoIndex * logoItemWidth}px)`;
                }
            }, 2200);
        }

        const sliders = document.querySelectorAll('.logo-slider');
        sliders.forEach(slider => {
            moveSlider(slider);
        });
    });
    </script>

    <?php include 'footer.php'; ?>

</body>
</html>