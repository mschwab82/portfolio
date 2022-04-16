<?php

namespace App\Controller;

use App\Service\Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/', name: 'gallery.')]

class GalleryController extends AbstractController
{
    #[Route('/', name: 'base')]

    public function index(Mailer $mailer)

    {
        // $logger->logData($_SERVER["REMOTE_ADDR"].' - '.$_SERVER["HTTP_USER_AGENT"]);

        $imagepath = './images/gallery/';

        $LoggerBuilder = new ContainerBuilder();
            $LoggerBuilder->register('logger.service', 'LoggerService');
            $LoggerService = $LoggerBuilder->get('logger.service');

/*         $MailBuilder = new ContainerBuilder();
            $MailBuilder->register('mailer.service', 'Mailer');
            $Mailer = $MailBuilder->get('mailer.service'); */

        $JSONBuilder = new ContainerBuilder();
            $JSONBuilder->register('json.service', 'JSONService');
            $JSONService = $JSONBuilder->get('json.service');

        $LoggerService->logData($_SERVER["REMOTE_ADDR"].' - '.$_SERVER["HTTP_USER_AGENT"]);


        // $mailer->sendMail();

        if (!file_exists($imagepath.'01_JSON/'.'01_All.json')) {
        
           $JSONService->dirToArray($imagepath);
            $JSONService->MergeJSON($imagepath);
        }

        $JSON_File = $imagepath.'01_JSON'.'/'.'01_All'.'.json';

        $JSON = file_get_contents($JSON_File); 
        $items = json_decode($JSON, true);

/*         print_r('<pre>');
        print_r($items);
        print_r('</pre>'); */

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