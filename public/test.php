<?php

$bild = 'images/gallery/test/20220213-149-00136.jpg';

   if (exif_read_data($bild, 'IFD0')) {
    $exif = exif_read_data($bild, 0, true);
    echo $exif['COMPUTED']['Height'].'</br>';
    echo $exif['COMPUTED']['Width'].'</br>';
    echo $exif['COMPUTED']['ApertureFNumber'].'</br>';
    echo $exif['IFD0']['Make'].'</br>';
    echo $exif['IFD0']['Model'].'</br>';
    echo $exif['IFD0']['Artist'].'</br>';
    echo $exif['EXIF']['ExposureTime'].'</br>';
    echo $exif['EXIF']['FNumber'].'</br>';
    echo $exif['EXIF']['ISOSpeedRatings'].'</br>';
    echo $exif['EXIF']['DateTimeOriginal'].'</br>';
    echo $exif['EXIF']['ShutterSpeedValue'].'</br>';
    echo $exif['EXIF']['ApertureValue'].'</br>';
    echo $exif['EXIF']['UndefinedTag:0xA434'].'</br>';
   }

   // Additionnal informations from Lightroom
   getimagesize($bild, $infos);
   if ( isset($infos['APP13']) ) {
       $tags = iptcparse($infos['APP13']);
       print_r($tags['2#025']);
   }