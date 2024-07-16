<?php

use Symfony\Component\Finder\Finder;

class JSONService
{

  function dirToArray($dir_albums)
  {

    $result = array();
    $cdir = scandir($dir_albums);
    $imagepath = $dir_albums;

    print_r('<pre>');
    print_r($cdir);
    print_r('</pre>');

    foreach ($cdir as $key => $value) {

      if (!in_array($value, array(".", "..", "01_JSON"))) {

        if (is_dir($dir_albums . $value)) {
          $filename = $imagepath . '01_JSON' . '/' . $value . '.json';


          $result[$value][$value] = $this->dirToArray($dir_albums . $value);

          $json_encoded = json_encode($result[$value]);
          file_put_contents($filename, $json_encoded);
        } else {
          $value_image = $imagepath . '/' . $value;
          getimagesize($value_image, $infos);
          $exif = exif_read_data($value_image, 0, true);

          $tags = iptcparse($infos['APP13']);

          if (!isset(($tags['2#025']))) {
            $tags['2#025'] = null;
          }

          $metadata = array(

            'ApertureFNumber' => $exif['COMPUTED']['ApertureFNumber'],
            'FocalLength' => substr($exif['EXIF']['FocalLength'], 0, -2),
            'ExposureTime' => $exif['EXIF']['ExposureTime'],
            'ISOSpeedRatings' => $exif['EXIF']['ISOSpeedRatings'],
            'DateTimeOriginal' => date('d.m.Y H:i:s', strtotime($exif['EXIF']['DateTimeOriginal'])),
            'Lens' => $exif['EXIF']['UndefinedTag:0xA434'],
            
            /* 'Tags' => $tags['2#025']

              'Height' => $exif['COMPUTED']['Height'],
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

  function MergeJSON($dir_json)
  {

    $JSONFiles = new Finder();

    $JSONFiles
      ->name('*.json')
      ->files()->in($dir_json);

    foreach ($JSONFiles as $file) {
      $file->getContents();
    }

    $valle = array();

    foreach ($JSONFiles as $vurl) {
      if (file_exists($vurl)) {
        $vres = json_decode(file_get_contents($vurl), true);
        $valle = array_merge($valle, $vres);
      }
    }

    $savedata2 = json_encode($valle);
    $savefile2 = $dir_json . '/01_JSON/' . '01_All.json';

    file_put_contents($savefile2, $savedata2, LOCK_EX);
  }
}
