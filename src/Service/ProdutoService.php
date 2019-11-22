<?php
namespace Service;

use Entity\ProdutoCategoriaEntity;
use Entity\ProdutoEntity;
use mysql_xdevapi\Exception;
use Repository\ProdutoCategoriaRepository;
use Repository\ProdutoRepository;

/**
 * Class ProdutoService
 * @package Service
 */
class ProdutoService implements ProdutoServiceInterface
{
    private $produtoEntity;

    private $produtoRepository;

    private $produtoCategoriaEntity;

    private $produtoCategoriaRepository;

    public function __construct(
        ProdutoEntity $produtoEntity,
        ProdutoRepository $produtoRepository,
        ProdutoCategoriaEntity $produtoCategoriaEntity,
        ProdutoCategoriaRepository $produtoCategoriaRepository

    ) {
        $this->produtoEntity = $produtoEntity;
        $this->produtoRepository = $produtoRepository;
        $this->produtoCategoriaEntity = $produtoCategoriaEntity;
        $this->produtoCategoriaRepository = $produtoCategoriaRepository;
    }

    public function incluir($nome, $sku, $preco, $descricao, $quantidade, $categorias)
    {
        if (empty($nome)) {
            throw new \Exception("Parametros Invalidos");
        }

        if (!empty($categorias)) {
            if (!is_array($categorias)) {
                throw new Exception("Categoria inválida");
            }
        }

        $produtoEntity = clone $this->produtoEntity;
        $produtoEntity->setNome($nome);
        $produtoEntity->setSku($sku);
        $produtoEntity->setPreco($preco);
        $produtoEntity->setDescricao($descricao);
        $produtoEntity->setQuantidade($quantidade);
        $produtoEntity = $this->produtoRepository->incluir($produtoEntity);

        if (!empty($categorias) && is_array($categorias)) {
            if (count($categorias) > 0) {
                foreach ($categorias as $categoria) {
                    $produtoCategoriaEntity = clone $this->produtoCategoriaEntity;
                    $produtoCategoriaEntity->setProdutoId($produtoEntity->getId());
                    $produtoCategoriaEntity->setCategoriaId($categoria);
                    $this->produtoCategoriaRepository->incluir($produtoCategoriaEntity);
                }
            }
        }

        return $produtoEntity;
    }

    public function obterPorId($id)
    {
        return $this->produtoRepository->obterPorId($id);
    }

    public function excluir($id)
    {
        $this->produtoCategoriaRepository->excluirByProduto($id);
        return $this->produtoRepository->excluir($id);
    }

    public function listar()
    {
        return $this->produtoRepository->listar();
    }

    public function alterar($id, $nome, $sku, $preco, $descricao, $quantidade, $categorias)
    {
        if (empty($id) || empty($nome)) {
            throw new \Exception("Parametros Invalidos");
        }

        $produtoEntity = clone $this->produtoEntity;
        $produtoEntity->setId($id);
        $produtoEntity->setNome($nome);
        $produtoEntity->setSku($sku);
        $produtoEntity->setPreco($preco);
        $produtoEntity->setDescricao($descricao);
        $produtoEntity->setQuantidade($quantidade);
        $produtoEntity =  $this->produtoRepository->alterar($produtoEntity);

        if (!empty($categorias)) {
            $this->produtoCategoriaRepository->excluirByProduto($id);
            foreach ($categorias as $categoria) {
                $produtoCategoriaEntity = clone $this->produtoCategoriaEntity;
                $produtoCategoriaEntity->setProdutoId($produtoEntity->getId());
                $produtoCategoriaEntity->setCategoriaId($categoria);
                $this->produtoCategoriaRepository->incluir($produtoCategoriaEntity);
            }
        }
        return $produtoEntity;
    }
}