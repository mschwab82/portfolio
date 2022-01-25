<?php

$bild = 'images/gallery/20220115-145-00029.jpg';


if (exif_read_data($bild, 'IFD0')) {
    $exif = exif_read_data($bild, 0, true);
    foreach ($exif as $key => $section) {
     foreach ($section as $name => $val) {
    echo $selection['COMPUTED'].['Height'];
    echo $exif['COMPUTED'].['Width'];
    echo $exif['COMPUTED'].['ApertureFNumber'];
    echo $exif['IFD0'].['Make'];
    echo $exif['IFD0'].['Model'];
    echo $exif['IFD0'].['Artist'];
    echo $exif['EXIF'].['ExposureTime'];
    echo $exif['EXIF'].['FNumber'];
    echo $exif['EXIF'].['ISOSpeedRatings'];
    echo $exif['EXIF'].['DateTimeOriginal'];
    echo $exif['EXIF'].['ShutterSpeedValue'];
    echo $exif['EXIF'].['ApertureValue'];
    echo $exif['EXIF'].['UndefinedTag'];
     }
    }
   }
/* 
if (exif_read_data($bild, 'IFD0')) {
    $exif = exif_read_data($bild);
    echo $exif['FILE']['FileName'];


echo $exif['FILE'].['FileName'];
    echo $exif['COMPUTED'].['Height'];
    echo $exif['COMPUTED'].['Width'];
    echo $exif['COMPUTED'].['ApertureFNumber'];
    echo $exif['IFD0'].['Make'];
cho $exi    echo $exif['IFD0'].['Model'];
    echo $exif['IFD0'].['Artist'];
    echo $exif['EXIF'].['ExposureTime'];
    echo $exif['EXIF'].['FNumber'];
    ef['EXIF'].['ISOSpeedRatings'];
    echo $exif['EXIF'].['DateTimeOriginal'];
    echo $exif['EXIF'].['ShutterSpeedValue'];
    echo $exif['EXIF'].['ApertureValue'];
    echo $exif['EXIF'].['UndefinedTag'];
} */