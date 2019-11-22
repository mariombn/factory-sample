<?php

namespace Service;

/**
 * Interface ProdutoServiceInterface
 * @package Service
 */
interface ProdutoServiceInterface
{
    /**
     * @param $nome
     * @return mixed
     */
    public function incluir($nome, $sku, $preco, $descricao, $quantidade, $categorias);

    /**
     * Retorna endidade de acordo com o Id informado
     * @param $id
     * @return \Entity\ProdutoEntity
     */
    public function obterPorId($id);

    /**
     * Exclui uma produto
     * @param $id
     * @return bool
     */
    public function excluir($id);

    /**
     * Lista todos as categorais cadastrados
     * @return array
     */
    public function listar();

    /**
     * @param $id
     * @param $nome
     * @throws \Exception
     * @return \Entity\ProdutoEntity
     */
    public function alterar($id, $nome, $sku, $preco, $descricao, $quantidade, $categorias);
}