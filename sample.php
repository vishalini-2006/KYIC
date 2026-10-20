<?php
// Decentro API Credentials
$clientID = 'GrowTechnologies_9_sop';
$clientSecret = 'c9014cecf5f84c36895f733047624882';
$moduleSecret = 'c041ff70dcaa4369956b9bdac8bc1c63';
$baseUrl = 'https://staging.decentro.tech/v1'; // Replace with the correct endpoint

// Function to make an API call
function callDecentroAPI($endpoint, $payload, $clientID, $clientSecret, $moduleSecret) {
    $url = $endpoint;

    // Prepare cURL request
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Basic ' . base64_encode("$clientID:$clientSecret"),
        'Module-Secret: ' . $moduleSecret,
    ]);

    // Execute request and get response
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($response === false || $httpCode !== 200) {
        echo "Error: " . curl_error($ch);
        echo "HTTP Code: " . $httpCode;
        return null;
    }

    curl_close($ch);
    return json_decode($response, true);
}

// Handle form submission
$response = null; // Default response
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $firstName = $_POST['first_name'] ?? '';
    $lastName = $_POST['last_name'] ?? '';
    $dob = $_POST['dob'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';

    // Prepare payload for API
    $payload = [
        'first_name' => $firstName,
        'last_name' => $lastName,
        'dob' => $dob,
        'email' => $email,
        'phone' => $phone,
    ];

    // API endpoint for KYC and onboarding
    $endpoint = $baseUrl . '/kyc-onboarding'; // Replace with actual API path

    // Make the API call
    $response = callDecentroAPI($endpoint, $payload, $clientID, $clientSecret, $moduleSecret);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Decentro API Integration</title>
</head>
<body>
    <h1>Decentro KYC Onboarding Form</h1>

    <!-- Form for user input -->
    <form method="POST" action="">
        <label for="first_name">First Name:</label><br>
        <input type="text" id="first_name" name="first_name" required><br><br>

        <label for="last_name">Last Name:</label><br>
        <input type="text" id="last_name" name="last_name" required><br><br>

        <label for="dob">Date of Birth:</label><br>
        <input type="date" id="dob" name="dob" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="phone">Phone:</label><br>
        <input type="tel" id="phone" name="phone" required><br><br>

        <button type="submit">Submit</button>
    </form>

    <?php if ($response): ?>
        <h2>API Response:</h2>
        <pre><?php print_r($response); ?></pre>
    <?php endif; ?>
</body>
</html>
