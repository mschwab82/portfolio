<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/", name="gallery.")
 */
class GalleryController extends AbstractController
{
    /**
     * @Route("/", name="base")
     */

    public function index(): Response
    {
        function dirToArray($dir) {

            $result = array();
            $cdir = scandir($dir);
            $imagepath = $dir;
    
            foreach ($cdir as $key => $value) {
                if (!in_array($value,array(".","..","01_JSON"))) {
                    if (is_dir($dir . '/' . $value)) {
                        $filename = $imagepath.'01_JSON'.'/'.$value.'.json';

                        $result[$value] = dirToArray($dir . '/' . $value);
                        
                        $json_encoded = json_encode($result[$value]);
                        file_put_contents($filename, $json_encoded);
                    }
                    else {
                        $result[] = $value;
                    }
                }
            }
    
            return $result;
        }

        $imagepath = 'images/gallery/';

        $items = dirToArray($imagepath);

 /*        $JSON = file_get_contents($imagepath.'01_JSON'.'/'.'all'.'.json');

		$items = json_decode($JSON, true); */

/*         print ('<pre>');
        print_r($items);
        print ('</pre>'); */

        return $this->render('gallery/album.html.twig', [
            'items' => $items,
        ]);
    }

    /**
     * @Route("gallery/view/{id}", name="view")
     */
    public function view(Request $child) {

        function dirToArray1($dir) {

            $result = array();
            $cdir = scandir($dir);
    
            foreach ($cdir as $key => $value) {
    
                if (!in_array($value,array(".","..","01_JSON"))) {
                    if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
                        $result[$value] = dirToArray1($dir . DIRECTORY_SEPARATOR . $value);
                    }
                    else {
                        $result[] = $value;
                    }
                }
            }
            return $result;
        }
    
        $gallery_id = $child->attributes->get('id');

        $imagepath = 'images/gallery/'.$gallery_id;

        $items = dirToArray1($imagepath);

        //Responsea
        return $this->render('gallery/images.html.twig', [

            'child' => $gallery_id,
            'items' => $items
        ]);
    }
}