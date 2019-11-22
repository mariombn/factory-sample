<?php

namespace Repository;

/**
 * Class ProdutoCategoriaRepositoryFactory
 * @package Repository
 */
class ProdutoCategoriaRepositoryFactory
{
    public static function create()
    {
        /** @var \Entity\ProdutoCategoriaEntity $produtoCategoriaEntity */
        $produtoCategoriaEntity = new \Entity\ProdutoCategoriaEntity();

        return new ProdutoCategoriaRepository($produtoCategoriaEntity);
    }
}