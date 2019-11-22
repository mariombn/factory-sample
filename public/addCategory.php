<?php
require_once '../bootstrap.php';
$view = \Service\ViewServiceFactory::create();

try {
    if (!empty($_POST['action'])) {
        if ($_POST['action'] == 'insert') {
            /** @var \Service\CategoriaService $catgoriaService */
            $catgoriaService = \Service\CategoriaServiceFactory::create();
            $catgoriaService->incluir($_POST['nome']);
            $sucesso = "Categoria cadastrada com Sucesso!";
        }
    }
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
    <h1 class="title new-item">New Category</h1>

    <form action="addCategory.php" method="post">
        <input type="hidden" name="action" value="insert">
        <div class="input-field">
            <label for="category-name" class="label">Category Name</label>
            <input type="text" id="category-name" name="nome" class="input-text"/>

        </div>
        <div class="input-field">
            <label for="category-code" class="label">Category Code</label>
            <input type="text" id="category-code" class="input-text"/>

        </div>
        <div class="actions-form">
            <a href="categories.php" class="action back">Back</a>
            <input class="btn-submit btn-action" type="submit" value="Save"/>
        </div>
    </form>


<?php $view->footer() ?>