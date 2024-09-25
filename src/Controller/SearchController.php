<?php

namespace App\Controller;

use App\Service\AuthSpotifyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class SearchController extends AbstractController
{
    private string $token;

    public function __construct(
        private readonly AuthSpotifyService $authSpotifyService,
        private readonly HttpClientInterface $httpClient
    ) {
        $this->token = $this->authSpotifyService->auth();
    }
    #[Route('/track-details/{id}', name: 'track_details')]
    public function trackDetails(string $id): Response
    {
        $response = $this->httpClient->request('GET', "https://api.spotify.com/v1/tracks/{$id}", [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
            ],
        ]);
    
        $trackDetails = $response->toArray();
    
        return $this->render('track/details.html.twig', [
            'track' => $trackDetails,
        ]);
    }
    
    #[Route('/search', name: 'app_search_index')]
    public function index(Request $request): Response
    {
        $tracks = [];
        $title = '';

        if ($request->isMethod('POST')) {
            $title = $request->request->get('title');
            $response = $this->httpClient->request('GET', 'https://api.spotify.com/v1/search', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                ],
                'query' => [
                    'q' => $title,
                    'type' => 'track',
                    'limit' => 20  
                ],
            ]);
            

            $tracks = $response->toArray()['tracks']['items'];
            //dd($response->toArray());
        }

        return $this->render('search/index.html.twig', [
            'tracks' => $tracks,
            'title' => $title
        ]);
    }

}
