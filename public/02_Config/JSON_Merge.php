<?php

  $imagepath = '../images/gallery/01_JSON/';

  $files = array_diff(scandir($imagepath), ['.','..']);

  // File with Path
  foreach ($files as &$value) {
      $value = $imagepath.$value;
  }

  $valle = array();
  
  foreach($files as $vurl) { 
    if (file_exists($vurl)) {
      $vres = json_decode(file_get_contents($vurl), true); 
      $valle = array_merge($valle,$vres); 
    } 
  }
  
  $savedata2 = json_encode($valle); 
  $savefile2 = $imagepath.'All.json'; 
  
  file_put_contents($savefile2, $savedata2, LOCK_EX);