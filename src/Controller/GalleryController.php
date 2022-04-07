<?php

namespace App\Controller;

use App\Service\MakeJSON_Service;
use FilesystemIterator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name: 'gallery.')]

class GalleryController extends AbstractController
{
    #[Route('/', name: 'base')]

    public function index(): Response
    {
        // $logger->logData($_SERVER["REMOTE_ADDR"].' - '.$_SERVER["HTTP_USER_AGENT"]);


        $imagepath = './images/gallery/';

        $containerBuilder = new ContainerBuilder();

            $containerBuilder->register('logger.service', 'LoggerService');
            $LoggerService = $containerBuilder->get('logger.service');
            $LoggerService->logData($_SERVER["REMOTE_ADDR"].' - '.$_SERVER["HTTP_USER_AGENT"]);

        $test_dir = new MakeJSON_Service();
        $test_dir->dirToArray($imagepath);

        $JSON_File = $imagepath.'01_JSON'.'/'.'All'.'.json';

        $LoggerService->logData($JSON_File);

        $JSON = file_get_contents($JSON_File);
        $items = json_decode($JSON, true);

        // $logger->logData('Es wurden ' . count($items) . ' Gallerien eingelesen');

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

        return $this->render('gallery/images.html.twig', [

            'child' => $gallery_id,
            'items' => $items
        ]);
    }
}