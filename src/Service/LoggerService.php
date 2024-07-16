<?php

class LoggerService
{
  function logData(string $message, ?array $data = null)
  {
    $logDir = '../logs';
    $today = date('Y-m-d');
    $now = date('Y-m-d H:i:s');
    if (!is_dir($logDir)) {
      mkdir($logDir, 0777, true);
    }
    $logFile = $logDir . '/log-' . $today . '.log';

    $logData = '[' . $now . ']' . ' - ' . $message . "\n";

    if ($data) {
      $dataString = print_r($data, true) . "\n";
      $logData .= $dataString;
    }

    file_put_contents($logFile, $logData, FILE_APPEND);
  }
}