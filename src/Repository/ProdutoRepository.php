<?php

namespace Repository;

use Entity\ProdutoEntity;
use Service\DataBaseService;

/**
 * Class ProdutoRepository
 * @package Repository
 */
class ProdutoRepository implements ProdutoRepositoryInterface
{
    /** @var \Entity\ProdutoEntity */
    private $produtoEntity;

    public function __construct(
        ProdutoEntity $produtoEntity
    ) {
        $this->produtoEntity = $produtoEntity;
    }

    /**
     * Insere a Entidade Dispositivo no Banco de Dados
     * @param \Entity\ProdutoEntity $entity
     * @return \Entity\ProdutoEntity
     */
    public function incluir(ProdutoEntity $entity)
    {


        /** @var \PDO $conexao */
        $conexao = DataBaseService::obterConexao();
        $sql = "INSERT INTO `produtos` (`nome`, `sku`, `preco`, `descricao`, `quantidade`)
                VALUES (:nome, :sku, :preco, :descricao, :quantidade)";
        $prepare = $conexao->prepare($sql);
        $prepare->bindValue(':nome', $entity->getNome());
        $prepare->bindValue(':sku', $entity->getSku());
        $prepare->bindValue(':preco', $entity->getPreco());
        $prepare->bindValue(':descricao', $entity->getDescricao());
        $prepare->bindValue(':quantidade', $entity->getQuantidade());

        if (!$prepare->execute()) {
            throw new \PDOException('Erro ao incerir dados no Banco de Dados');
        }
        $entity->setId($conexao->lastInsertId());
        return $entity;
    }

    /**
     * Altera um registro de dispositivo
     * @param \Entity\ProdutoEntity $entity
     * @return \Entity\ProdutoEntity
     */
    public function alterar(ProdutoEntity $entity)
    {
        $conexao = DataBaseService::obterConexao();
        $sql = "UPDATE `produtos` SET `nome` = :nome, `sku` = :sku, `preco` = :preco, `descricao` = :descricao, `quantidade` = :quantidade WHERE `id` = :id";
        $prepare = $conexao->prepare($sql);
        $prepare->bindValue(':id', $entity->getId());
        $prepare->bindValue(':nome', $entity->getNome());
        $prepare->bindValue(':sku', $entity->getSku());
        $prepare->bindValue(':preco', $entity->getPreco());
        $prepare->bindValue(':descricao', $entity->getDescricao());
        $prepare->bindValue(':quantidade', $entity->getQuantidade());

        if (!$prepare->execute()) {
            throw new \PDOException('Erro ao alterar registro no Banco de Dados');
        }
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
        $sql = "DELETE FROM `produtos` WHERE `id` = :id";
        $prepare = $conexao->prepare($sql);
        $prepare->bindValue(':id', $id);
        if (!$prepare->execute()) {
            throw new \PDOException('Erro ao Excluir registro do Banco de Dados');
        }
        return true;
    }

    /**
     * Retorna uma Entidade de Dispositivo
     * @param $id
     * @return \Entity\ProdutoEntity
     */
    public function obterPorId($id)
    {
        $conexao = DataBaseService::obterConexao();
        $query = "SELECT `id`, `nome`, `sku`, `preco`, `descricao`, `quantidade` FROM `produtos` WHERE `id` = :id";
        $prepare = $conexao->prepare($query);
        $prepare->bindValue(':id', $id);
        if (!$prepare->execute()) {
            throw new \PDOException('Erro ao obter Registro do Banco de Dados');
        }

        $row = $prepare->fetch(\PDO::FETCH_ASSOC);

        $entity = clone $this->produtoEntity;
        $entity->setId($row['id']);
        $entity->setNome($row['nome']);
        $entity->setSku($row['sku']);
        $entity->setPreco($row['preco']);
        $entity->setDescricao($row['descricao']);
        $entity->setQuantidade($row['quantidade']);

        return $entity;
    }

    /**
     * Retorna um array com entidades de Dispositivos
     * @return array
     */
    public function listar()
    {
        $conexao = DataBaseService::obterConexao();
        $query = "SELECT `id`, `nome`, `sku`, `preco`, `descricao`, `quantidade` FROM `produtos` ORDER BY `id`";
        $prepare = $conexao->prepare($query);
        if (!$prepare->execute()) {
            throw new \PDOException('Erro ao obter registros do Banco de Dados');
        }

        $row = $prepare->fetch(\PDO::FETCH_ASSOC);

        $retorno = [];

        while ($row) {
            $entity = clone $this->produtoEntity;
            $entity->setId($row['id']);
            $entity->setNome($row['nome']);
            $entity->setSku($row['sku']);
            $entity->setPreco($row['preco']);
            $entity->setDescricao($row['descricao']);
            $entity->setQuantidade($row['quantidade']);
            $retorno[] = $entity;
            $row = $prepare->fetch(\PDO::FETCH_ASSOC);
        }
        return $retorno;
    }
}