<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Activite;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class ActiviteController extends Controller
{
    /**
     * @Route("/Activite",name="indexActivite");
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager()->getRepository("AppBundle:Activite");
        $s= $em->findAll();
        return $this->render("AppBundle:Activite:index.html.twig",['listActivite' => $s]);
    }

    /**
    * @Route("/Activite/new",name="ajouterActivite")
    */
    public function addAction(Request $request)
    {
        $activite= new Activite();
        $form= $this->createForm(\AppBundle\Form\ActiviteType::class,$activite);
        if($form->handleRequest($request)->isValid()){
            $em= $this->getDoctrine()->getManager();
            $em->persist($activite);
            $em->flush();
            $this->addFlash('Success','Activite '.$activite->getNom().' ajoute');
            return $this->redirectToRoute("indexActivite");
        }
        return $this->render("AppBundle:Activite:add.html.twig",["form"=>$form->createView()]);
    }

    /**
     * @Route("/Activite/edit/{id}",name="editActivite", requirements={
    "id":"\d+"
     *  })
     */
    public function editAction($id,Request $request)
    {
        $em= $this->getDoctrine()->getEntityManager();

        $activite=$em->getRepository("AppBundle:Activite")
            ->find($id);
        if ($activite==null){
            throw new NotFoundHttpException("L'Activite n'existe pas");
        }
        $formulaire= $this->createForm(\AppBundle\Form\ActiviteType::class,$activite);
        if ($formulaire->handleRequest($request)->isValid()){
            $em->persist($activite);
            $em->flush();
            $this->addFlash('notice',"L'activite ".$activite->getNom()." a bien été modifée.");
            return $this->redirectToRoute("indexActivite");
        }
        return $this->render("AppBundle:Activite:edit.html.twig",["formulaire"=>$formulaire->createView()]);
    }

    /**
     * @Route("/Activite/del/{id}",name="delActivite", requirements={
     * "id":"\d+"
     *  })
     */
    public function delAction($id,Request $request)
    {
        $em= $this->getDoctrine()->getEntityManager();

        $activite=$em->getRepository("AppBundle:Activite")
            ->find($id);
        if ($activite==null){
            throw new NotFoundHttpException("L'activite n'existe pas");
        }
        $em->remove($activite);
        $em->flush();
        return $this->redirectToRoute("indexActivite");
    }

}
