<?php
require_once '../bootstrap.php';
$view = \Service\ViewServiceFactory::create();

try {
    $produtoService = \Service\ProdutoServiceFactory::create();

    if (empty($_GET['id'])) {
        throw new Exception("Nenhum ID de produto informado");
    }

    $produtoService->excluir($_GET['id']);
    $sucesso = "Produto excluida com Sucesso!";

} catch (Exception $e) {
    $erro = $e->getMessage();
}

$view->header();

if (isset($erro)) {
    $view->erro($erro);
}
if (isset($sucesso)) {
    $view->sucesso($sucesso);
}
?>
    <h1 class="title new-item">Delete Category</h1>


    <div class="actions-form">
        <a href="categories.php" class="action back">Back</a>
    </div>


<?php $view->footer() ?>