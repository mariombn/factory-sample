<?php
require_once '../bootstrap.php';
$view = \Service\ViewServiceFactory::create();

try {
    $catgoriaService = \Service\CategoriaServiceFactory::create();
    if (!empty($_POST['action'])) {
        if ($_POST['action'] == 'update') {
            /** @var \Service\CategoriaService $catgoriaService */
            $catgoriaService->alterar($_POST['id'], $_POST['nome']);
            $sucesso = "Categoria atualizada com Sucesso!";
        }
    }

    if (empty($_GET['id'])) {
        throw new Exception("Nenhum ID de categoria informado");
    }

    $categoriaEntity = $catgoriaService->obterPorId($_GET['id']);

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
    <h1 class="title new-item">Edit Category</h1>

    <form action="editCategory.php?id=<?php echo $_GET['id'] ?>" method="post">
        <input type="hidden" name="action" value="update">
        <div class="input-field">
            <label for="category-name" class="label">Category Name</label>
            <input type="text" id="category-name" name="nome" class="input-text" value="<?php echo $categoriaEntity->getNome() ?>"/>

        </div>
        <div class="input-field">
            <label for="category-code" class="label">Category Code</label>
            <input type="text" id="category-code" name="id" class="input-text" readonly value="<?php echo $categoriaEntity->getId() ?>"/>

        </div>
        <div class="actions-form">
            <a href="categories.php" class="action back">Back</a>
            <input class="btn-submit btn-action" type="submit" value="Save"/>
        </div>
    </form>


<?php $view->footer() ?>