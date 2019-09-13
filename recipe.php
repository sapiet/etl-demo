<?php

class recipe extends \BenTools\ETL\Recipe\Recipe
{
    /**
     * @var PDO
     */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function updateBuilder(\BenTools\ETL\EtlBuilder $builder): \BenTools\ETL\EtlBuilder
    {
        return $builder
            ->extractFrom(new Extractor())
            ->transformWith(new Transformer($this->pdo))
            ->loadInto(new Loader($this->pdo));
    }
}
