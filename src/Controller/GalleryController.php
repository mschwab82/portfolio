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
        $imagepath = 'images/gallery/';

        $JSON = file_get_contents($imagepath.'01_JSON'.'/'.'All'.'.json');

		$items = json_decode($JSON, true);

        return $this->render('gallery/album.html.twig', [
            'items' => $items,
        ]);
    }

    /**
     * @Route("gallery/view/{id}", name="view")
     */
    public function view(Request $child) {

        $gallery_id = $child->attributes->get('id');

        $imagepath = 'images/gallery/';

        $JSON = file_get_contents($imagepath.'01_JSON'.'/'.$gallery_id.'.json');

		$items = json_decode($JSON, true);

        return $this->render('gallery/images.html.twig', [

            'child' => $gallery_id,
            'items' => $items
        ]);
    }
}