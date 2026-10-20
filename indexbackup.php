<?php include 'cgi-bin/.kyc'; ?>
<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include 'config.php';

$id = $_GET['id'];
if(isset($_POST['application']))
{
    $full_name = $_POST['full_name'];
    $mobile_no = $_POST['mobile_no'];
    $employment_type = $_POST['employment_type'];
    $loan_amount = $_POST['loan_amount'];
    $loan_type = $_POST['loan_type'];
    $referedby = $_POST['referedby'];

    $get_documeasnt = mysqli_query($connect,"SELECT * FROM `document` where id = '$loan_type' ") or die(mysqli_error($connect));
    while($get_document_valusae = mysqli_fetch_array($get_documeasnt)) 
    {
        $loan_type = $get_document_valusae['document_name'];
    }

    $get_organisdc = mysqli_query($connect,"SELECT * FROM `reference` where reference_name = '$referedby'") or die(mysqli_error($connect));
    while($get_vasalue = mysqli_fetch_array($get_organisdc)) 
    {
        $newsid = $get_vasalue['reference_name'];
    }

    if($referedby == $newsid){
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
$get_organicas = mysqli_query($connect,"SELECT * FROM `apply_from` ORDER BY idd DESC LIMIT 0,1") or die(mysqli_error());
while($get_valuesd = mysqli_fetch_array($get_organicas)) 
{
    $globalid = $get_valuesd['idd'];
    $globalid = $globalid+1;
}
if($globalid == ''){
    $globalid = '1';
}
?>

<head>
<title>KYC Finserv- Home</title>
 
    <meta charset="UTF-8">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="public/front/image/kyc1.jpeg" rel="shortcut icon" />
    
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="public/front/css/sabka-loan.css">
    <link href="public/front/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/front/css/bootsnav.css" rel="stylesheet">
    <link href="public/front/css/style.css" rel="stylesheet">
    
    <!--fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo:wght@100;200;300;400;500;600;700;800&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400&amp;display=swap" rel="stylesheet">
    
    <!--fonts end-->
    <link type="text/css" rel="stylesheet" href="public/front/css/carousel-main.css">
    <script type="text/javascript" src="public/front/js/products-carousel.js"></script>
    <style>
        input {
            text-transform: uppercase
        }
        .sabkaloan-apply {
            background: #1d0ad7!important;
        }
        .sabkaloan-tags {
            font-size: 40px;
            font-weight: 700;
            color: #0019bd;
            line-height: 42px;
        }
        .images_div {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            row-gap: 30px;
        }
        .images_width {
            width: fit-content;
            height: 100px;
        }
        .logo-slider-container {
            background:rgb(255, 255, 255);
            padding: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            position: relative;
            width: 100%;
            height: auto;
            margin: 40px auto;
            border-radius: 10px;
        }
        .logo-slider {
            position: relative;
            overflow: hidden;
            background: #fff;
            padding: 20px;
            cursor: grab;
        }
        .logo-slider-inner {
            display: flex;
            transition: transform 0.5s ease-in-out;
            will-change: transform;
        }
        .logo-item {
            min-width: 20%;
            padding: 20px;
            box-sizing: border-box;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .logo-item img {
            width: 100%;
            max-width: 160px;
            display: block;
        }
        @media (max-width: 720px) {
            .logo-item {
                min-width: 40%;
                padding: 10px;
            }
            .logo-item img {
                max-width: 160px;
            }
            .about-home-page {
                margin-top : 30px;
            }
        }
    </style>                    
</head>

<body>
    <nav class="navbar navbar-default bootsnav">
        <div class="container">
            <div class="attr-nav">
                <ul>
                    <li class="active"><a href="index.php" style="text-decoration:blink;">Apply Now</a></li>
                </ul>
            </div>
            <?php include 'header.php'; ?>
        </div>
    </nav>

    <div class="sabkaloan-top">            
        <div class="container" id="apply">
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6 sabkaloan-banner-form" id="forms" style="height: auto; overflow: visible;">
                    <div class="row">
                        <div class="col-md-12 applycation-form">Application Form</div>
                        <div class="col-md-12">
                            <hr class="hr-line">
                        </div>
                        <div class="col-md-12" style="text-align: center; color: red;">          
                            1.*CIBIL Score 500 இருந்தால் போதும்*<br>
                            2.*Interest depends on the level of CIBIL score*
                        </div>
                        <br>
                        <div class="col-md-12">   
                            <b>KYC FINSERV இன் சிறப்பு அம்சங்கள்</b><br>
                            • குறைவான வட்டிக்கு வங்கியில் கடன் பெற்றுத்தருதல். <br>
                            • ஒரு வங்கியில் உள்ள கடனை மற்றொரு வங்கிக்கு எளிமையாக மாற்றி தருதல்<br>
                        </div>
                    </div>
                    
                    <div class="row">
                        <form id="contact-form" class="uk-form uk-grid-small" method="post" action="" enctype="multipart/form-data">
                            
                            <?php if($id != '') { ?>
                                <input type="hidden" name="gpsLocation" id="gpsLocation">
                                <div class="col-md-12" style="margin-top:18px;">
                                    <div class="all red">
                                        <input type="text" name="referedby" class="form-control my-form" readonly value="<?php echo $id; ?>" placeholder="please enter reference code" />
                                    </div>
                                </div>
                            <?php } ?>
                            
                            <div class="col-md-6">
                                <label>KYCC Number<span style="color:#F00 !important;">*</span></label>
                                <input type="text" name="cusid" class="form-control my-form" value="KYCC<?php echo $globalid; ?>" readonly/>
                            </div>
                            
                            <div class="col-md-6">
                                <label>Full Name<span style="color:#F00 !important;">*</span></label>
                                <input type="text" name="full_name" class="form-control my-form" placeholder="As on Pan Card" required/>
                            </div>
                            
                            <div class="col-md-6">
                                <label>Mobile Number<span style="color:#F00 !important;">*</span></label>
                                <input type="tel" name="mobile_no" id="mobile" maxlength="10" minlength="10" pattern="[5-9]{1}[0-9]{9}" class="form-control my-form" placeholder="Mobile" value="" required/>
                            </div>
                            
                            <div class="col-md-6">
                                <label>தொழில் வகை<span style="color:red;">*</span> </label>
                                <select class="form-control" name="employment_type" id="employeeType" style="border:1px solid" required>
                                    <option value="">Select</option>
                                    <option value="Salaried">Salaried</option>
                                    <option value="SelfEmployed">Self Employed</option>
                                    <option value="Daily wages">Daily Wages</option>
                                </select>
                            </div>
                            
                            <div class="col-md-6">
                                <label>Loan Amount<span style="color:#F00!important">*</span></label>
                                <input type="number" name="loan_amount" id="loan_amount" class="form-control my-form" placeholder="Loan Amount" required>
                                <div id="loan_amount_words1"></div>
                            </div>
                            
                            <div class="col-md-6">
                                <label>Loan Type<span style="color:#F00!important">*</span></label>
                                <select class="form-control" name="loan_type" id="mySelect" style="border:1px solid" required>
                                    <option value="">Select Loan Type</option>
                                    <?php
                                    $get_document = mysqli_query($connect,"SELECT * FROM `document` ") or die(mysqli_error($connect));
                                    while($get_document_value = mysqli_fetch_array($get_document)) 
                                    {
                                        $documentid = $get_document_value['id'];
                                        $document_name = $get_document_value['document_name'];
                                    ?>
                                        <option value="<?php echo $documentid; ?>"><?php echo $document_name; ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                            
                            <div class="col-md-12">
                                <p class="sabkaloan-banner-form-dnc">By clicking on SUBMIT , I authorize KYC Finserv
                                    &amp; its representatives to Call, SMS or communicate via WhatsApp regarding my
                                    application. This consent overrides any registration for DNC / NDNC. I confirm I am
                                    in India, I am a major and a resident of India and I have read and I accept site
                                    Privacy Policy.</p>
                            </div>
                            
                            <input type="hidden" name="utm_source" value="">
                            
                            <div class="col-md-12">
                                <button type="submit" name="application" value="add" class="btn sabkaloan-apply">Apply</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>

    <div class="container">
        <div class="about-home-page" id="about">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 sabkaloan-tags">About Loan</div>
                        <div class="col-md-12">
                            <hr class="hr-tag">
                        </div>
                        <div class="col-md-12">
                            <p>KYC Finserv is a Direct Selling Agent or a loan distributor that has partnered with 50+ banks and financial institutions to meet your financing needs.
                            KYC Finserv has disbursed several financial products to individuals such as Home Loans, Personal Loans, Business loan, Loans Against Property, Vehicle Loan, Credit Card,.etc. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="col-md-12 sabkaloan-tags">Our Leading Partners</div>
        <div class="col-md-12">
            <div class="logo-slider-container">
                <div class="logo-slider">
                    <div class="logo-slider-inner">
                        <?php
                        $logos = ['logo1.png', 'logo6.avif', 'dcb.webp', 'esaf.png', 'easy.avif', 'adhitya.webp', 'chola.png', 'idfc.png', 'piramal.png', 'download.png'];
                        foreach ($logos as $logo) {
                            echo "<div class='logo-item'><img src='bank_logo/$logo' alt='Logo'></div>";
                        }
                        foreach ($logos as $logo) {
                            echo "<div class='logo-item'><img src='bank_logo/$logo' alt='Logo'></div>";
                        }
                        ?>
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
        if ((num = num.toString()).length > 9) return 'overflow';
        n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
        if (!n) return; var str = '';
        str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
        str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
        str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
        str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
        str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + 'only ' : '';
        return str;
    }

    document.getElementById('loan_amount').onkeyup = function () {
        document.getElementById('loan_amount_words1').innerHTML = inWords(document.getElementById('loan_amount').value);
    };
    </script>

    <!-- Bootsnavs -->
    <script src="public/front/js/bootstrap.min.js"></script>
    <script src="public/front/js/bootsnav.js"></script>
    <script type="text/javascript" src="public/front/js/fontawesome.js"></script>
    
    <!-- Carousel -->
    <script type="text/javascript" src="public/front/js/carousel.js"></script>
    <script type="text/javascript" src="public/front/js/testimonials-carousel.js"></script>
    <script type="text/javascript" src="public/front/js/testimonials-carousel-main.js"></script>
    
    <script>
    $(document).ready(function() {
        // Auto slider for partners
        function moveSlider(slider) {
            const logoInner = slider.querySelector('.logo-slider-inner');
            const logoItems = slider.querySelectorAll('.logo-item');
            const logoItemWidth = logoItems[0].offsetWidth;
            let currentLogoIndex = 0;

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
            }, 2000);
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