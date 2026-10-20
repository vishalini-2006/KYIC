<?php
// credit-report-cibil-nativepdf.php
declare(strict_types=1);
session_start();
date_default_timezone_set('Asia/Kolkata');

// ---------------- CONFIG ----------------
$apiUrl      = "https://cyrusrecharge.in/api/total-kyc.aspx";
$merchantId  = getenv('CYRUS_MERCHANT_ID') ?: 'AP895911';
$merchantKey = getenv('CYRUS_MERCHANT_KEY') ?: '04099D4681';

// --------------- HELPERS ----------------
function make_txnid(): string { return "CR-" . date("YmdHis") . "-" . bin2hex(random_bytes(3)); }
function is_assoc(array $a): bool { return array_keys($a) !== range(0, count($a) - 1); }

/**
 * Humanize a single token (removes noisy prefixes).
 * We'll call this only on the final token so labels stay clean like "Client Id" or "Address".
 */
function humanize_key(string $k): string {
    $k = (string)$k;
    // remove leading noisy parts like data-, data_, or stray prefixes; keep important words if present
    $k = preg_replace(['/^(data-?|data_)/i', '/^.*?>/'], ['', ''], $k);
    $k = str_replace(['_', '.', '>', ':', '-'], ' ', $k);
    $k = preg_replace('/\s+/', ' ', trim($k));
    if ($k === '') return 'Value';
    return ucwords($k);
}

/**
 * flatten_readable: flattens complex API responses into [$label, $value] pairs.
 * IMPORTANT: it strips any prefix chain like "A > B > C" and keeps only the last token,
 * then runs humanize_key() — so you will NOT see "Value > Client Id".
 */
function flatten_readable($data, string $prefix = '', array &$out = []): array {
    if (is_array($data)) {
        if (is_assoc($data)) {
            foreach ($data as $k => $v) {
                // keep building the path but we will only use the final token for display
                $p = $prefix ? ($prefix . " > " . (string)$k) : (string)$k;
                flatten_readable($v, $p, $out);
            }
        } else {
            $i = 1;
            foreach ($data as $v) {
                $p = $prefix ? ($prefix . " > Item $i") : "Item $i";
                flatten_readable($v, $p, $out);
                $i++;
            }
        }
    } else {
        $val = is_scalar($data) ? (string)$data : json_encode($data, JSON_UNESCAPED_SLASHES);
        $label = $prefix ?: 'Value';
        if (strpos($label, ' > ') !== false) {
            $parts = explode(' > ', $label);
            $label = end($parts);
        }
        $label = humanize_key((string)$label);
        $out[] = [$label, $val];
    }
    return $out;
}

// PDF text escaper (safe for literal text in simple PDF text show)
function pdf_escape_text(string $s): string {
    return str_replace(['\\', '(', ')'], ['\\\\', '\\(', '\\)'], $s);
}

// ---------------- CURL WITH RETRIES ----------------
function do_post_with_retries(string $url, string $payload, array $headers = [], int $maxAttempts = 3) {
    $debugStream = fopen('php://temp', 'w+');
    $ch = curl_init($url);
    $opts = [
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $payload,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_CONNECTTIMEOUT => 15,
        CURLOPT_TIMEOUT => 90,
        CURLOPT_IPRESOLVE => defined('CURL_IPRESOLVE_V4') ? CURL_IPRESOLVE_V4 : 1,
        CURLOPT_VERBOSE => true,
        CURLOPT_STDERR => $debugStream,
        CURLOPT_SSL_VERIFYPEER => true,
    ];
    curl_setopt_array($ch, $opts);

    $response = false; $curlError = ''; $httpCode = 0;
    for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
        $response = curl_exec($ch);
        $curlError = curl_error($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($response !== false && $httpCode >= 200 && $httpCode < 400) break;
        if ($attempt < $maxAttempts) sleep(1 + $attempt);
    }

    rewind($debugStream);
    $curlDebug = stream_get_contents($debugStream);
    fclose($debugStream);
    curl_close($ch);
    return ['response' => $response, 'error' => $curlError, 'http' => $httpCode, 'debug' => $curlDebug];
}

