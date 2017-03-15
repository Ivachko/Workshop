<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Categorie;
use AppBundle\Entity\Restaurant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends Controller
{
    /**
     * @Route("/Categorie",name="indexCategorie")
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager()->getRepository("AppBundle:Categorie");
        $s= $em->findAll();
        return $this->render("Categorie/index.html.twig",['listCategorie' => $s]);
    }
    /**
     * @Route("/Categorie/add",name="ajouterCategorie")
     */
    public function add(Request $request){
        $categorie= new Categorie();
        $form= $this->createForm(\AppBundle\Form\CategorieType::class,$categorie);
        if($form->handleRequest($request)->isValid()){
            $em= $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();
            $this->addFlash('Success','Restaurant '.$categorie->getNom().' add');
            return $this->redirectToRoute("indexCategorie");
        }
        return $this->render("Categorie/add.html.twig",["form"=>$form->createView()]);

    }

    /**
     * @Route("/Categorie/edit/{id}",name="editCategorie", requirements={
    "id":"\d+"
     *  })
     */
    public function modifierAction($id, Request $request){
        $em= $this->getDoctrine()->getEntityManager();

        $categorie=$em->getRepository("AppBundle:Categorie")
            ->find($id);
        if ($categorie==null){
            throw new NotFoundHttpException("La Categorie n'existe pas");
        }
        $formulaire= $this->createForm(\AppBundle\Form\CategorieType::class,$categorie);
        if ($formulaire->handleRequest($request)->isValid()){
            $em->persist($categorie);
            $em->flush();
            $this->addFlash('notice',"La Categorie ".$categorie->getNom()." a bien été modifée.");
            return $this->redirectToRoute("indexCategorie");
        }
        return $this->render("Categorie/edit.html.twig",["formulaire"=>$formulaire->createView()]);
    }
    /**
     * @Route("/Categorie/del/{id}",name="delCategorie", requirements={
     * "id":"\d+"
     *  })
     */
    public function delAction($id,Request $request){
        $em= $this->getDoctrine()->getEntityManager();

        $categorie=$em->getRepository("AppBundle:Categorie")
            ->find($id);
        if ($categorie==null){
            throw new NotFoundHttpException("La Categorie n'existe pas");
        }
        $em->remove($categorie);
        $em->flush();
        return $this->redirectToRoute("indexCategorie");


    }
}
