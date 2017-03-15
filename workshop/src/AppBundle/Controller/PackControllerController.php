<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PackControllerController extends Controller
{
    /**
     * @Route("/Pack")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:PackController:index.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/Pack/Add")
     */
    public function addAction()
    {
        return $this->render('AppBundle:PackController:add.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/Pack/edit/{id}")
     */
    public function editAction($id)
    {
        return $this->render('AppBundle:PackController:edit.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/Pack/del/{id}")
     */
    public function delAction($id)
    {
        return $this->render('AppBundle:PackController:del.html.twig', array(
            // ...
        ));
    }

}
