<?php

namespace Service;

/**
 * Interface CategoriaServiceInterface
 * @package Service
 */
interface CategoriaServiceInterface
{
    /**
     * @param $nome
     * @return mixed
     */
    public function incluir($nome);

    /**
     * Retorna endidade de acordo com o Id informado
     * @param $id
     * @return \Entity\CategoriaEntity
     */
    public function obterPorId($id);

    /**
     * Exclui uma categoria
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
     * @return \Entity\CategoriaEntity
     */
    public function alterar($id, $nome);

    /**
     * Retorna endidade de acordo com o nome informado
     * @param string $nome
     * @return \Entity\CategoriaEntity
     */
    public function obterPorNome($nome);
}