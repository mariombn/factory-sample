<?php

namespace Service;

/**
 * Class DispositivoServiceFactory
 * @package Service
 */
class ProdutoServiceFactory
{
    public static function create()
    {
        /** @var \Entity\ProdutoEntity $produtoEntity */
        $produtoEntity = new \Entity\ProdutoEntity();

        /** @var \Repository\ProdutoRepository $produtoRepository */
        $produtoRepository = \Repository\ProdutoRepositoryFactory::create();

        /** @var \Entity\ProdutoCategoriaEntity $produtoCategoriaEntity */
        $produtoCategoriaEntity = new \Entity\ProdutoCategoriaEntity();

        /** @var \Repository\ProdutoCategoriaRepositoryFactory $produtoCategoriaRepository */
        $produtoCategoriaRepository = \Repository\ProdutoCategoriaRepositoryFactory::create();

        return new ProdutoService(
            $produtoEntity,
            $produtoRepository,
            $produtoCategoriaEntity,
            $produtoCategoriaRepository
        );
    }
}