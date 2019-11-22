<?php
namespace Service;

use Entity\CategoriaEntity;
use Repository\CategoriaRepository;

/**
 * Class CategoriaService
 * @package Service
 */
class CategoriaService implements CategoriaServiceInterface
{
    private $categoriaEntity;

    private $categoriaRepository;

    public function __construct(
        CategoriaEntity $categoriaEntity,
        CategoriaRepository $categoriaRepository

    ) {
        $this->categoriaEntity = $categoriaEntity;
        $this->categoriaRepository = $categoriaRepository;
    }

    public function incluir($nome)
    {
        if (empty($nome)) {
            throw new \Exception("Parametros Invalidos");
        }
        $categoriaEntity = clone $this->categoriaEntity;
        $categoriaEntity->setNome($nome);
        $categoriaEntity = $this->categoriaRepository->incluir($categoriaEntity);
        return $categoriaEntity;
    }

    public function obterPorId($id)
    {
        return $this->categoriaRepository->obterPorId($id);
    }

    public function excluir($id)
    {
        return $this->categoriaRepository->excluir($id);
    }

    public function listar()
    {
        return $this->categoriaRepository->listar();
    }

    public function alterar($id, $nome)
    {
        if (empty($id) || empty($nome)) {
            throw new \Exception("Parametros Invalidos");
        }

        $categoriaEntity = clone $this->categoriaEntity;
        $categoriaEntity->setId($id);
        $categoriaEntity->setNome($nome);
        return $this->categoriaRepository->alterar($categoriaEntity);
    }

    /**
     * Retorna endidade de acordo com o nome informado
     * @param string $nome
     * @return \Entity\CategoriaEntity
     */
    public function obterPorNome($nome)
    {
        if (empty($nome)) {
            throw new \Exception("Parametros Invalidos");
        }

        return $this->categoriaRepository->obterPorNome($nome);
    }
}