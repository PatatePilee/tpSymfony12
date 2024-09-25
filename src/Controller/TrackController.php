<?php

namespace App\Controller;

use App\Service\AuthSpotifyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class TrackController extends AbstractController
{
    private string $token;

    public function __construct(
        private readonly AuthSpotifyService  $authSpotifyService,
        private readonly HttpClientInterface $httpClient
    ) {
        $this->token = $this->authSpotifyService->auth();
    }

    #[Route('/track', name: 'app_track_index')]
    public function index(): Response
    {
        // Requête initiale pour récupérer les morceaux
        $response = $this->httpClient->request('GET', 'https://api.spotify.com/v1/search?query=kazzey&type=track&locale=fr-FR', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
            ],
        ]);

        $tracks = $response->toArray()['tracks']['items'];

        return $this->render('track/index.html.twig', [
            'tracks' => $tracks, 
        ]);
    }
    #[Route('/track-details/{id}', name: 'track_details')]
    public function trackDetails(string $id): Response
    {
        $response = $this->httpClient->request('GET', "https://api.spotify.com/v1/tracks/{$id}", [
            'headers' => ['Authorization' => 'Bearer ' . $this->token],
        ]);
        $trackDetails = $response->toArray();

        $seedArtists = $trackDetails['artists'][0]['id']; 
        $recommendationsResponse = $this->httpClient->request('GET', 'https://api.spotify.com/v1/recommendations', [
            'headers' => ['Authorization' => 'Bearer ' . $this->token],
            'query' => [
                'seed_artists' => $seedArtists,
                'limit' => 10 
            ],
        ]);
        $recommendations = $recommendationsResponse->toArray()['tracks'];

        return $this->render('track/details.html.twig', [
            'track' => $trackDetails,
            'recommendations' => $recommendations,
        ]);
    }


    
    
}
