<?php

namespace Repository;

use Entity\ProdutoEntity;

/**
 * Interface ProdutoRepositoryInterface
 * @package Repository
 */
interface ProdutoRepositoryInterface
{
    /**
     * Insere a Entidade Produto no Banco de Dados
     * @param \Entity\ProdutoEntity $entity
     * @return \Entity\ProdutoEntity
     */
    public function incluir (ProdutoEntity $entity);

    /**
     * Altera um registro de Produto
     * @param \Entity\ProdutoEntity $entity
     * @return \Entity\ProdutoEntity
     */
    public function alterar (ProdutoEntity $entity);

    /**
     * Exclui um registro de Produto
     * @param $id
     * @return bool
     */
    public function excluir ($id);

    /**
     * Retorna uma Entidade de Produto
     * @param $id
     * @return \Entity\ProdutoEntity
     */
    public function obterPorId($id);

    /**
     * Retorna um array com entidades de Produto
     * @return array
     */
    public function listar();
}