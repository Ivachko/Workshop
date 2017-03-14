<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Ville;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class VilleController extends Controller
{
    /**
     * @Route("/Ville",name="indexVille")
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager()->getRepository("AppBundle:Ville");
        $s= $em->findAll();

        return $this->render('Ville/index.html.twig',['listVille' => $s]);
    }

    /**
     * @Route("/Ville/new",name="ajouterVille")
     */
    public function add(Request $request){
        $ville= new Ville();
        $form= $this->createForm(\AppBundle\Form\VilleType::class,$ville);
        if($form->handleRequest($request)->isValid()){
            $em= $this->getDoctrine()->getManager();
            $em->persist($ville);
            $em->flush();
            $this->addFlash('Success','Ville '.$ville->getNom().' add');
            return $this->redirectToRoute("indexVille");
        }
        return $this->render("Ville/new.html.twig",["form"=>$form->createView()]);

    }
}
