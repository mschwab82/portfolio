<?php

$imagepath = '../images/gallery/';

  $files = array_diff(scandir($imagepath), ['.','..','01_JSON']);

  // File with Path
  foreach ($files as &$value) {
      $value = $imagepath.$value.'.json';
  }

  $valle = array();
  
  foreach($files as $vurl) { 
    if (file_exists($vurl)) {
      $vres = json_decode(file_get_contents($vurl), true); 
      $value = array_merge($valle,$vres); 
    } 
  }
  
  $savedata2 = json_encode($value); 
  $savefile2 = $imagepath.'All.json'; 
  
  file_put_contents($savefile2, $savedata2, LOCK_EX);