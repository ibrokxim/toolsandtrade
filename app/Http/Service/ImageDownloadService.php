<?php

namespace App\Http\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\FileCookieJar;

class ImageDownloadService
{
    protected $cookieJar;
    protected $client;

    public function __construct()
    {
        $this->cookieJar = new FileCookieJar(storage_path('app/cookies.txt'), true);
        $this->client = new Client(['cookies' => true]);
    }

    public function login($loginUrl, $postData)
    {
        $response = $this->client->post($loginUrl, [
            'form_params' => $postData,
            'cookies' => $this->cookieJar,
        ]);

        $this->cookieJar->save(storage_path('app/cookies.txt'));
    }

    public function downloadImage($url)
    {
        $response = $this->client->get($url, [
            'cookies' => $this->cookieJar,
        ]);

        if ($response->getStatusCode() == 200) {
            return $response->getBody()->getContents();
        }

        return null;
    }
}
