<?php

namespace Service;

/**
 * Class DispositivoServiceFactory
 * @package Service
 */
class CategoriaServiceFactory
{
    public static function create()
    {
        /** @var \Entity\CategoriaEntity $categoriaEntity */
        $categoriaEntity = new \Entity\CategoriaEntity();

        /** @var \Repository\CategoriaRepository $categoriaRepository */
        $categoriaRepository = \Repository\CategoriaRepositoryFactory::create();

        return new CategoriaService($categoriaEntity, $categoriaRepository);
    }
}