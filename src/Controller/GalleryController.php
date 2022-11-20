<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name: 'gallery.')]

class GalleryController extends AbstractController
{
    #[Route('/', name: 'base')]

    public function index()
    {

        // $logger->logData($_SERVER["REMOTE_ADDR"].' - '.$_SERVER["HTTP_USER_AGENT"]);

        $imagepath = './images/gallery/';

/*         $LoggerBuilder = new ContainerBuilder();
        $LoggerBuilder->register('logger.service', 'LoggerService');
        $LoggerService = $LoggerBuilder->get('logger.service'); */

        $JSONBuilder = new ContainerBuilder();
        $JSONBuilder->register('json.service', 'JSONService');
        $JSONService = $JSONBuilder->get('json.service');

        /*         $DBBuilder = new ContainerBuilder();
            $DBBuilder->register('db.service', 'DBService');
            $DBService = $DBBuilder->get('db.service'); */

/*         $MailerBuilder = new ContainerBuilder();
        $MailerBuilder->register('mailer.service', 'MailerService');
        $MailerService = $MailerBuilder->get('mailer.service'); */

        /*   
            $containerBuilder
            ->register('newsletter_manager', 'NewsletterManager')
            ->addMethodCall('setMailer', [new Reference('mailer')]);

            $newsletterManager = $containerBuilder->get('newsletter_manager');

            $MailerBuilder = new ContainerBuilder();
            $MailerBuilder->register('mailer.service', 'MailerService');
            $MailerService = $MailerBuilder->get('mailer.service'); 
        */

        // $LoggerService->logData($_SERVER["REMOTE_ADDR"] . ' - ' . $_SERVER["HTTP_USER_AGENT"]);

        if (!file_exists($imagepath . '01_JSON/' . '01_All.json')) {
            $JSONService->dirToArray($imagepath);
            $JSONService->MergeJSON($imagepath);
        }

        $JSON_File = $imagepath . '01_JSON' . '/' . '01_All' . '.json';

        $JSON = file_get_contents($JSON_File);
        $items = json_decode($JSON, true);

        $img_count = count($items);
        $per_page = 10;
        $max_pages = ceil($img_count / $per_page);

        // $show = array_slice($items, $per_page * intval($_GET['page']) - 1, $per_page);

        return $this->render('gallery/gallery.html.twig', [
            'items' => $items,
            'img_count' => $img_count,
            'per_page' => $per_page,
            'max_pages' => $max_pages
        ]);
    }
}
