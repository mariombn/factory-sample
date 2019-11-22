<?php

namespace Repository;

use Entity\CategoriaEntity;
use Entity\ProdutoEntity;

/**
 * Interface CategoriaRepositoryInterface
 * @package Repository
 */
interface CategoriaRepositoryInterface
{
    /**
     * Insere a Entidade Categoria no Banco de Dados
     * @param \Entity\CategoriaEntity $entity
     * @return \Entity\CategoriaEntity
     */
    public function incluir (CategoriaEntity $entity);

    /**
     * Altera um registro de Categoria
     * @param \Entity\CategoriaEntity $entity
     * @return \Entity\CategoriaEntity
     */
    public function alterar (CategoriaEntity $entity);

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
     * Retorna todas as categorias de um Determinado Produto
     * @param ProdutoEntity $produtoEntity
     * @return array
     */
    public function obterPorProduto(ProdutoEntity $produtoEntity);

    /**
     * Retorna um array com entidades de Categorias
     * @return array
     */
    public function listar();

    /**
     * Retorna endidade de acordo com o nome informado
     * @param string $nome
     * @return \Entity\CategoriaEntity
     */
    public function obterPorNome($nome);
}