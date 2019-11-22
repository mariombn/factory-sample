<?php

namespace Repository;

/**
 * Class DispositivoRepositoryFactory
 * @package Repository
 */
class CategoriaRepositoryFactory
{
    public static function create()
    {
        /** @var \Entity\CategoriaEntity $categoriaEntity */
        $categoriaEntity = new \Entity\CategoriaEntity();

        return new CategoriaRepository($categoriaEntity);
    }
}