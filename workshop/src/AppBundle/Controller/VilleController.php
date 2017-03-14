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
    /**
     * @Route("/Ville/edit/{id}",name="editVille", requirements={
    "id":"\d+"
     *  })
     */
    public function modifierAction($id, Request $request){
        $em= $this->getDoctrine()->getEntityManager();

        $ville=$em->getRepository("AppBundle:Ville")
            ->find($id);
        if ($ville==null){
            throw new NotFoundHttpException("La Ville n'existe pas");
        }
        $formulaire= $this->createForm(\AppBundle\Form\VilleType::class,$ville);
        if ($formulaire->handleRequest($request)->isValid()){
            $em->persist($ville);
            $em->flush();
            $this->addFlash('notice',"La Ville ".$ville->getNom()." a bien été modifée.");
            return $this->redirectToRoute("indexVille");
        }
        return $this->render("Ville/edit.html.twig",["formulaire"=>$formulaire->createView()]);
    }
}
