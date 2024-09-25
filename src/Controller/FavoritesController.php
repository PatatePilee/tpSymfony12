<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FavoritesController extends AbstractController
{
    /**
     * @Route("/favorites", name="favorites_index")
     */
    #[Route('/favorites', name: 'favorites_index')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        $favorites = $session->get('favorites', []);
        return $this->render('favorites/index.html.twig', [
            'favorites' => $favorites,
        ]);
    }

    /**
     * @Route("/add-to-favorites/{id}", name="add_to_favorites")
     */
    public function addToFavorites(Request $request, string $id): Response
    {
        $session = $request->getSession();
        $favorites = $session->get('favorites', []);
        if (!in_array($id, $favorites)) {
            $favorites[] = $id;
            $session->set('favorites', $favorites);
        }

        return $this->redirectToRoute('favorites_index');
    }
    /**
     * @Route("/remove-from-favorites/{id}", name="remove_from_favorites")
     */
    public function removeFromFavorites(Request $request, string $id): Response
    {
        $session = $request->getSession();
        $favorites = $session->get('favorites', []);
        if (($key = array_search($id, $favorites)) !== false) {
            unset($favorites[$key]);
            $session->set('favorites', array_values($favorites));
        }

        return $this->redirectToRoute('favorites_index');
    }
}
