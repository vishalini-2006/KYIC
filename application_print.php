<?php
include 'config.php';

$mobile = isset($_GET['mobile_no']) ? trim($_GET['mobile_no']) : '';
$data = [];
$error = '';

if (empty($mobile)) {
    $error = "Mobile number required";
} else {
    $query = $connect->prepare("
        SELECT * FROM formw 
        WHERE applicant_mobile_no = ? 
        OR co_applicant_mobile_no = ?
        ORDER BY newform_id DESC LIMIT 1
    ");

    $query->bind_param("ss", $mobile, $mobile);
    $query->execute();
    $result = $query->get_result();

    if ($result && $result->num_rows > 0) {
        $data = $result->fetch_assoc();
    } else {
        $error = "No Record Found for mobile number: " . htmlspecialchars($mobile);
    }
    $query->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>KYC Finserv - Print Application</title>
    
    <link href="public/front/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="public/front/css/responsive-custom.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #fdfdfd;
            padding: 20px 10px;
        }

        .print-container {
            width: 100%;
            max-width: 850px;
            margin: auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        }

        .table_outer_border {
            border: 2px solid #0626e0;
            width: 100%;
        }

        .table-bordered td, .table-bordered th {
            border: 1px solid #d0deff !important;
            font-size: 13px;
            padding: 8px 12px;
        }

        .table-bordered td:first-child {
            font-weight: 700;
            color: #1c2c5e;
            width: 40%;
            background: #f8faff;
        }

        .head_style {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #0626e0;
            flex-wrap: wrap;
            gap: 15px;
        }

        .head_style img {
            height: 60px;
            max-width: 200px;
            object-fit: contain;
        }

        @media print {
            body {
                padding: 0;
                background: #fff;
            }
            .print-container {
                box-shadow: none;
                padding: 0;
                max-width: 100%;
            }
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>

<body onload="if(!window.location.search.includes('noprint')) { window.print(); }">

<div class="print-container">

    <?php if ($error): ?>
        <div style="color: red; text-align: center; font-size: 18px; padding: 40px 0;">
            <i class="glyphicon glyphicon-exclamation-sign"></i> <?php echo $error; ?><br><br>
            <a href="form.php" class="btn btn-primary no-print">Back to Form</a>
        </div>
    <?php else: ?>

        <div class="head_style">
            <img src="public/front/image/kyc1.jpeg" alt="KYC Finserv Logo">
            <div style="text-align: center;">
                <h3 style="margin: 0; font-weight: 700; color: #0626e0;">KYC FINSERV</h3>
                <small style="color: #666;">Loan Application Summary</small>
            </div>
            <div>
                <b>Date:</b> <?php echo htmlspecialchars($data['date'] ?? date('Y-m-d')); ?><br>
                <b>KYCC:</b> <span style="color: #0626e0; font-weight: bold;"><?php echo htmlspecialchars($data['kycc_no'] ?? ''); ?></span>
            </div>
        </div>

        <div class="no-print" style="margin-bottom: 15px; text-align: right;">
            <button onclick="window.print()" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-print"></i> Print Now</button>
            <a href="form.php" class="btn btn-default btn-sm">Back</a>
        </div>

        <?php
        $banks = explode(',', $data['bank_name'] ?? '');
        $banks = array_filter(array_map('trim', $banks));
        $bank_count = count($banks);
        ?>

        <div class="table-responsive">
            <table class="table table-bordered table_outer_border">
                <tbody>
                    <tr>
                        <td>KYCC NO</td>
                        <td><strong><?php echo htmlspecialchars($data['kycc_no'] ?? ''); ?></strong></td>
                    </tr>
                    <tr>
                        <td>Applicant Name</td>
                        <td><?php echo htmlspecialchars($data['applicant_name'] ?? ''); ?></td>
                    </tr>
                    <tr>
                        <td>Applicant Mobile No</td>
                        <td><?php echo htmlspecialchars($data['applicant_mobile_no'] ?? ''); ?></td>
                    </tr>
                    <tr>
                        <td>Applicant CIBIL Score</td>
                        <td><?php echo htmlspecialchars($data['applicant_cibil_score'] ?? ''); ?></td>
                    </tr>
                    <tr>
                        <td>Co-Applicant Name</td>
                        <td><?php echo htmlspecialchars($data['co_applicant_name'] ?? ''); ?></td>
                    </tr>
                    <tr>
                        <td>Co-Applicant Mobile No</td>
                        <td><?php echo htmlspecialchars($data['co_applicant_mobile_no'] ?? ''); ?></td>
                    </tr>
                    <tr>
                        <td>Co-Applicant CIBIL Score</td>
                        <td><?php echo htmlspecialchars($data['co_applicant_cibil_score'] ?? ''); ?></td>
                    </tr>
                    <tr>
                        <td>Required Loan Amount</td>
                        <td>₹ <?php echo htmlspecialchars($data['req_loan_amount'] ?? ''); ?></td>
                    </tr>
                    <tr>
                        <td>DPD</td>
                        <td><?php echo htmlspecialchars($data['dbd'] ?? ''); ?></td>
                    </tr>
                    <tr>
                        <td>Total Overdue</td>
                        <td><?php echo htmlspecialchars($data['total_overdue'] ?? ''); ?></td>
                    </tr>
                    <tr>
                        <td>Obligations</td>
                        <td><?php echo htmlspecialchars($data['obligations'] ?? ''); ?></td>
                    </tr>
                    <tr>
                        <td>Bank Names</td>
                        <td><?php echo htmlspecialchars(implode(', ', $banks)); ?></td>
                    </tr>
                    <tr>
                        <td>No of Banks</td>
                        <td><?php echo $bank_count; ?></td>
                    </tr>
                    <tr>
                        <td>Total Obligation Amount</td>
                        <td><?php echo htmlspecialchars($data['total_amount'] ?? ''); ?></td>
                    </tr>
                    <tr>
                        <td>Business Stability</td>
                        <td><?php echo htmlspecialchars($data['business_stability'] ?? ''); ?></td>
                    </tr>
                    <tr>
                        <td>Slum Area</td>
                        <td><?php echo htmlspecialchars($data['slum_area'] ?? ''); ?></td>
                    </tr>
                    <tr>
                        <td>IT Loan Amount</td>
                        <td><?php echo htmlspecialchars($data['it_loan_amount'] ?? ''); ?></td>
                    </tr>
                    <tr>
                        <td>No of Years</td>
                        <td><?php echo htmlspecialchars($data['no_of_years'] ?? ''); ?></td>
                    </tr>
                    <tr>
                        <td>Loan Type</td>
                        <td><?php echo htmlspecialchars($data['loan_type'] ?? ''); ?></td>
                    </tr>
                    <tr>
                        <td>Employee Type</td>
                        <td><?php echo htmlspecialchars($data['employee_applicable'] ?? ''); ?></td>
                    </tr>
                    <tr>
                        <td>Property Type</td>
                        <td><?php echo htmlspecialchars($data['property_type'] ?? ''); ?></td>
                    </tr>
                    <tr>
                        <td>Property Measurement</td>
                        <td><?php echo htmlspecialchars($data['property_measurement'] ?? ''); ?></td>
                    </tr>
                    <tr>
                        <td>Property Size</td>
                        <td><?php echo htmlspecialchars($data['property_size'] ?? ''); ?></td>
                    </tr>
                    <tr>
                        <td>Business Proof</td>
                        <td><?php echo htmlspecialchars($data['business_proof'] ?? ''); ?></td>
                    </tr>
                    <tr>
                        <td>Market Value (Lakhs)</td>
                        <td><?php echo htmlspecialchars($data['sale_deed_value_1'] ?? ''); ?></td>
                    </tr>
                    <tr>
                        <td>CIBIL Enquiries</td>
                        <td><?php echo htmlspecialchars($data['cibil_enquiries'] ?? ''); ?></td>
                    </tr>
                    <tr>
                        <td>Recent Sale Deed</td>
                        <td><?php echo htmlspecialchars($data['recent_sale_deed'] ?? ''); ?></td>
                    </tr>
                    <tr>
                        <td>Age of Property</td>
                        <td><?php echo htmlspecialchars($data['age_of_property'] ?? ''); ?></td>
                    </tr>
                    <tr>
                        <td>பத்திரத்தில் தட பாத்தியம்</td>
                        <td><?php echo htmlspecialchars($data['sro_ec'] ?? ''); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

    <?php endif; ?>

</div>

</body>
</html>