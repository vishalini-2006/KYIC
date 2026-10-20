<?php
include 'config.php';

if (isset($_POST['applybutton']) && $_POST['applybutton'] == 'add') {
    $name = $_POST['name'] ?? '';
    $email_personal = $_POST['email_personal'] ?? '';
    $mobile = $_POST['mobile'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $loan_type = $_POST['loan_type'] ?? '';
    $message = $_POST['message'] ?? '';
    $today = date('Y-m-d');

    $name = mysqli_real_escape_string($connect, $name);
    $email_personal = mysqli_real_escape_string($connect, $email_personal);
    $mobile = mysqli_real_escape_string($connect, $mobile);
    $subject = mysqli_real_escape_string($connect, $subject);
    $loan_type = mysqli_real_escape_string($connect, $loan_type);
    $message = mysqli_real_escape_string($connect, $message);

    $query = "INSERT INTO `contact_us` (`name`, `email_personal`, `mobile`, `subject`, `loan_type`, `message`,`cdate`)
              VALUES ('$name', '$email_personal', '$mobile', '$subject', '$loan_type', '$message','$today')";

    if (mysqli_query($connect, $query)) {
        echo "<script type='text/javascript'>alert('Thank you for contacting us! We will get back to you shortly.'); window.location = 'contactus.php'</script>";
    } else {
        echo "<script type='text/javascript'>alert('Error saving contact request.');</script>";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>KYC Finserv - Contact Us</title>
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
                    Contact <span>KYC Finserv</span>
                </div>
                <div class="col-md-12">
                    <hr class="contact-us-hr">
                </div>
            </div>
        </div>
    </div>

    <div class="contact-sabkaloan">
        <div class="container">
            <div class="row" style="display: flex; flex-wrap: wrap;">
                <!-- Left Column: Contact Information -->
                <div class="col-md-5 col-sm-12" style="margin-bottom: 25px;">
                    <div class="thumbnail" style="height: 100%; display: flex; flex-direction: column; justify-content: space-between;">
                        <div>
                            <div class="sabkaloan-tags" style="color: #fff; font-size: 24px;">For any query, call us</div>
                            <hr class="hr-tag" style="background: #ffd600; margin: 8px 0 18px;">
                            <p style="font-size: 14px; line-height: 1.6;">
                                Navigating through financial services can be complicated. Don't hesitate to reach out to us via phone or email for any questions or concerns regarding your loans.
                            </p>
                        </div>
                        
                        <div style="margin-top: 15px;">
                            <div class="contact-info-row">
                                <i class="fa fa-phone contact-fa"></i>
                                <div>
                                    <a href="tel:04283291614" class="contact-link">04283291614</a>, 
                                    <a href="tel:9360229970" class="contact-link">9360229970</a>, 
                                    <a href="tel:7639291614" class="contact-link">7639291614</a>
                                </div>
                            </div>

                            <div class="contact-info-row">
                                <i class="fa fa-envelope-o contact-fa"></i>
                                <div>
                                    <a href="mailto:kycfinserv1@gmail.com" class="contact-link">kycfinserv1@gmail.com</a><br>
                                    <a href="mailto:sales@kycfinserv.com" class="contact-link">sales@kycfinserv.com</a>
                                </div>
                            </div>

                            <div class="contact-info-row">
                                <i class="fa fa-clock-o contact-fa"></i>
                                <div>
                                    <span style="color: #fff; font-size: 14px;">Office Hours: 10:00 AM to 5:00 PM<br>(Sunday Holiday)</span>
                                </div>
                            </div>

                            <div class="contact-info-row">
                                <i class="fa fa-map-marker contact-fa"></i>
                                <div>
                                    <span style="color: #fff; font-size: 14px;">
                                        <b>Registered Address:</b><br>
                                        Selvaganapathy Complex, Edappadi Main Road, Magudanchavadi (PO), Sankari (TK), Salem (Dt)-637103
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Contact Form -->
                <div class="col-md-7 col-sm-12" style="margin-bottom: 25px;">
                    <div style="background: #ffffff; border-radius: 16px; padding: 30px 25px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                        <div class="sabkaloan-tags" style="font-size: 24px; color: #1c2c5e;">Fill the form. It's easy.</div>
                        <hr class="hr-tag" style="margin: 8px 0 20px;">
                        
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-sm-6 col-xs-12" style="margin-bottom: 15px;">
                                    <label style="font-size: 13px; font-weight: 600; color: #333;">Your Name <span style="color:red;">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Name as on Pan card" required>
                                </div>
                                <div class="col-sm-6 col-xs-12" style="margin-bottom: 15px;">
                                    <label style="font-size: 13px; font-weight: 600; color: #333;">Email Address <span style="color:red;">*</span></label>
                                    <input type="email" name="email_personal" id="email_personal" class="form-control" placeholder="Personal Email ID" required>
                                </div>
                                <div class="col-sm-6 col-xs-12" style="margin-bottom: 15px;">
                                    <label style="font-size: 13px; font-weight: 600; color: #333;">Mobile Number <span style="color:red;">*</span></label>
                                    <input type="tel" name="mobile" id="mobile" maxlength="10" minlength="10" pattern="[5-9]{1}[0-9]{9}" class="form-control" placeholder="10 Digit Mobile Number" required>
                                </div>
                                <div class="col-sm-6 col-xs-12" style="margin-bottom: 15px;">
                                    <label style="font-size: 13px; font-weight: 600; color: #333;">Enquiry For <span style="color:red;">*</span></label>
                                    <select class="form-control" name="loan_type" id="loan_type" required>
                                        <option value="" disabled selected>Select Loan Type</option>
                                        <option value="home_loan">Home Loan</option>
                                        <option value="personal_loan">Personal Loans</option>
                                        <option value="lap">Loan Against Property (LAP)</option>
                                        <option value="business_loan">Business Loan</option>
                                        <option value="vehicle_loan">Vehicle Loan</option>
                                        <option value="credit_card">Credit Card</option>
                                        <option value="salary_pl">Salary PL</option>
                                        <option value="plot_purchase_home_loan">Plot Purchase Loan</option>
                                        <option value="empty_land">Empty Land Loan</option>
                                    </select>
                                </div>
                                <div class="col-xs-12" style="margin-bottom: 15px;">
                                    <label style="font-size: 13px; font-weight: 600; color: #333;">Subject Line</label>
                                    <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject">
                                </div>
                                <div class="col-xs-12" style="margin-bottom: 20px;">
                                    <label style="font-size: 13px; font-weight: 600; color: #333;">Message</label>
                                    <textarea name="message" placeholder="Write your message here..." class="form-control" style="height: 100px; resize: vertical;"></textarea>
                                </div>
                                <div class="col-xs-12">
                                    <button type="submit" name="applybutton" value="add" class="sabkaloan-apply">Submit Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Google Map Section -->
    <div class="container" style="margin-bottom: 40px;">
        <div class="row">
            <div class="col-md-12">
                <div class="sabkaloan-tags" style="font-size: 22px;">Find Us On Google Maps</div>
                <hr class="hr-tag" style="margin: 6px 0 15px;">
                <div class="responsive-map-container" style="border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d15636.193963108004!2d77.97677263480686!3d11.548379367660468!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1s7%2F109-2%2C%20MAGUDANCHAVADI%2C%20ERANAPURAM%2C%20SELVAGANAPATHI%20COMPLEX%2C%20SANKARI%20TALUKA%2C%20ERNAPURAM%2C%20TAMIL%20NADU%2C%20SALEM%2C%20637103%2C!5e0!3m2!1sen!2sin!4v1722251322528!5m2!1sen!2sin" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
