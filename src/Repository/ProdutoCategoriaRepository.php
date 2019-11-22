<?php

namespace Repository;

use Entity\ProdutoCategoriaEntity;
use Entity\ProdutoEntity;
use Service\DataBaseService;

/**
 * Class ProdutoCategoriaRepository
 * @package Repository
 */
class ProdutoCategoriaRepository implements ProdutoCategoriaRepositoryInterface
{
    /** @var \Entity\ProdutoCategoriaEntity */
    private $produtoCategoriaEntity;

    public function __construct(
        ProdutoCategoriaEntity $produtoCategoriaEntity
    ) {
        $this->produtoCategoriaEntity = $produtoCategoriaEntity;
    }

    /**
     * Insere a Entidade Dispositivo no Banco de Dados
     * @param \Entity\CategoriaEntity $entity
     * @return \Entity\CategoriaEntity
     */
    public function incluir(ProdutoCategoriaEntity $entity)
    {
        /** @var \PDO $conexao */
        $conexao = DataBaseService::obterConexao();
        $sql = "INSERT INTO `produto_categoria` (`produto_id`, `categoria_id`) VALUES (:produto_id, :categoria_id)";
        $prepare = $conexao->prepare($sql);
        $prepare->bindValue(':produto_id', $entity->getProdutoId());
        $prepare->bindValue(':categoria_id', $entity->getCategoriaId());

        if (!$prepare->execute()) {
            throw new \PDOException('Erro ao incerir dados no Banco de Dados');
        }
        $entity->setId($conexao->lastInsertId());
        return $entity;
    }

    /**
     * Exclui um registro de Dispositivo
     * @param $id
     * @return bool
     */
    public function excluir ($id)
    {
        $conexao = DataBaseService::obterConexao();
        $sql = "DELETE FROM `produto_categoria` WHERE `id` = :id";
        $prepare = $conexao->prepare($sql);
        $prepare->bindValue(':id', $id);
        if (!$prepare->execute()) {
            throw new \PDOException('Erro ao Excluir registro do Banco de Dados');
        }
        return true;
    }

    public function excluirByProduto($produtoId)
    {
        $conexao = DataBaseService::obterConexao();
        $sql = "DELETE FROM `produto_categoria` WHERE `produto_id` = :id";
        $prepare = $conexao->prepare($sql);
        $prepare->bindValue(':id', $produtoId);
        if (!$prepare->execute()) {
            throw new \PDOException('Erro ao Excluir registro do Banco de Dados');
        }
        return true;
    }

    /**
     * Retorna uma Entidade de Dispositivo
     * @param $id
     * @return \Entity\ProdutoCategoriaEntity
     */
    public function obterPorId($id)
    {
        $conexao = DataBaseService::obterConexao();
        $query = "SELECT `id`, `produto_id`, `categoria_id` FROM `produto_categoria` WHERE `id` = :id";
        $prepare = $conexao->prepare($query);
        $prepare->bindValue(':id', $id);
        if (!$prepare->execute()) {
            throw new \PDOException('Erro ao obter Registro do Banco de Dados');
        }

        $row = $prepare->fetch(\PDO::FETCH_ASSOC);

        $entity = clone $this->produtoCategoriaEntity;
        $entity->setId($row['id']);
        $entity->setProdutoId($row['produto_id']);
        $entity->setCategoriaId($row['categoria_id']);
        return $entity;
    }

    /**
     * Retorna um array com entidades de Dispositivos
     * @return array
     */
    public function listar()
    {
        $conexao = DataBaseService::obterConexao();
        $query = "SELECT `id`, `produto_id`, `categoria_id` FROM `produto_categoria` ORDER BY `id`";
        $prepare = $conexao->prepare($query);
        if (!$prepare->execute()) {
            throw new \PDOException('Erro ao obter registros do Banco de Dados');
        }

        $row = $prepare->fetch(\PDO::FETCH_ASSOC);

        $retorno = [];

        while ($row) {
            $entity = clone $this->produtoCategoriaEntity;
            $entity->setId($row['id']);
            $entity->setProdutoId($row['produto_id']);
            $entity->setCategoriaId($row['categoria_id']);
            $retorno[] = $entity;
            $row = $prepare->fetch(\PDO::FETCH_ASSOC);
        }
        return $retorno;
    }
}