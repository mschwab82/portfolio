<?php

function isPost(): bool
{
    return strtoupper($_SERVER['REQUEST_METHOD']) === 'POST';
}

function isAjax(): bool
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 'XMLHttpRequest' === $_SERVER['HTTP_X_REQUESTED_WITH'];
}

function escape(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function getRandomHash(int $length): string
{
    $randomInt = random_int(0, time());
    $hash = md5($randomInt);
    $start = random_int(0, strlen($hash) - $length);
    $hashShort = substr($hash, $start, $length);
    return $hashShort;
}

function flashMessage(?string $message = null)
{
    if (!isset($_SESSION['messages'])) {
        $_SESSION['messages'] = [];
    }
    if (!$message) {
        $messages = $_SESSION['messages'];
        $_SESSION['messages'] = [];
        return $messages;
    }
    $_SESSION['messages'][] = $message;
}

function convertToMoney(int $cent): string
{
    $money = $cent / 100;
    return number_format($money, 2, ",", " ");
}

function sendMail(Swift_Message $message): bool
{
    $transport = new Swift_SmtpTransport(SMTP_HOST, SMPT_PORT, SMTP_SSL);
    $transport->setUsername(SMTP_USERNAME);
    $transport->setPassword(SMTP_PASSWORD);

    $mailer = new Swift_Mailer($transport);
    return $mailer->send($message);
}

function logData(string $level, string $message, ?array $data = null)
{
    $logDir = '../logs';
    $today = date('Y-m-d');
    $now = date('Y-m-d H:i:s');
    if (!is_dir($logDir)) {
        mkdir($logDir, 0777, true);
    }
    $logFile = $logDir . '/log-' . $today . '.log';

    $logData = '[' . $now . ']' . ' - ' .$message . "\n";

    if ($data) {
        $dataString = print_r($data, true) . "\n";
        $logData .= $dataString;
    }
   
    file_put_contents($logFile, $logData, FILE_APPEND);
}

function logEnd($string = '*')
{
    logData('INFO',str_repeat($string,100));
}

function normalizeFiles(array $files): array
{
    $result = [];
  
    foreach ($files as $keyName => $values) {
        foreach ($values as $index => $value) {
            $result[$index][$keyName] = $value;
        }
    }
   
    $typeToExtensionMap = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png'
    ];
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    foreach ($result as $index => $file) {
        $tempPath = $file['tmp_name'];
        if(!$tempPath){
            unset($result[$index]);
            continue;
        }
        $type = finfo_file($finfo, $tempPath);
        $result[$index]['type'] = $type;
        $result[$index]['size'] = filesize($tempPath);
        if (isset($typeToExtensionMap[$type])) {
            $result[$index]['extension'] = $typeToExtensionMap[$type];
        }
    }

    return $result;
}