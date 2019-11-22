<?php

require_once '../bootstrap.php';

$view = \Service\ViewServiceFactory::create();

/** @var \Service\CategoriaService $categoriaService */
$categoriaService = Service\CategoriaServiceFactory::create();

$categorias = $categoriaService->listar();

$view->header();

if (isset($erro)) {
    $view->erro($erro);
}
if (isset($sucesso)) {
    $view->sucesso($sucesso);
}
?>
    <!-- Main Content -->
    <main class="content">
        <div class="header-list-page">
            <h1 class="title">Categories</h1>
            <a href="addCategory.php" class="btn-action">Add new Category</a>
        </div>
        <table class="data-grid">
            <tr class="data-row">
                <th class="data-grid-th">
                    <span class="data-grid-cell-content">Name</span>
                </th>
                <th class="data-grid-th">
                    <span class="data-grid-cell-content">Code</span>
                </th>
                <th class="data-grid-th">
                    <span class="data-grid-cell-content">Actions</span>
                </th>
            </tr>
            <?php foreach ($categorias as $categoria): ?>
                <tr class="data-row">
                    <td class="data-grid-td">
                        <span class="data-grid-cell-content"><?php echo $categoria->getNome() ?></span>
                    </td>

                    <td class="data-grid-td">
                        <span class="data-grid-cell-content"><?php echo $categoria->getId() ?></span>
                    </td>

                    <td class="data-grid-td">
                        <div class="actions">
                            <div class="action edit"><span><a
                                            href="editCategory.php?id=<?php echo $categoria->getId() ?>">Edit</a></span>
                            </div>
                            <div class="action delete"><span><a
                                            href="deleteCategory.php?id=<?php echo $categoria->getId() ?>">Delete</a></span></div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </main>
    <!-- Main Content -->

<?php $view->footer() ?>