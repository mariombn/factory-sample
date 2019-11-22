<?php

namespace Entity;

/**
 * Class ProdutoCategoriaEntity
 * @package Entity
 */
class ProdutoCategoriaEntity
{
    /** @var int */
    private $id;

    /** @var int */
    private $produtoId;

    /** @var int */
    private $categoriaId;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return ProdutoCategoriaEntity
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getProdutoId()
    {
        return $this->produtoId;
    }

    /**
     * @param int $produtoId
     * @return ProdutoCategoriaEntity
     */
    public function setProdutoId($produtoId)
    {
        $this->produtoId = $produtoId;
        return $this;
    }

    /**
     * @return int
     */
    public function getCategoriaId()
    {
        return $this->categoriaId;
    }

    /**
     * @param int $categoriaId
     * @return ProdutoCategoriaEntity
     */
    public function setCategoriaId($categoriaId)
    {
        $this->categoriaId = $categoriaId;
        return $this;
    }
}