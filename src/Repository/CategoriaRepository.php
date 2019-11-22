<?php

namespace Repository;

use Entity\CategoriaEntity;
use Entity\ProdutoEntity;
use Service\DataBaseService;

/**
 * Class CategoriaRepository
 * @package Repository
 */
class CategoriaRepository implements CategoriaRepositoryInterface
{
    /** @var \Entity\CategoriaEntity */
    private $categoriaEntity;

    public function __construct(
        CategoriaEntity $categoriaEntity
    ) {
        $this->categoriaEntity = $categoriaEntity;
    }

    /**
     * Insere a Entidade Dispositivo no Banco de Dados
     * @param \Entity\CategoriaEntity $entity
     * @return \Entity\CategoriaEntity
     */
    public function incluir(CategoriaEntity $entity)
    {
        /** @var \PDO $conexao */
        $conexao = DataBaseService::obterConexao();
        $sql = "INSERT INTO `categorias` (`nome`) VALUES (:nome)";
        $prepare = $conexao->prepare($sql);
        $prepare->bindValue(':nome', $entity->getNome());

        if (!$prepare->execute()) {
            throw new \PDOException('Erro ao incerir dados no Banco de Dados');
        }
        $entity->setId($conexao->lastInsertId());
        return $entity;
    }

    /**
     * Altera um registro de dispositivo
     * @param \Entity\CategoriaEntity $entity
     * @return \Entity\CategoriaEntity
     */
    public function alterar(CategoriaEntity $entity)
    {
        $conexao = DataBaseService::obterConexao();
        $sql = "UPDATE `categorias` SET `nome` = :nome WHERE `id` = :id";
        $prepare = $conexao->prepare($sql);
        $prepare->bindValue(':id', $entity->getId());
        $prepare->bindValue(':nome', $entity->getNome());

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
        $sql = "DELETE FROM `categorias` WHERE `id` = :id";
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
     * @return \Entity\CategoriaEntity
     */
    public function obterPorId($id)
    {
        $conexao = DataBaseService::obterConexao();
        $query = "SELECT `id`, `nome` FROM `categorias` WHERE `id` = :id";
        $prepare = $conexao->prepare($query);
        $prepare->bindValue(':id', $id);
        if (!$prepare->execute()) {
            throw new \PDOException('Erro ao obter Registro do Banco de Dados');
        }

        $row = $prepare->fetch(\PDO::FETCH_ASSOC);

        $entity = clone $this->categoriaEntity;
        $entity->setId($row['id']);
        $entity->setNome($row['nome']);
        return $entity;
    }

    /**
     * Retorna um array com entidades de Dispositivos
     * @return array
     */
    public function listar()
    {
        $conexao = DataBaseService::obterConexao();
        $query = "SELECT `id`, `nome` FROM `categorias` ORDER BY `id`";
        $prepare = $conexao->prepare($query);
        if (!$prepare->execute()) {
            throw new \PDOException('Erro ao obter registros do Banco de Dados');
        }

        $row = $prepare->fetch(\PDO::FETCH_ASSOC);

        $retorno = [];

        while ($row) {
            $entity = clone $this->categoriaEntity;
            $entity->setId($row['id']);
            $entity->setNome($row['nome']);
            $retorno[] = $entity;
            $row = $prepare->fetch(\PDO::FETCH_ASSOC);
        }
        return $retorno;
    }

    /**
     * Retorna todas as categorias de um Determinado Produto
     * @param ProdutoEntity $produtoEntity
     * @return array
     */
    public function obterPorProduto(ProdutoEntity $produtoEntity)
    {
        $conexao = DataBaseService::obterConexao();
        $query = "SELECT `categorias`.`id`, `categorias`.`nome`
                    FROM `categorias`
                    INNER JOIN `produto_categoria` ON `produto_categoria`.`categoria_id` = `categorias`.`id`
                    WHERE `produto_categoria`.`produto_id` = :produto_id
                    ORDER BY `categorias`.`id`";
        $prepare = $conexao->prepare($query);
        $prepare->bindValue(':produto_id', $produtoEntity->getId());
        if (!$prepare->execute()) {
            throw new \PDOException('Erro ao obter registros do Banco de Dados');
        }

        $row = $prepare->fetch(\PDO::FETCH_ASSOC);

        $retorno = [];

        while ($row) {
            $entity = clone $this->categoriaEntity;
            $entity->setId($row['id']);
            $entity->setNome($row['nome']);
            $retorno[] = $entity;
            $row = $prepare->fetch(\PDO::FETCH_ASSOC);
        }
        return $retorno;
    }

    /**
     * Retorna endidade de acordo com o nome informado
     * @param string $nome
     * @return \Entity\CategoriaEntity
     */
    public function obterPorNome($nome)
    {
        $conexao = DataBaseService::obterConexao();
        $query = "SELECT `categorias`.`id`, `categorias`.`nome`
                    FROM `categorias`
                    WHERE `categorias`.`nome` = :nome
                    ORDER BY `categorias`.`id`";
        $prepare = $conexao->prepare($query);
        $prepare->bindValue(':nome', $nome);
        if (!$prepare->execute()) {
            throw new \PDOException('Erro ao obter registros do Banco de Dados');
        }

        $row = $prepare->fetch(\PDO::FETCH_ASSOC);

        if (!$row) {
            throw new \Exception("Nenhuma categoria encontrada");
        }

        $entity = clone $this->categoriaEntity;
        $entity->setId($row['id']);
        $entity->setNome($row['nome']);
        return $entity;
    }
}