<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ErrorController extends AbstractController
{
    public function showError(\Throwable $exception): Response
    {
        return $this->render('errors/error.html.twig', [
            'controller_name' => 'ErrorController',
        ]);
    }
}
