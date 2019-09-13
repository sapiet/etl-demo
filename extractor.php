<?php

use Symfony\Component\HttpClient\HttpClient;

class Extractor implements \BenTools\ETL\Extractor\ExtractorInterface
{
    public function extract($input, \BenTools\ETL\Etl $etl): iterable
    {
        $client = HttpClient::create();
        $response = $client->request('GET', $input);
        return $response->toArray();
    }

}
