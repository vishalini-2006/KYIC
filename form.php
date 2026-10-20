<?php
include 'config.php';

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Function to generate KYCC number in format KYCC1, KYCC2, KYCC3, etc.
function generateKYCCNumber($connect) {
    // Get the last KYCC number using newform_id as the primary key
    $query = $connect->prepare("SELECT kycc_no FROM formw ORDER BY newform_id DESC LIMIT 1");
    
    if (!$query) {
        return 'KYCC1'; // Fallback if query fails
    }
    
    $query->execute();
    $result = $query->get_result();
    $row = $result->fetch_assoc();
    $query->close();
    
    if ($row && !empty($row['kycc_no'])) {
        $last_number = $row['kycc_no'];
        
        // Extract numbers from KYCC format (KYCC1, KYCC2, etc.)
        if (preg_match('/KYCC(\d+)$/', $last_number, $matches)) {
            $num_part = intval($matches[1]);
            $new_number = $num_part + 1;
            return 'KYCC' . $new_number;
        }
    }
    
    // First record - start with KYCC1
    return 'KYCC1';
}

// Auto-generate KYCC number for the form
$auto_kycc_no = generateKYCCNumber($connect);
$success_message = '';
$error_message = '';
$show_alert = false;
$alert_kycc_no = '';

$id = isset($_GET['id']) ? $_GET['id'] : '';

