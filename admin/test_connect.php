<?php
$host = 'cyrusrecharge.in';
$ip = '103.13.112.3';
$port = 443;

echo "Trying fsockopen to $ip:$port...\n";
$start = microtime(true);
$s = @fsockopen($ip, $port, $errno, $errstr, 10);
$dur = microtime(true) - $start;
if ($s) {
    echo "TCP connect OK ( {$dur}s )\n";
    fclose($s);
} else {
    echo "TCP connect FAILED after {$dur}s — $errno $errstr\n";
}

echo "\nRunning curl test...\n";
$ch = curl_init("https://$host/");
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_VERBOSE => true,
    CURLOPT_CONNECTTIMEOUT => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
]);
$out = curl_exec($ch);
$err = curl_error($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
fwrite(STDERR, "cURL error: $err (HTTP $code)\n");
echo "Response length: " . strlen($out) . "\n";
curl_close($ch);
