<?php

class Transformer implements \BenTools\ETL\Transformer\TransformerInterface
{
    /**
     * @var PDO
     */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function transform($value, $key, \BenTools\ETL\Etl $etl): \Generator
    {
        $statement = $this->pdo->prepare('SELECT COUNT(id) FROM user WHERE id = :id');
        $statement->execute(['id' => $value['id']]);
        $count = (int) $statement->fetchColumn();
        $query = '%s INTO user (id, name, email) VALUES (:id, :name, :email)';
        $queryParameters = [
            'id' => $value['id'],
            'name' => $value['name'],
            'email' => $value['email'],
        ];

        yield [sprintf($query, 0 === $count ? 'INSERT' : 'REPLACE'), $queryParameters];
    }
}
