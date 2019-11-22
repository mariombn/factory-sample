<?php

namespace Entity;

/**
 * Class CategoriaEntity
 * @package Entity
 */
class CategoriaEntity
{
    /** @var int */
    private $id;

    /** @var string */
    private $nome;

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
}