<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Restaurant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantController extends Controller
{
    /**
     * @Route("/Restaurant",name="indexRestaurant")
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager()->getRepository("AppBundle:Restaurant");
        $s= $em->findAll();
        return $this->render("Restaurant/index.html.twig",['listRestaurant' => $s]);
    }
    /**
     * @Route("/Restaurant/new",name="ajouterRestaurant")
     */
    public function add(Request $request){
        $restaurant= new Restaurant();
        $form= $this->createForm(\AppBundle\Form\RestaurantType::class,$restaurant);
        if($form->handleRequest($request)->isValid()){
            $em= $this->getDoctrine()->getManager();
            $em->persist($restaurant);
            $em->flush();
            $this->addFlash('Success','Restaurant '.$restaurant->getNom().' add');
            return $this->redirectToRoute("indexRestaurant");
        }
        return $this->render("Restaurant/new.html.twig",["form"=>$form->createView()]);

    }
    /**
     * @Route("/Restaurant/edit/{id}",name="editRestaurant", requirements={"id":"\d+"})
     */
    public function modifierAction($id, Request $request){
        $em= $this->getDoctrine()->getEntityManager();

        $restaurant=$em->getRepository("AppBundle:Restaurant")
            ->find($id);
        if ($restaurant==null){
            throw new NotFoundHttpException("Le restaurant n'existe pas");
        }
        $formulaire= $this->createForm(\AppBundle\Form\VilleType::class,$restaurant);
        if ($formulaire->handleRequest($request)->isValid()){
            $em->persist($restaurant);
            $em->flush();
            $this->addFlash('notice',"Le Restaurant ".$restaurant->getNom()." a bien été modifée.");
            return $this->redirectToRoute("indexRestaurant");
        }
        return $this->render("Restaurant/edit.html.twig",["formulaire"=>$formulaire->createView()]);

    }

    /**
     * @Route("/Restaurant/del/{id}",name="delRestaurant", requirements={
     * "id":"\d+"
     *  })
     */
    public function delAction($id,Request $request){
        $em= $this->getDoctrine()->getEntityManager();

        $restaurant=$em->getRepository("AppBundle:Restaurant")
            ->find($id);
        if ($restaurant==null){
            throw new NotFoundHttpException("Le restaurant n'existe pas");
        }
        $em->remove($restaurant);
        $em->flush();
        return $this->redirectToRoute("indexRestaurant");


    }

}
