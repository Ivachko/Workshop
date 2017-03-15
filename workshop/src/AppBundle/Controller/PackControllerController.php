<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Pack_Activite;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class PackControllerController extends Controller
{
    /**
     * @Route("/Pack",name="indexPack")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager()->getRepository("AppBundle:Pack_Activite");
        $s= $em->findAll();
        return $this->render("AppBundle:PackController:index.html.twig",['listPackActivite' => $s]);
    }
    /**
     * @Route("/Pack/add",name="ajouterPack")
     */
    public function add(Request $request){
        $pack= new Pack_Activite();
        $form= $this->createForm(\AppBundle\Form\Pack_ActiviteType::class,$pack);
        if($form->handleRequest($request)->isValid()){
            $em= $this->getDoctrine()->getManager();
            $em->persist($pack);
            $em->flush();
            $this->addFlash('Success','Pack '.$pack->getNom().' add');
            return $this->redirectToRoute("indexPack");
        }
        return $this->render("AppBundle:Activite:add.html.twig",["form"=>$form->createView()]);

    }

    /**
     * @Route("/Pack/edit/{id}",name="editPack", requirements={
    "id":"\d+"
     *  })
     */
    public function editAction($id,Request $request)
    {
        $em= $this->getDoctrine()->getEntityManager();

        $pack=$em->getRepository("AppBundle:Pack_Activite")
            ->find($id);
        if ($pack==null){
            throw new NotFoundHttpException("Le pack n'existe pas");
        }
        $formulaire= $this->createForm(\AppBundle\Form\Pack_ActiviteType::class,$pack);
        if ($formulaire->handleRequest($request)->isValid()){
            $em->persist($pack);
            $em->flush();
            $this->addFlash('notice',"Le pack ".$pack->getNom()." a bien été modifée.");
            return $this->redirectToRoute("indexPack");
        }
        return $this->render("@App/PackController/edit.html.twig",["formulaire"=>$formulaire->createView()]);
    }


    /**
     * @Route("/Pack/del/{id}",name="delPack", requirements={
     * "id":"\d+"
     *  })
     */
    public function delAction($id,Request $request)
    {
        $em= $this->getDoctrine()->getEntityManager();

        $pack=$em->getRepository("AppBundle:Pack_Activite")
            ->find($id);
        if ($pack==null){
            throw new NotFoundHttpException("L'activite n'existe pas");
        }
        $em->remove($pack);
        $em->flush();
        return $this->redirectToRoute("indexPack");
    }

}
