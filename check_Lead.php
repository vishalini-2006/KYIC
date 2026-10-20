<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>KYC Finserv - Running Loan Details</title>
    <link href="public/front/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="public/front/css/responsive-custom.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            padding: 30px 15px;
        }
        .lead-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            max-width: 600px;
            margin: 0 auto 30px;
            padding: 25px;
        }
        .lead-card h2 {
            font-size: 20px;
            font-weight: 700;
            color: #0626e0;
            text-align: center;
            margin-top: 0;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="lead-card">
        <h2>Your Running Loan Details</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped" style="margin-bottom: 0;">
                <tbody>
                    <tr>
                        <th style="width: 45%;">Name</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Disbursal Amount</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Disbursal Date</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Repay Date</th>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="lead-card">
        <h2>Loan Repayment</h2>
        <form method="post" name="customerData" action="https://www.sabkaloan.com/ccavRequestHandler.php">
            <input type="hidden" name="tid" id="tid" readonly />
            <input type="hidden" name="merchant_id" readonly value="3210339"/>
            <input type="hidden" name="redirect_url" value="thanks.html"/>
            <input type="hidden" name="cancel_url" value="index.php"/>
            <input type="hidden" name="language" value="EN"/>
            <input type="hidden" name="billing_country" value="India"/>
            <input type="hidden" name="delivery_country" value="India"/>

            <div class="form-group" style="margin-bottom: 15px;">
                <label>Loan No:</label>
                <input type="text" id="order_id" name="order_id" value="" readonly class="form-control">
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label>Amount (₹):</label>
                <input type="number" name="amount" value="0" class="form-control" required>
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label>Currency:</label>
                <input type="text" name="currency" readonly value="INR" class="form-control">
            </div>

            <button type="submit" class="sabkaloan-apply" style="width: 100%; border: none; border-radius: 8px;">Pay Now</button>
        </form>
    </div>
</div>

<script>
    window.onload = function() {
        var d = new Date().getTime();
        var tidElem = document.getElementById("tid");
        if (tidElem) tidElem.value = d;
    };
</script>
</body>
</html>
