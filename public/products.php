<?php

require_once '../bootstrap.php';

$view = \Service\ViewServiceFactory::create();

/** @var \Service\ProdutoService $produtoService */
$produtoService = Service\ProdutoServiceFactory::create();

$produtos = $produtoService->listar();

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
            <h1 class="title">Products</h1>
            <a href="addProduct.php" class="btn-action">Add new Product</a>
        </div>
        <table class="data-grid">
            <tr class="data-row">
                <th class="data-grid-th">
                    <span class="data-grid-cell-content">Name</span>
                </th>
                <th class="data-grid-th">
                    <span class="data-grid-cell-content">SKU</span>
                </th>
                <th class="data-grid-th">
                    <span class="data-grid-cell-content">Price</span>
                </th>
                <th class="data-grid-th">
                    <span class="data-grid-cell-content">Quantity</span>
                </th>
                <th class="data-grid-th">
                    <span class="data-grid-cell-content">Categories</span>
                </th>

                <th class="data-grid-th">
                    <span class="data-grid-cell-content">Actions</span>
                </th>
            </tr>
            <?php foreach ($produtos as $produto): ?>
                <tr class="data-row">
                    <td class="data-grid-td">
                        <span class="data-grid-cell-content"><?php echo $produto->getNome(); ?></span>
                    </td>

                    <td class="data-grid-td">
                        <span class="data-grid-cell-content"><?php echo $produto->getSku(); ?></span>
                    </td>

                    <td class="data-grid-td">
                        <span class="data-grid-cell-content"><?php echo $produto->getPreco(); ?></span>
                    </td>

                    <td class="data-grid-td">
                        <span class="data-grid-cell-content"><?php echo $produto->getQuantidade(); ?></span>
                    </td>

                    <td class="data-grid-td">
                        <span class="data-grid-cell-content">
                            <?php foreach ($produto->getCategorias() as $categoria): ?>
                                <?php echo $categoria->getNome() ?><br>
                            <?php endforeach; ?>
                        </span>
                    </td>

                    <td class="data-grid-td">
                        <div class="actions">
                            <a href="editProduct.php?id=<?php echo $produto->getId(); ?>" class="action edit"><span>Edit</span></a>
                            <a href="deleteProduct.php?id=<?php echo $produto->getId(); ?>" class="action delete"><span>Delete</span></a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </main>
    <!-- Main Content -->

<?php $view->footer() ?>