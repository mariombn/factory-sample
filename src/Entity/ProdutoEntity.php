<?php

namespace Entity;

use Repository\CategoriaRepository;
use Repository\CategoriaRepositoryFactory;

/**
 * Class ProdutoEntity
 * @package Entity
 */
class ProdutoEntity
{
    /** @var int */
    private $id;

    /** @var string */
    private $nome;

    /** @var string */
    private $sku;

    /** @var double */
    private $preco;

    /** @var string */
    private $descricao;

    /** @var int */
    private $quantidade;

    /** @var array  */
    private $categorias = [];

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return CategoriaEntity
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     * @return CategoriaEntity
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     * @return CategoriaEntity
     */
    public function setSku($sku)
    {
        $this->sku = $sku;
        return $this;
    }

    /**
     * @return float
     */
    public function getPreco()
    {
        return $this->preco;
    }

    /**
     * @param float $preco
     * @return CategoriaEntity
     */
    public function setPreco($preco)
    {
        $this->preco = $preco;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param string $descricao
     * @return CategoriaEntity
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantidade()
    {
        return $this->quantidade;
    }

    /**
     * @param int $quantidade
     * @return CategoriaEntity
     */
    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
        return $this;
    }

    /**
     * Lazy Load
     * @return array
     */
    public function getCategorias()
    {
        if (empty($this->id)) {
            return [];
        }
        /** @var CategoriaRepository $categoriaRepository */
        $categoriaRepository = CategoriaRepositoryFactory::create();
        return $categoriaRepository->obterPorProduto($this);
    }

    /**
     * @param CategoriaEntity $categorias
     * @return $this
     */
    public function addCategorias(CategoriaEntity $categorias)
    {
        $this->categorias[] = $categorias;
        return $this;
    }


}