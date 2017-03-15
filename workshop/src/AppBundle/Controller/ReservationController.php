<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class ReservationController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
    /**
     * @Route("/Reservation/restaurant-{nom}",name="reserverRestaurant")
     */
    public function  restaurantAction($nom,Request $request){
        $em= $this->getDoctrine()->getEntityManager();

        $restaurant=$em->getRepository("AppBundle:Restaurant")
            ->findOneBy(['nom'=>$nom]);


           return $this->render('@App/Reservation/restaurant.html.twig',['rest'=>$restaurant]);
    }

    /**
     * @Route("/Reservation/{id}",name="ReserverRestaurant")
     * @param $id
     */
    public function reserverRestaurantAction($id){
        return "lol";
    }
}
