<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/Restaurant/list",name="listRestaurant")
     */
    public function restaurantAction(){
        $em = $this->getDoctrine()->getEntityManager()->getRepository("AppBundle:Restaurant");
        $s= $em->findAll();
        return $this->render("Default/resindex.html.twig",['listRestaurant' => $s]);
    }
    /**
     * @Route("/Activite/list",name="listActivite")
     */
    public function activiteAction(){
        $em = $this->getDoctrine()->getEntityManager()->getRepository("AppBundle:Activite");
        $s= $em->findAll();
        return $this->render("Default/actindex.html.twig",['listActivite' => $s]);
    }
    /**
     * @Route("/Contact",name="contact")
     */
    public function contactAction(){
        return $this->render("Default/contact.html.twig");
    }
}
