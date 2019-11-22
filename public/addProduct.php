<?php
require_once '../bootstrap.php';
$view = \Service\ViewServiceFactory::create();

try {
    if (!empty($_POST['action'])) {
        if ($_POST['action'] == 'insert') {
            /** @var \Service\ProdutoService $produtoService */
            $produtoService = \Service\ProdutoServiceFactory::create();

            $produtoService->incluir($_POST['nome'], $_POST['sku'], $_POST['preco'], $_POST['descricao'], $_POST['quantidade'], $_POST['categorias']);
            $sucesso = "Produto cadastrada com Sucesso!";
        }
    }
    /** @var \Service\CategoriaService $categoriaService */
    $categoriaService = \Service\CategoriaServiceFactory::create();
    $categorias = $categoriaService->listar();
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
    <!-- Main Content -->
    <main class="content">
        <h1 class="title new-item">New Product</h1>

        <form action="addProduct.php" method="post">
            <input type="hidden" name="action" value="insert">
            <div class="input-field">
                <label for="sku" class="label">Product SKU</label>
                <input type="text" id="sku" name="sku" class="input-text"/>
            </div>
            <div class="input-field">
                <label for="name" class="label">Product Name</label>
                <input type="text" id="name" name="nome" class="input-text"/>
            </div>
            <div class="input-field">
                <label for="price" class="label">Price</label>
                <input type="number" id="price" name="preco" class="input-text" step="any"/>
            </div>
            <div class="input-field">
                <label for="quantity" class="label">Quantity</label>
                <input type="text" id="quantity" name="quantidade" class="input-text"/>
            </div>
            <?php if (count($categorias) > 0): ?>
                <div class="input-field">
                    <label for="category" class="label">Categories</label>
                    <select multiple id="category" class="input-text" name="categorias[]">
                        <?php foreach ($categorias as $categoria): ?>
                            <option value="<?php echo $categoria->getId(); ?>">
                                <?php echo $categoria->getNome(); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endif; ?>
            <div class="input-field">
                <label for="description" class="label">Description</label>
                <textarea id="description" class="input-text" name="descricao"></textarea>
            </div>
            <div class="actions-form">
                <a href="products.php" class="action back">Back</a>
                <input class="btn-submit btn-action" type="submit" value="Save Product"/>
            </div>
        </form>
    </main>
    <!-- Main Content -->

<?php $view->footer() ?>