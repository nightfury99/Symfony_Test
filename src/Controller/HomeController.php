<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="app_home")
     */
    public function index() {
        $request = Request::createFromGlobals();
        $name = !empty($request->query->get("name")) ? $request->query->get("name") : "Anonymous";
        $time = date("h:i:sa");
        $templateString = "Hi $name! 👋 Welcome to my blog ($time 🕰️)";
        
        $twig = $this->get('twig');
        $template = twig_template_from_string($twig, $templateString);
        $greeting = $template->render();
        echo $greeting;
        return $this->render('home/index.html.twig', [
            'greeting'  =>  $greeting
        ]);
    }
}
