<?php

namespace App\Controller;

use App\Service\Logger;
use App\Service\JSON;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name: 'gallery.')]

class GalleryController extends AbstractController
{
    #[Route('/', name: 'base')]

    public function index(Logger $logger, JSON $JSON): Response
    {
        $imagepath = './images/gallery/';

        $logger->logData($_SERVER["REMOTE_ADDR"].' - '.$_SERVER["HTTP_USER_AGENT"]);

        $logger->logData('Galleriepart wurde aufgerufen');

        // $JSON->dirToArray($imagepath);

        $JSON_File = $imagepath.'01_JSON'.'/'.'All'.'.json';

/*         if(!is_file($JSON_File)) {
            $items = dirToArray($imagepath);
            logData('Datei ist nicht vorhanden und wurde erstellt. Es wurden ' . count($items) . ' Gallerien eingelesen');  
        } */

        $JSON = file_get_contents($JSON_File);
        $items = json_decode($JSON, true);

        $logger->logData('Es wurden ' . count($items) . ' Gallerien eingelesen');

        return $this->render('gallery/album.html.twig', [
            'items' => $items,
        ]);
    }

    #[Route('/album/{id}', name: 'album')]

    public function album(Request $child) {

        $gallery_id = $child->attributes->get('id');

        $imagepath = $_SERVER['DOCUMENT_ROOT'] . '/images/gallery/';

        $JSON = file_get_contents($imagepath.'01_JSON'.'/'.$gallery_id.'.json');

		$items = json_decode($JSON, true);

        // logData('Album ' . $gallery_id . ' wird aufgerufen');

        return $this->render('gallery/images.html.twig', [

            'child' => $gallery_id,
            'items' => $items
        ]);
    }
}