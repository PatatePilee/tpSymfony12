<?php
// src/Controller/SongController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Routing\Annotation\Route;

class SongController extends AbstractController
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    #[Route('/song', name: 'song_list')]
    public function index(): Response
    {
        $accessToken = 'BQApHuCuCNSbi3hu0bcMaKTgxQCtb1G2sopksVa0yUOMtW0m_l_Flu3GgpsPFXZ_pDspabVln9Uzqw0iDmPr24bFmSKylzYD3IRQC8WoMK0Ybz118v0';

        $url = 'https://api.spotify.com/v1/playlists/37i9dQZEVXbIPWwFssbupI?si=df6a34b8edf44353';

        $response = $this->client->request('GET', $url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
            ],
        ]);

        $playlistData = $response->toArray();

        return $this->render('song/index.html.twig', [
            'playlist' => $playlistData,
        ]);
    }
}
