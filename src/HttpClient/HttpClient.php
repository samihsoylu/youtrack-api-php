<?php

namespace YouTrackAPI\HttpClient;

use YouTrackAPI\Exception\ApiException;
use \GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Exception\BadResponseException;

class HttpClient implements HttpClientInterface
{
    private GuzzleHttpClient $guzzleHttpClient;

    private string $endpoint;
    private string $prefix;

    public function __construct(string $url, string $token)
    {
        $config = [
            //'debug' => true,
            'decode_content' => false,
            'cookies' => new CookieJar(),
            'headers' => [
                'Content-Type'  => 'application/json',
                'Authorization' => "Bearer {$token}",
                'Cache-Control' => 'no-cache',
                'User-Agent'    => 'api',
            ],
        ];

        $this->guzzleHttpClient = new GuzzleHttpClient($config);
        $this->endpoint = rtrim($url, '/');

        // Use the new prefix by default
        $this->setPrefixNewRest();
    }

    public function setPrefixNewRest(): void
    {
        $this->prefix = '/api';
    }

    public function setPrefixOldRest(): void
    {
        $this->prefix = '/rest';
    }

    private function request(string $method, string $uri, array $options = [], bool $expectResponse = true): array
    {
        try {
            $response = $this->guzzleHttpClient->request($method, "{$this->endpoint}{$this->prefix}{$uri}", $options);
        } catch (BadResponseException $e) {
            throw ApiException::unexpectedStatusCode($e->getResponse());
        }

        if (!$expectResponse) {
            return [];
        }

        if ($response->getBody() === null) {
            throw ApiException::emptyResponse($response);
        }

        $responseBody = json_decode($response->getBody(), true);
        if ($responseBody === null) {
            throw ApiException::malformedJsonResponse($response);
        }

        return $responseBody;
    }

    public function get(string $uri): array
    {
        return $this->request('GET', $uri);
    }

    public function post(string $uri, array $body = [], bool $getResponse = true): array
    {
        $options['body'] = json_encode($body, JSON_THROW_ON_ERROR);

        return $this->request('POST', $uri, $options, $getResponse);
    }

    public function put(string $uri, array $body = []): array
    {
        $options['body'] = json_encode($body, JSON_THROW_ON_ERROR);

        return $this->request('PUT', $uri, $options);
    }

    public function delete(string $uri, array $body = []): void
    {
        $options['body'] = json_encode($body, JSON_THROW_ON_ERROR);

        $this->request('DELETE', $uri, $options, false);
    }
}
