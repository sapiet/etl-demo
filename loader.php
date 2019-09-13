<?php

class Loader implements \BenTools\ETL\Loader\LoaderInterface
{
    /**
     * @var PDO
     */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function init(): void
    {
    }

    public function load(\Generator $items, $key, \BenTools\ETL\Etl $etl): void
    {
        foreach ($items as $query) {
            list($query, $queryParameters) = $query;
            $statement = $this->pdo->prepare($query);
            $statement->execute($queryParameters);
        }
    }

    public function commit(bool $partial): void
    {
    }

    public function rollback(): void
    {
    }

}
