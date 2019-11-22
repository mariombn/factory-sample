<?php

require_once "bootstrap.php";

try {
    $file = file_get_contents('assets/import.csv');

    $lines = explode(PHP_EOL, $file);

    /** @var \Service\CategoriaService $categoriaService */
    $categoriaService = \Service\CategoriaServiceFactory::create();

    /** @var \Service\ProdutoService $produtoService */
    $produtoService = \Service\ProdutoServiceFactory::create();

    $count = 0;
    foreach ($lines as $line) {
        $count++;
        if ($count > 1) {
            $fields = explode(';', $line);
            if (array_key_exists(5, $fields)) {
                $categorias = explode('|', $fields[5]);
                $listaCategorias = [];
                if (count($categorias) > 0) {
                    foreach ($categorias as $categoria) {
                        if (!empty($categoria)) {
                            try {
                                $categoriaEntity = $categoriaService->obterPorNome($categoria);
                            } catch (Exception $e) {
                                $categoriaEntity = $categoriaService->incluir($categoria);
                            }

                            $listaCategorias[] = $categoriaEntity->getId();
                        }
                    }
                }
                $produtoEntity = $produtoService->incluir(
                    $fields[0], $fields[1], $fields[4], $fields[2], $fields[3], $listaCategorias
                );
            }
        }
    }
} catch (Exception $e) {
    print_r($e);
}