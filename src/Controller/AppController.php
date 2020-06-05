<?php

namespace App\Controller;

use App\Entity\Restaurant;
use App\Entity\Review;
use App\Repository\RestaurantRepository;
use App\Repository\ReviewRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController{

    /**
     * @Route("/", name="app_index", methods={"GET"})
     */

    public function index(RestaurantRepository $restaurantRepository) {
      
         /**
     * On récupère les données de notre nouvelle méthode
     */
    $tenBestRestaurantsId = $this->getDoctrine()->getRepository(Review::class)->findBestTenRatings();

    $tenBestRestaurants = array_map(function($data) {
        return $this->getDoctrine()->getRepository(Restaurant::class)->find($data['restaurantId']);
    }, $tenBestRestaurantsId);

    /**
     * On prépare le futur array d'objets Restaurant
     */
    $tenBestRestaurants = [];

    /**
     * On boucle sur le tableau de données retourné par le ReviewRepository
     */
    foreach($tenBestRestaurantsId as $data) {
        // Pour chaque élément on prend le `restaurantId` et on cherche l'objet Restaurant grace au RestaurantRepository :
        $tenBestRestaurants[] = $this->getDoctrine()->getRepository(Restaurant::class)->find($data['restaurantId']);
    }

    return $this->render('app/index.html.twig', [
        // Cette fois, on envoie à Twig notre nouveau tableau
        'restaurants' => $tenBestRestaurants,
    ]);

    }

    /**
    * @Route("/search", name="app_search", methods={"GET"})
    * @param Request $request
    */
    public function search(Request $request) {

}


    /* public function index(RestaurantRepository $restaurantRepository) {
        
        return $this->render('app/index.html.twig', [
            'restaurants' => $restaurantRepository->findLastTenElements()
        ]);

    } */
}

?>