if(isset($_POST['apply']) && $_POST['apply'] == 'create') {
    
    // Initialize variables
    $kycc_no = $_POST['kycc_no'] ?? $auto_kycc_no;
    $date = $_POST['date'] ?? '';
    $applicant_name = $_POST['applicant_name'] ?? '';
    $applicant_mobile_no = $_POST['applicant_mobile_no'] ?? '';
    $applicant_cibil_score = $_POST['applicant_cibil_score'] ?? '';
    $co_applicant_name = $_POST['co_applicant_name'] ?? '';
    $co_applicant_mobile_no = $_POST['co_applicant_mobile_no'] ?? '';
    $co_applicant_cibil_score = $_POST['co_applicant_cibil_score'] ?? '';
    $req_loan_amount = $_POST['req_loan_amount'] ?? '';
    $dbd = $_POST['dbd'] ?? '';
    $total_overdue = $_POST['total_overdue'] ?? '';
    $obligations = $_POST['obligations'] ?? '';
    
    // Handle multiple bank names
    $bank_names = '';
    if(isset($_POST['bank_name']) && is_array($_POST['bank_name'])) {
        $bank_names_array = array_filter($_POST['bank_name']); 
        $bank_names = implode(', ', $bank_names_array);
    }
    
    // Handle total_amount - it might be an array from the dynamic fields
    $total_amount = '';
    if(isset($_POST['total_amount']) && is_array($_POST['total_amount'])) {
        $total_amount_array = array_filter($_POST['total_amount']);
        $total_amount = implode(', ', $total_amount_array);
    } else {
        $total_amount = $_POST['total_amount'] ?? '';
    }
    
    $business_stability = $_POST['business_stability'] ?? '';
    $slum_area = $_POST['slum_area'] ?? '';
    $it_loan_amount = $_POST['it_loan_amount'] ?? '';
    $no_of_years = $_POST['no_of_years'] ?? '';
    $loan_type = $_POST['loan_type'] ?? '';
    $employee_type = $_POST['employee_type'] ?? '';
    $property_type = $_POST['property_type'] ?? '';
    $property_measurement = $_POST['property_measurement'] ?? '';
    $property_size = $_POST['property_size'] ?? '';
    $business_proof = $_POST['business_proof'] ?? '';
    $market_value = $_POST['market_value'] ?? '';
    $cibil_enquiries = $_POST['cibil_enquiries'] ?? '';
    $recent_sale = $_POST['recent_sale'] ?? '';
    $age_of_property = $_POST['age_of_property'] ?? '';
    $sro_ec = $_POST['sro_ec'] ?? '';
    $paththirathil_thada = $_POST['paththirathil_thada'] ?? '';
    
    // Additional fields
    $app_cibl_score = $_POST['app_cibl_score'] ?? '';
    $dbt_eligible = $_POST['dbt_eligible'] ?? '';
    $dbp_eligible = $_POST['dbp_eligible'] ?? '';
    $dbt_and_over_due_closing = $_POST['dbt_and_over_due_closing'] ?? '';
    $loan_amount_min = $_POST['loan_amount_min'] ?? '';
    $loan_amount_max = $_POST['loan_amount_max'] ?? '';
    $itr_loan_amount_min = $_POST['itr_loan_amount_min'] ?? '';
    $itr_loan_amount_max = $_POST['itr_loan_amount_max'] ?? '';
    $govt_salaried_ltv = $_POST['govt_salaried_ltv'] ?? '';
    $salaried_ltv = $_POST['salaried_ltv'] ?? '';
    $property_type1 = $_POST['property_type1'] ?? '';
    $property_applicable = $_POST['property_applicable'] ?? '';
    $property_applicable1 = $_POST['property_applicable1'] ?? '';
    $tenor_min = $_POST['tenor_min'] ?? '';
    $tenor_max = $_POST['tenor_max'] ?? '';
    $ltv = $_POST['ltv'] ?? '';
    $roi = $_POST['roi'] ?? '';
    $no_of_enq_eligible = $_POST['no_of_enq_eligible'] ?? '';
    $recent_itr = $_POST['recent_itr'] ?? '';
    $employee_applicable = $_POST['employee_applicable'] ?? '';
    $daily_wages = $_POST['daily_wages'] ?? '';
    $sale_deed_value = $_POST['sale_deed_value'] ?? '';
    $sale_deed_value_1 = $_POST['sale_deed_value_1'] ?? '';
    $sale_deed_value_2 = $_POST['sale_deed_value_2'] ?? '';
    $sale_deed_value_3 = $_POST['sale_deed_value_3'] ?? '';
    $sale_deed_value_4 = $_POST['sale_deed_value_4'] ?? '';
    
    // Use prepared statement to insert data safely
    $sql = "INSERT INTO formw (
        kycc_no, date, applicant_name, applicant_mobile_no, 
        applicant_cibil_score, co_applicant_name, co_applicant_mobile_no, 
        co_applicant_cibil_score, req_loan_amount, dbd, total_overdue,
        obligations, bank_name, total_amount, business_stability, 
        slum_area, it_loan_amount, no_of_years, loan_type, 
        employee_type, property_type, property_measurement, property_size,
        business_proof, market_value, cibil_enquiries, recent_sale_deed, 
        age_of_property, sro_ec, app_cibl_score, dbt_eligible,
        dbp_eligible, dbt_and_over_due_closing, loan_amount_min, loan_amount_max,
        itr_loan_amount_min, itr_loan_amount_max, govt_salaried_ltv, salaried_ltv,
        property_type1, property_applicable, property_applicable1, tenor_min,
        tenor_max, ltv, roi, no_of_enq_eligible, recent_itr, 
        employee_applicable, daily_wages, sale_deed_value, sale_deed_value_1,
        sale_deed_value_2, sale_deed_value_3, sale_deed_value_4
    ) VALUES (
        ?, ?, ?, ?, 
        ?, ?, ?, ?, 
        ?, ?, ?,
        ?, ?, ?, ?, 
        ?, ?, ?, ?, 
        ?, ?, ?, ?,
        ?, ?, ?, ?, 
        ?, ?, ?, ?,
        ?, ?, ?, ?, 
        ?, ?, ?, ?, 
        ?, ?, ?, ?,
        ?, ?, ?, ?, ?, 
        ?, ?, ?, ?,
        ?, ?, ?
    )";
    
    $stmt = $connect->prepare($sql);
    
    if (!$stmt) {
        $error_message = "Prepare failed: " . $connect->error;
    } else {
        // Create an array of all parameters
        $params = array(
            $kycc_no, $date, $applicant_name, $applicant_mobile_no,
            $applicant_cibil_score, $co_applicant_name, $co_applicant_mobile_no,
            $co_applicant_cibil_score, $req_loan_amount, $dbd, $total_overdue,
            $obligations, $bank_names, $total_amount, $business_stability,
            $slum_area, $it_loan_amount, $no_of_years, $loan_type,
            $employee_type, $property_type, $property_measurement, $property_size,
            $business_proof, $market_value, $cibil_enquiries, $recent_sale,
            $age_of_property, $sro_ec, $app_cibl_score, $dbt_eligible,
            $dbp_eligible, $dbt_and_over_due_closing, $loan_amount_min, $loan_amount_max,
            $itr_loan_amount_min, $itr_loan_amount_max, $govt_salaried_ltv, $salaried_ltv,
            $property_type1, $property_applicable, $property_applicable1, $tenor_min,
            $tenor_max, $ltv, $roi, $no_of_enq_eligible, $recent_itr,
            $employee_applicable, $daily_wages, $sale_deed_value, $sale_deed_value_1,
            $sale_deed_value_2, $sale_deed_value_3, $sale_deed_value_4
        );
        
        $param_count = count($params);
        $types = str_repeat('s', $param_count);
        
        $bind_params = array($types);
        for ($i = 0; $i < $param_count; $i++) {
            $bind_params[] = &$params[$i];
        }
        
        call_user_func_array(array($stmt, 'bind_param'), $bind_params);
        
        if ($stmt->execute()) {
            $show_alert = true;
            $alert_kycc_no = $kycc_no;
        } else {
            $error_message = "Execute failed: " . $stmt->error;
        }
        
        $stmt->close();
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>KYC Finserv - Loan Application Form</title>
 
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
                    Instant Personal &amp; Business Loans - Fast, Secure &amp; Paperless
                </div>
            </div>
        </div>
    </div>
 
    <div class="centered-container">
        <div class="cform-container">
            <div class="text-center" style="margin-bottom: 25px;">
                <h1 class="applycation-form" style="font-size: 28px; margin: 0;">Loan Application Form</h1>
                <hr class="hr-line">
            </div>
            
            <?php if($error_message): ?>
            <div class="alert alert-danger" style="border-radius: 8px; margin-bottom: 20px;">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
            <?php endif; ?>
 
            <form id="contact-form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                <input type="hidden" name="gpsLocation" id="gpsLocation">
                <input type="hidden" name="apply" value="create">

                <!-- 1. KYCC & Date -->
                <div class="app-form-grid">
                    <div class="app-form-group">
                        <label>KYCC Number <span style="color:#F00;">*</span></label>
                        <input type="text" class="form-control" name="kycc_no" value="<?php echo htmlspecialchars($auto_kycc_no); ?>" readonly>
                        <small style="color: #666; font-size: 11px;">Auto-generated Application ID</small>
                    </div>
                    <div class="app-form-group">
                        <label for="date">Date <span style="color:#F00;">*</span></label>
                        <input type="date" class="form-control" name="date" value="<?php echo date('Y-m-d'); ?>" required/>
                    </div>
                </div>

                <!-- 2. Applicant Details -->
                <div class="form-section-title">1. Applicant Details</div>
                <div class="app-form-grid-3">
                    <div class="app-form-group">
                        <label for="applicant_name">Applicant Name <span style="color:#F00;">*</span></label>
                        <input type="text" class="form-control" name="applicant_name" placeholder="Enter Applicant Name" required/>
                    </div>
                    <div class="app-form-group">
                        <label for="applicant_mobile_no">Mobile No <span style="color:#F00;">*</span></label>
                        <input type="tel" class="form-control" name="applicant_mobile_no" placeholder="Enter Mobile Number" pattern="[5-9]{1}[0-9]{9}" maxlength="10" required/>
                    </div>
                    <div class="app-form-group">
                        <label for="applicant_cibil_score">CIBIL Score</label>
                        <input type="number" class="form-control" name="applicant_cibil_score" placeholder="Enter CIBIL Score"/>
                    </div>
                </div>

                <!-- 3. Co-Applicant Details -->
                <div class="form-section-title">2. Co-Applicant Details (Optional)</div>
                <div class="app-form-grid-3">
                    <div class="app-form-group">
                        <label for="co_applicant_name">Co-Applicant Name</label>
                        <input type="text" class="form-control" name="co_applicant_name" placeholder="Enter Co-Applicant Name"/>
                    </div>
                    <div class="app-form-group">
                        <label for="co_applicant_mobile_no">Mobile No</label>
                        <input type="tel" class="form-control" name="co_applicant_mobile_no" placeholder="Enter Mobile Number" maxlength="10"/>
                    </div>
                    <div class="app-form-group">
                        <label for="co_applicant_cibil_score">CIBIL Score</label>
                        <input type="number" class="form-control" name="co_applicant_cibil_score" placeholder="Enter CIBIL Score"/>
                    </div>
                </div>

                <!-- 4. Loan & Financial Obligations -->
                <div class="form-section-title">3. Loan Requirement &amp; Obligations</div>
                <div class="app-form-grid">
                    <div class="app-form-group">
                        <label for="req_loan_amount">Required Loan Amount <span style="color:#F00;">*</span></label>
                        <input type="number" class="form-control" name="req_loan_amount" placeholder="Required Loan Amount" required/>
                    </div>
                    <div class="app-form-group">
                        <label for="total_overdue">Total Overdue</label>
                        <input type="number" class="form-control" name="total_overdue" placeholder="Enter Total Overdue Amount"/>
                    </div>
                </div>

                <div class="app-form-grid">
                    <div class="app-form-group">
                        <label>DPD</label>
                        <div class="radio-outline">
                            <label class="radio-inline">
                                <input type="radio" name="dbd" value="Yes"> Yes
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="dbd" value="No" checked> No
                            </label>
                        </div>
                    </div>
                    <div class="app-form-group">
                        <label>Existing Obligations</label>
                        <div class="radio-outline">
                            <label class="radio-inline">
                                <input type="radio" name="obligations" value="Yes"> Yes
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="obligations" value="No" checked> No
                            </label>
                        </div>
                    </div>
                </div>

                <!-- 5. Bank Accounts / Multiple Banks -->
                <div class="form-section-title">4. Existing Bank Loans / Facilities</div>
                <div id="bank-fields-container">
                    <div class="bank-field-group">
                        <div class="form-group-bank">
                            <label>Bank Name</label>
                            <input type="text" class="form-control bank-name" name="bank_name[]" placeholder="Enter Bank Name"/>
                        </div>
                        <div class="form-group-bank">
                            <label>EMI / Total Amount</label>
                            <input type="text" class="form-control total-amount" name="total_amount[]" placeholder="Enter Amount"/>
                        </div>
                        <div class="form-group-btn">
                            <button type="button" class="btn btn-success add-bank-field" title="Add Another Bank">+</button>
                        </div>
                    </div>
                </div>

                <!-- Hidden template for cloning -->
                <div id="bank-field-template" style="display: none;">
                    <div class="bank-field-group">
                        <div class="form-group-bank">
                            <input type="text" class="form-control bank-name" name="bank_name[]" placeholder="Enter Bank Name"/>
                        </div>
                        <div class="form-group-bank">
                            <input type="text" class="form-control total-amount" name="total_amount[]" placeholder="Enter Amount"/>
                        </div>
                        <div class="form-group-btn">
                            <button type="button" class="btn btn-danger remove-bank-field" title="Remove Bank">-</button>
                        </div>
                    </div>
                </div>

                <!-- 6. Employment & Business Details -->
                <div class="form-section-title">5. Employment &amp; Stability</div>
                <div class="app-form-grid-3">
                    <div class="app-form-group">
                        <label for="loan_type">Loan Type <span style="color:#F00;">*</span></label>
                        <select class="form-control" name="loan_type" required>
                            <option value="">Select Loan Type</option>
                            <option value="Home Loan (Purchase, Constuction, Renovation)">Home Loan (Purchase, Construction, Renovation)</option>
                            <option value="Mortagage Loan">Mortgage Loan</option>
                            <option value="Empty Land Loan">Empty Land Loan</option>
                            <option value="Personal Loans">Personal Loans</option>
                            <option value="Business Loan (Secured & Unsecured)">Business Loan (Secured &amp; Unsecured)</option>
                            <option value="Overdraft Loan">Overdraft Loan</option>
                            <option value="Balance Transfer">Balance Transfer</option>
                        </select>
                    </div>

                    <div class="app-form-group">
                        <label for="employee_applicable">Employee Type <span style="color:#F00;">*</span></label>
                        <select class="form-control" name="employee_applicable" required>
                            <option value="">Select Employee Type</option>
                            <option value="Govt Salaried">Govt Salaried</option>
                            <option value="Salaried">Salaried</option>
                            <option value="Self Employed">Self Employed</option>
                            <option value="Daily Wages">Daily Wages</option>
                        </select>
                    </div>

                    <div class="app-form-group">
                        <label for="no_of_years">Experience / Business Years</label>
                        <input type="number" class="form-control" name="no_of_years" placeholder="No of years"/>
                    </div>
                </div>

                <div class="app-form-grid-3">
                    <div class="app-form-group">
                        <label>Business Stability</label>
                        <div class="radio-outline">
                            <label class="radio-inline">
                                <input type="radio" name="business_stability" value="Yes" checked> Yes
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="business_stability" value="No"> No
                            </label>
                        </div>
                    </div>

                    <div class="app-form-group">
                        <label>Slum Area</label>
                        <div class="radio-outline">
                            <label class="radio-inline">
                                <input type="radio" name="slum_area" value="Yes"> Yes
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="slum_area" value="No" checked> No
                            </label>
                        </div>
                    </div>

                    <div class="app-form-group">
                        <label>IT Returns Filed</label>
                        <div class="radio-outline">
                            <label class="radio-inline">
                                <input type="radio" name="it_loan_amount" value="Yes" checked> Yes
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="it_loan_amount" value="No"> No
                            </label>
                        </div>
                    </div>
                </div>

                <!-- 7. Property & Verification Details -->
                <div class="form-section-title">6. Property &amp; Legal Verification</div>
                <div class="app-form-grid-3">
                    <div class="app-form-group">
                        <label for="property_type">Property Type</label>
                        <select class="form-control" name="property_type">
                            <option value="">Select Property Type</option>
                            <option value="மெத்தை வீடு">மெத்தை வீடு (RCC Building)</option>
                            <option value="மெத்தை+அட்டை">மெத்தை+அட்டை (RCC + Sheet)</option>
                            <option value="அட்டை வீடு">அட்டை வீடு (Sheet Roof)</option>
                            <option value="ஓட்டு வீடு">ஓட்டு வீடு (Tiled House)</option>
                            <option value="காலி நிலம்">காலி நிலம் (Empty Plot)</option>
                        </select>
                    </div>

                    <div class="app-form-group">
                        <label for="property_measurement">Measurement Unit</label>
                        <select class="form-control" name="property_measurement">
                            <option value="">Select Unit</option>
                            <option value="சதுர அடி">சதுர அடி (Sq.Ft)</option>
                            <option value="சென்ட்">சென்ட் (Cents)</option>
                            <option value="ஏக்கர்">ஏக்கர் (Acres)</option>
                            <option value="தோராய பட்டா">தோராய பட்டா</option>
                        </select>
                    </div>

                    <div class="app-form-group">
                        <label for="property_size">Property Size</label>
                        <input type="number" class="form-control" name="property_size" placeholder="Enter Size"/>
                    </div>
                </div>

                <div class="app-form-grid-3">
                    <div class="app-form-group">
                        <label for="business_proof">Business Proof</label>
                        <select class="form-control" name="business_proof">
                            <option value="">Select Business Proof</option>
                            <option value="pan_card">Pan Card</option>
                            <option value="udhyam_certificate">Udyam Certificate</option>
                            <option value="gst_registration">GST Registration</option>
                            <option value="partnership_deed">Partnership Deed</option>
                            <option value="shop_establishment_certificate">Shop &amp; Establishment</option>
                        </select>
                    </div>

                    <div class="app-form-group">
                        <label for="sale_deed_value_1">Market Value (in Lakhs)</label>
                        <input type="number" class="form-control" name="sale_deed_value_1" placeholder="e.g. 25"/>
                    </div>

                    <div class="app-form-group">
                        <label for="cibil_enquiries">CIBIL Enquiries</label>
                        <select class="form-control" name="cibil_enquiries">
                            <option value="">Select</option>
                            <option value="eligible">Eligible (&lt; 3 in 6 months)</option>
                            <option value="non_eligible">Non-eligible</option>
                        </select>
                    </div>
                </div>

                <div class="app-form-grid-3">
                    <div class="app-form-group">
                        <label for="recent_sale">Recent Sale Deed</label>
                        <select class="form-control" name="recent_sale">
                            <option value="">Select</option>
                            <option value="eligible">Eligible (&gt; 1 Year)</option>
                            <option value="non_eligible">Non-eligible</option>
                        </select>
                    </div>

                    <div class="app-form-group">
                        <label>Age of Property</label>
                        <div class="checkbox-outline">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="age_of_property" value="13_years"> &lt; 13 years
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="age_of_property" value="30_years"> &lt; 30 years
                            </label>
                        </div>
                    </div>

                    <div class="app-form-group">
                        <label for="sro_ec">பத்திரத்தில் தட பாத்தியம்</label>
                        <select class="form-control" name="sro_ec">
                            <option value="">Select Option</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                </div>

                <!-- Submit Button -->
                <div style="margin-top: 30px;">
                    <button type="submit" name="apply" value="create" class="sabkaloan-apply" style="padding: 14px 20px; font-size: 18px; border-radius: 8px;">
                        Submit Application
                    </button>
                </div>
            </form>

            <!-- Print Section -->
            <div style="margin-top: 40px; padding-top: 25px; border-top: 1px solid #e2e8f0;">
                <div class="text-center">
                    <h4 style="font-weight: 700; color: #1c2c5e; margin-bottom: 6px;">Already Applied? Print Application Form</h4>
                    <p style="color: #666; font-size: 13px; margin-bottom: 15px;">Enter your registered mobile number below to retrieve and print your application form.</p>
                </div>
                <div class="print_div">
                    <input type="tel" id="print_mobile" placeholder="Enter 10 Digit Mobile Number" class="form-control" maxlength="10">
                    <button class="btn btn-primary" onclick="redirectToPrint()">Print Form</button>
                </div>
            </div>
        </div>
    </div>

    <?php if($show_alert): ?>
    <script type="text/javascript">
        alert('Form submitted successfully!\nYour KYCC Number: <?php echo $alert_kycc_no; ?>');
        window.location.href = 'form.php';
    </script>
    <?php endif; ?>

    <script>
        // Dynamic Bank Fields Handler
        document.addEventListener("DOMContentLoaded", function(){
            document.addEventListener("click", function(e){
                if(e.target && e.target.classList.contains("add-bank-field")){
                    let template = document.querySelector("#bank-field-template .bank-field-group");
                    if (template) {
                        let clone = template.cloneNode(true);
                        document.querySelector("#bank-fields-container").appendChild(clone);
                    }
                }
                
                if(e.target && e.target.classList.contains("remove-bank-field")){
                    let parentGroup = e.target.closest(".bank-field-group");
                    if (parentGroup) {
                        parentGroup.remove();
                    }
                }
            });
        });

        // Print Form Redirect
        function redirectToPrint() {
            var mobile = document.getElementById('print_mobile').value;
            if(mobile && mobile.trim().length === 10) {
                window.location.href = "application_print.php?mobile_no=" + encodeURIComponent(mobile.trim());
            } else {
                alert("Please enter a valid 10-digit registered mobile number.");
            }
        }
    </script>

    <!-- Bootsnavs Scripts -->
    <script src="public/front/js/bootstrap.min.js"></script>
    <script src="public/front/js/bootsnav.js"></script>
    <script type="text/javascript" src="public/front/js/fontawesome.js"></script>

    <?php include 'footer.php'; ?>
</body>
</html>
