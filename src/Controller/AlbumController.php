<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/album', name: 'album.')]

class AlbumController extends AbstractController
{

    #[Route('/{album_id}', name: 'index')]
    public function album(Request $child)
    {

/*         $LoggerBuilder = new ContainerBuilder();
        $LoggerBuilder->register('logger.service', 'LoggerService');
        $LoggerService = $LoggerBuilder->get('logger.service'); */

        $album_id = $child->attributes->get('album_id');

        $imagepath = $_SERVER['DOCUMENT_ROOT'] . '/images/gallery/';

        $JSON = file_get_contents($imagepath . '01_JSON' . '/' . $album_id . '.json');

        $items = json_decode($JSON, true);

        $img_count = count($items[$album_id]);
        $per_page = 10;
        $max_pages = ceil($img_count / $per_page);

        // $LoggerService->logData($_SERVER["REMOTE_ADDR"] . ' - ' . 'Album ' . $album_id . ' wurde aufgerufen');



        return $this->render('album/album.html.twig', [
            'album' => $album_id,
            'items' => $items,
            'img_count' => $img_count,
            'per_page' => $per_page,
            'max_pages' => $max_pages
        ]);
    }

    #[Route('/{album_id}/{image_id}', name: 'details')]
    public function details(Request $child)
    {

/*         $LoggerBuilder = new ContainerBuilder();
        $LoggerBuilder->register('logger.service', 'LoggerService');
        $LoggerService = $LoggerBuilder->get('logger.service'); */

        $album_id = $child->attributes->get('album_id');
        $image_id = $child->attributes->get('image_id');

        $imagepath = $_SERVER['DOCUMENT_ROOT'] . '/images/gallery/';

        $JSON = file_get_contents($imagepath . '01_JSON' . '/' . $album_id . '.json');

        $items = json_decode($JSON, true);

        $details_items = $items[$album_id][$image_id];
        $details_tags = $items[$album_id][$image_id]['Tags'];

        // $LoggerService->logData($_SERVER["REMOTE_ADDR"] . ' - ' . 'Bild ' . $image_id . ' aus Album ' . $album_id . ' wurde aufgerufen');

        return $this->render('album/details.html.twig', [

            'album' => $album_id,
            'image' => $image_id,
            'items' => $details_items,
            'tags' => $details_tags
        ]);
    }
}
