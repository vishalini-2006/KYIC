<?php
$id = $_GET['id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Generator</title>
    <style>
        /* Basic styling for the QR code container */
        #qrcode {
            width: 160px;
            height: 160px;
            margin: 20px auto;
        }
 .qlogo {
    width: 150px;
    height: 100px;
    margin: 0 auto;
    display: flex;
    position: relative;
    left: 58px;
}
    </style>
</head>
<body>

    <!-- QR Code container -->
    <img src="../public/front/image/kyc.png" class="qlogo"/>
    <div id="qrcode"></div>

    <!-- QRCode.js library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

    <script>
        // Generate the QR code
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            text: "https://kycfinserv.com/?id=<?php echo $id; ?>", // The text or URL to encode
            width: 280, // Width of the QR code
            height: 280, // Height of the QR code
            colorDark : "#000000", // Dark color
            colorLight : "#ffffff", // Light color
            correctLevel : QRCode.CorrectLevel.H // Error correction level
        });
    </script>

</body>
</html>
