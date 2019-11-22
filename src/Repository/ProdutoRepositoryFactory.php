<?php

namespace Repository;

/**
 * Class DispositivoRepositoryFactory
 * @package Repository
 */
class ProdutoRepositoryFactory
{
    public static function create()
    {
        /** @var \Entity\ProdutoEntity $produtoEntity */
        $produtoEntity = new \Entity\ProdutoEntity();

        return new ProdutoRepository($produtoEntity);
    }
}