// ---------------- IMPROVED NATIVE PDF GENERATOR (FULL-PAGE, MULTI-PAGE) ----------------
function output_native_pdf(array $rows, string $title = 'CIBIL Credit Report', string $timestamp = ''): void {
    // A4 points
    $W = 595; $H = 842;
    $margin = 36;
    $col1w = 180;
    $gutter = 12;
    $lineH = 12;
    $valueColW = $W - ($margin * 2) - $col1w - $gutter;

    // small character-wrap helper (approx)
    $wrap = function(string $text, int $maxChars) {
        $text = trim($text);
        if ($text === '') return [''];
        $parts = preg_split('/(.{1,' . $maxChars . '})(?:\s+|$)/u', $text, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
        return $parts ?: [$text];
    };

    // Clean rows: keep only last token for label and humanize
    $cleanRows = [];
    foreach ($rows as $r) {
        $f = isset($r[0]) ? (string)$r[0] : 'Value';
        $tokens = preg_split('/[>:\\/_\-\.\|]+/', $f);
        $last = array_pop(array_filter($tokens, fn($t)=>trim($t) !== ''));
        if (!$last) $last = $f;
        $fieldNice = humanize_key($last);
        $value = isset($r[1]) ? (string)$r[1] : '';
        $cleanRows[] = [$fieldNice, $value];
    }

    // Build page content streams
    $pages = [];
    $stream = '';
    $yStart = $H - $margin;
    $y = $yStart;

    $add_header = function(&$s, $pageNum) use ($margin, $yStart, $title, $timestamp) {
        $s .= "BT\n/F1 18 Tf\n{$margin} {$yStart} Td\n(" . pdf_escape_text($title) . ") Tj\nET\n";
        if ($timestamp !== '') {
            $s .= "BT\n/F1 9 Tf\n{$margin} " . ($yStart - 16) . " Td\n(" . pdf_escape_text("Response Time (IST): $timestamp") . ") Tj\nET\n";
        }
        $s .= "BT\n/F1 9 Tf\n{$margin} " . ($yStart - 28) . " Td\n(" . pdf_escape_text(str_repeat('=', 160)) . ") Tj\nET\n";
    };

    $add_header($stream, 1);
    $y -= 44;

    // Table header
    $stream .= "BT\n/F1 11 Tf\n{$margin} {$y} Td\n(" . pdf_escape_text('Field') . ") Tj\n";
    $stream .= ($margin + $col1w + $gutter) . " {$y} Td\n(" . pdf_escape_text('Value') . ") Tj\nET\n";
    $y -= ($lineH + 6);

    // Render rows
    foreach ($cleanRows as $kv) {
        [$field, $value] = $kv;
        $isBlock = preg_match('/address|remarks|comments|report|summary|details/i', $field);
        $fieldLines = $wrap($field, 28);
        $valWrap = $isBlock ? 90 : 60;
        $valueLines = $wrap($value, $valWrap);

        if ($isBlock) {
            $needed = max(1, count($valueLines));
            if ($y < ($margin + 40 + $needed * $lineH)) {
                $pages[] = $stream; $stream = ''; $y = $yStart; $add_header($stream, count($pages)+1); $y -= 44;
                $stream .= "BT\n/F1 11 Tf\n{$margin} {$y} Td\n(" . pdf_escape_text('Field') . ") Tj\n";
                $stream .= ($margin + $col1w + $gutter) . " {$y} Td\n(" . pdf_escape_text('Value') . ") Tj\nET\n";
                $y -= ($lineH + 6);
            }
            $stream .= "BT\n/F1 10 Tf\n{$margin} {$y} Td\n(" . pdf_escape_text($fieldLines[0] ?? '') . ") Tj\nET\n";
            $vy = $y;
            foreach ($valueLines as $vl) {
                $stream .= "BT\n/F1 10 Tf\n" . ($margin + $col1w + $gutter) . " {$vy} Td\n(" . pdf_escape_text($vl) . ") Tj\nET\n";
                $vy -= $lineH;
            }
            $y = $vy - 8;
            $stream .= "BT\n/F1 9 Tf\n{$margin} {$y} Td\n(" . pdf_escape_text(str_repeat('-', 120)) . ") Tj\nET\n";
            $y -= 12;
            continue;
        }

        $max = max(count($fieldLines), count($valueLines));
        for ($i=0; $i<$max; $i++) {
            if ($y < ($margin + 60)) {
                $pages[] = $stream; $stream = ''; $y = $yStart; $add_header($stream, count($pages)+1); $y -= 44;
                $stream .= "BT\n/F1 11 Tf\n{$margin} {$y} Td\n(" . pdf_escape_text('Field') . ") Tj\n";
                $stream .= ($margin + $col1w + $gutter) . " {$y} Td\n(" . pdf_escape_text('Value') . ") Tj\nET\n";
                $y -= ($lineH + 6);
            }
            $f = $fieldLines[$i] ?? '';
            $v = $valueLines[$i] ?? '';
            $stream .= "BT\n/F1 10 Tf\n{$margin} {$y} Td\n(" . pdf_escape_text($f) . ") Tj\n";
            $stream .= ($margin + $col1w + $gutter) . " {$y} Td\n(" . pdf_escape_text($v) . ") Tj\nET\n";
            $y -= $lineH;
        }
        $y -= 6;
    }

    if ($stream !== '') $pages[] = $stream;

    // Build PDF objects with contiguous IDs and correct xref
    $buf = "%PDF-1.4\n";
    $objects = [];
    $nextId = 1;
    $catalogId = $nextId++; //1
    $pagesId = $nextId++;   //2
    $fontReg = $nextId++;   //3
    $fontBold = $nextId++;  //4

    $pageIds = [];
    $contentMap = [];
    foreach ($pages as $pstream) {
        $cid = $nextId++;
        $pid = $nextId++;
        $contentMap[$cid] = $pstream;
        $pageIds[] = $pid;
        $objects[$pid] = "{$pid} 0 obj<< /Type /Page /Parent {$pagesId} 0 R /MediaBox [0 0 {$W} {$H}] /Resources << /Font << /F1 {$fontReg} 0 R /F2 {$fontBold} 0 R >> >> /Contents {$cid} 0 R >>endobj\n";
    }

    foreach ($contentMap as $cid => $body) {
        $objects[$cid] = "{$cid} 0 obj<< /Length " . strlen($body) . " >>stream\n{$body}\nendstream\nendobj\n";
    }

    $objects[$fontReg] = "{$fontReg} 0 obj<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>endobj\n";
    $objects[$fontBold] = "{$fontBold} 0 obj<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica-Bold >>endobj\n";

    $kids = implode(' ', array_map(fn($id)=>"$id 0 R", $pageIds));
    $objects[$pagesId] = "{$pagesId} 0 obj<< /Type /Pages /Kids [ $kids ] /Count " . count($pageIds) . " >>endobj\n";
    $objects[$catalogId] = "{$catalogId} 0 obj<< /Type /Catalog /Pages {$pagesId} 0 R >>endobj\n";

    ksort($objects, SORT_NUMERIC);
    $offsets = [];
    foreach ($objects as $o) { $offsets[] = strlen($buf); $buf .= $o; }

    $maxObj = max(array_keys($objects));
    $xrefStart = strlen($buf);
    $buf .= "xref\n0 " . ($maxObj + 1) . "\n";
    $buf .= "0000000000 65535 f \n";
    $objIds = array_keys($objects);
    $posMap = array_combine($objIds, $offsets);
    for ($i=1;$i<=$maxObj;$i++) {
        if (isset($posMap[$i])) $buf .= sprintf("%010d 00000 n \n", $posMap[$i]); else $buf .= "0000000000 00000 n \n";
    }
    $buf .= "trailer<< /Size " . ($maxObj + 1) . " /Root {$catalogId} 0 R >>\nstartxref\n{$xrefStart}\n%%EOF";

    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="cibil_report_' . date('Ymd_His') . '.pdf"');
    echo $buf;
    exit;
}

// ---------------- DOWNLOAD HANDLER ----------------
if (isset($_GET['download']) && isset($_SESSION['last_response'])) {
    $type = strtolower($_GET['download']);
    $respArr = $_SESSION['last_response'];
    $respTime = $_SESSION['last_response_time'] ?? date('Y-m-d H:i:s');

    if ($type === 'json') {
        header('Content-Type: application/json; charset=utf-8');
        header('Content-Disposition: attachment; filename="cibil_response_' . date('Ymd_His') . '.json"');
        echo json_encode(['response_time_ist' => $respTime, 'data' => $respArr], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        exit;
    }
    if ($type === 'csv') {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="cibil_response_' . date('Ymd_His') . '.csv"');
        $out = fopen('php://output', 'w');
        fputcsv($out, ['Field','Value']);
        fputcsv($out, ['Response Time (IST)', $respTime]);
        $rows = []; flatten_readable($respArr,'',$rows);
        foreach ($rows as $r) fputcsv($out, $r);
        fclose($out); exit;
    }
    if ($type === 'pdf') {
        $rows = []; flatten_readable($respArr, '', $rows);
        array_unshift($rows, ['Response Time (IST)', $respTime]);
        output_native_pdf($rows, 'CIBIL Credit Report', $respTime);
        exit;
    }
    http_response_code(400); echo "Invalid download type"; exit;
}

// ---------------- MAIN (FORM + REQUEST) ----------------
$defaultTxn = make_txnid();
$error = null; $debugPayload = null; $responseData = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mobile  = trim($_POST['mobile'] ?? '');
    $pan     = trim($_POST['pan'] ?? '');
    $name    = trim($_POST['name'] ?? '');
    $gender  = trim($_POST['gender'] ?? 'male');
    $consent = strtoupper(trim($_POST['consent'] ?? 'Y'));
    $txnid   = trim($_POST['txnid'] ?? '') ?: make_txnid();

    if ($consent !== 'Y') $error = 'Consent must be Y.';
    if (!in_array($gender, ['male','female'], true)) $error = "Gender must be 'male' or 'female'.";
    if (!preg_match('/^[6-9]\d{9}$/', $mobile)) $error = $error ?? 'Invalid mobile.';
    if (!preg_match('/^[A-Z]{5}[0-9]{4}[A-Z]$/i', $pan)) $error = $error ?? 'Invalid PAN.';

    if (!$error) {
        $payloadArr = [
            "merchantId"  => $merchantId,
            "merchantKey" => $merchantKey,
            "mobile"      => $mobile,
            "pan"         => $pan,
            "name"        => $name,
            "gender"      => $gender,
            "consent"     => $consent,
            "type"        => 'CREDIT_REPORT_CIBIL',
            "txnid"       => $txnid
        ];
        $payload = json_encode($payloadArr, JSON_UNESCAPED_SLASHES);
        $headers = [
            "Accept: application/json",
            "Content-Type: application/json",
            "Content-Length: " . strlen($payload),
            "User-Agent: CyrusRechargeClient/1.5"
        ];
        $result = do_post_with_retries($apiUrl, $payload, $headers, 3);
        $debugPayload = $payload . "\n\n---CURL DEBUG---\n" . $result['debug'];

        if ($result['response'] === false) {
            $error = "cURL Error: " . $result['error'] . " (HTTP: " . $result['http'] . ")";
        } else {
            $decoded = json_decode($result['response'], true);
            $responseData = (json_last_error() === JSON_ERROR_NONE) ? $decoded : ['Raw' => (string)$result['response']];
            $_SESSION['last_response'] = $responseData;
            $_SESSION['last_response_time'] = date('Y-m-d H:i:s');
            session_regenerate_id(true);
        }
    }
}

// ---------------- HTML UI ----------------
?><!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>CIBIL Credit Report — Native PDF</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<style>
 body{font-family:Arial,Helvetica,sans-serif;background:#f5f7fb;margin:0;padding:20px}
 .card{max-width:1000px;margin:20px auto;background:#fff;padding:22px;border-radius:12px;box-shadow:0 8px 32px rgba(10,10,20,.06)}
 h1{margin:0 0 12px 0;font-size:22px}
 form{display:grid;gap:12px}
 .row2{display:grid;grid-template-columns:1fr 1fr;gap:12px}
 label{font-weight:700;font-size:13px}
 input,select{padding:10px;border:1px solid #d7dbe6;border-radius:8px;font-size:14px}
 button{padding:10px 14px;border:0;border-radius:8px;background:#0d6efd;color:#fff;cursor:pointer}
 .hint{color:#6b7280;font-size:13px}
 .download-bar{display:flex;gap:10px;margin-top:12px;flex-wrap:wrap}
 table{width:100%;border-collapse:collapse;margin-top:12px}
 th,td{border:1px solid #e6eefc;padding:8px;text-align:left;vertical-align:top}
 th{background:#0d6efd;color:#fff}
 pre{background:#f0f6ff;padding:10px;border-radius:8px;overflow:auto}
 .error{color:#c92b2b}
</style>
</head>
<body>
<div class="card">
  <h1>CIBIL Credit Report — Native PDF (no external libs)</h1>
  <p class="hint">Form submits to API; use Download PDF to get a full-page, formatted PDF report.</p>

  <?php if (!empty($error)): ?><div class="error"><?=htmlspecialchars($error)?></div><?php endif; ?>

  <form method="POST" action="">
    <div class="row2">
      <div>
        <label for="mobile">Mobile</label>
        <input id="mobile" name="mobile" value="<?=htmlspecialchars($_POST['mobile'] ?? '')?>" placeholder="e.g. 9876543210">
      </div>
      <div>
        <label for="pan">PAN</label>
        <input id="pan" name="pan" value="<?=htmlspecialchars($_POST['pan'] ?? '')?>" placeholder="ABCDE1234F">
      </div>
    </div>

    <div class="row2">
      <div>
        <label for="name">Name</label>
        <input id="name" name="name" value="<?=htmlspecialchars($_POST['name'] ?? '')?>" placeholder="Full name">
      </div>
      <div>
        <label for="gender">Gender</label>
        <select id="gender" name="gender">
          <option value="male" <?= (($_POST['gender'] ?? 'male') === 'male') ? 'selected' : '' ?>>male</option>
          <option value="female" <?= (($_POST['gender'] ?? '') === 'female') ? 'selected' : '' ?>>female</option>
        </select>
      </div>
    </div>

    <div class="row2">
      <div>
        <label for="consent">Consent (must be Y)</label>
        <input id="consent" name="consent" value="<?=htmlspecialchars($_POST['consent'] ?? 'Y')?>">
      </div>
      <div>
        <label for="txnid">Transaction ID</label>
        <input id="txnid" name="txnid" value="<?=htmlspecialchars($_POST['txnid'] ?? $defaultTxn)?>">
      </div>
    </div>

    <div style="display:flex;gap:10px;margin-top:8px">
      <button type="submit">Submit</button>
      <?php if (isset($_SESSION['last_response'])): ?>
        <div class="download-bar">
          <a href="?download=json"><button type="button">Download JSON</button></a>
          <a href="?download=csv"><button type="button">Download CSV</button></a>
          <a href="?download=pdf"><button type="button">Download PDF</button></a>
        </div>
      <?php endif; ?>
    </div>
  </form>

  <?php if (isset($_SESSION['last_response'])): ?>
    <h3 style="margin-top:18px">Last Response (simple)</h3>
    <table>
      <thead><tr><th>Field</th><th>Value</th></tr></thead>
      <tbody>
        <?php $rows = []; flatten_readable($_SESSION['last_response'],'',$rows); foreach ($rows as $r): ?>
          <tr><th><?=htmlspecialchars($r[0])?></th><td><?=nl2br(htmlspecialchars($r[1]))?></td></tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>

  <?php if (!empty($debugPayload)): ?>
    <h3>Request & Debug (dev)</h3>
    <pre><?=htmlspecialchars($debugPayload)?></pre>
  <?php endif; ?>
</div>
</body>
</html>
