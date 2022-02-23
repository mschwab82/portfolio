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
                // $tags = iptcparse($infos['APP13']);

            
                $metadata = array(
                    $exif['COMPUTED']['Height'], 
                    $exif['COMPUTED']['Width'], 
                    $exif['COMPUTED']['ApertureFNumber'],
                    $exif['IFD0']['Make'],
                    $exif['IFD0']['Model'],
                    $exif['IFD0']['Artist'],
                    $exif['EXIF']['ExposureTime'],
                    $exif['EXIF']['FNumber'],
                    $exif['EXIF']['ISOSpeedRatings'],
                    $exif['EXIF']['DateTimeOriginal'],
                    $exif['EXIF']['ShutterSpeedValue'],
                    $exif['EXIF']['ApertureValue'],
                    $exif['EXIF']['UndefinedTag:0xA434'],
                    // $tags['2#025']
                );
            
                $result[$value] = $metadata;
            }
        }
    }

    return $result;
}

$imagepath = 'images/gallery/';

$items = dirToArray($imagepath);

print ('<pre>');
print_r($items);
print ('</pre>');

?>