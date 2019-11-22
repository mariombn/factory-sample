<?php

namespace Repository;

use Entity\ProdutoCategoriaEntity;

/**
 * Interface CategoriaRepositoryInterface
 * @package Repository
 */
interface ProdutoCategoriaRepositoryInterface
{
    /**
     * Insere a Entidade Categoria no Banco de Dados
     * @param \Entity\ProdutoCategoriaEntity $entity
     * @return \Entity\ProdutoCategoriaEntity
     */
    public function incluir (ProdutoCategoriaEntity $entity);

    /**
     * Exclui um registro de Categoria
     * @param $id
     * @return bool
     */
    public function excluir ($id);

    /**
     * Retorna uma Entidade de Categoria
     * @param $id
     * @return \Entity\CategoriaEntity
     */
    public function obterPorId($id);

    /**
     * Retorna um array com entidades de Categorias
     * @return array
     */
    public function listar();
}