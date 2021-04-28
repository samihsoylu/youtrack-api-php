<?php declare(strict_types=1);

namespace YouTrackAPI\Repository;

use YouTrackAPI\HttpClient\HttpClient;
use YouTrackAPI\HttpClient\HttpClientInterface;

abstract class AbstractRepository
{
    protected HttpClient $api;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->api = $httpClient;
    }

    protected function generateGetRequestParams(array $fields): string
    {
        $parsedFields = $this->parseFields($fields);

        return ($parsedFields !== '') ? "?fields={$parsedFields}" : '';
    }

    private function parseFields(array $fields)
    {
        $string = '';
        foreach ($fields as $key => $value) {
            if (is_string($key)) {
                $string .= "{$key}({$this->parseFields($value)}),";
                continue;
            }

            end($fields);
            if ($key === key($fields)) {
                $string .= $value;
                continue;
            }

            $string .= "{$value},";
        }

        return rtrim($string, ',');
    }
}
