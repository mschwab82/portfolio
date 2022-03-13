<?php
 
function dirToArray($dir) {

    $result = array();
    $cdir = scandir($dir);
    $imagepath = $dir;

    foreach ($cdir as $key => $value) {
        if (!in_array($value,array(".","..","01_JSON"))) {

            if (is_dir($dir . $value)) {
                $filename = $imagepath.'01_JSON'.'/'.$value.'.json';
                
                $result[$value][$value] = dirToArray($dir . $value);

                $json_encoded = json_encode($result[$value]);
                file_put_contents($filename, $json_encoded);
            }
            else {
                $value_image = $imagepath.'/'.$value;
                getimagesize($value_image, $infos);
                $exif = exif_read_data($value_image, 0, true);
                $tags = iptcparse($infos['APP13']);

                $metadata = array(

                    'ApertureFNumber' => $exif['COMPUTED']['ApertureFNumber'],
                    'FocalLength' => substr($exif['EXIF']['FocalLength'], 0, -2),
                    'ExposureTime' => $exif['EXIF']['ExposureTime'],
                    'ISOSpeedRatings' => $exif['EXIF']['ISOSpeedRatings'],
                    'DateTimeOriginal' => $exif['EXIF']['DateTimeOriginal'],
                    'Lens' => $exif['EXIF']['UndefinedTag:0xA434'],
                    'Tags' => $tags['2#025']
                    
                    /* 'Height' => $exif['COMPUTED']['Height'],
                    'Width' => $exif['COMPUTED']['Width'],
                    'Model' => $exif['IFD0']['Model'], 
                    'Artist' => $exif['IFD0']['Artist'], */
                );
            
                $result[$value] = $metadata;
            }
        }
    }

    return $result;
}

$imagepath = '../images/gallery/';

$items = dirToArray($imagepath);

print ('<pre>');
print_r($items);
print ('</pre>');

?>