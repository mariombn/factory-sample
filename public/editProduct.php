<?php
require_once '../bootstrap.php';
$view = \Service\ViewServiceFactory::create();

try {
    /** @var \Service\ProdutoService $produtoService */
    $produtoService = \Service\ProdutoServiceFactory::create();

    if (!empty($_POST['action'])) {
        if ($_POST['action'] == 'insert') {
            $produtoService->alterar($_POST['id'], $_POST['nome'], $_POST['sku'], $_POST['preco'], $_POST['descricao'], $_POST['quantidade'], $_POST['categorias']);
            $sucesso = "Produto alterado com Sucesso!";
        }
    }

    $produto = $produtoService->obterPorId($_GET['id']);

    $categoriasSelect = $produto->getCategorias();
    $categoriaSelecionadas = [];
    /** @var \Entity\CategoriaEntity $categoriaProduto */
    foreach ($categoriasSelect as $categoriaProduto) {
        $categoriaSelecionadas[] = $categoriaProduto->getId();
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

        <form action="editProduct.php?id=<?php echo $_GET['id'] ?>" method="post">
            <input type="hidden" name="action" value="insert">
            <input type="hidden" name="id" value="<?php echo $produto->getId() ?>">
            <div class="input-field">
                <label for="sku" class="label">Product SKU</label>
                <input type="text" id="sku" name="sku" class="input-text" value="<?php echo $produto->getSku() ?>"/>
            </div>
            <div class="input-field">
                <label for="name" class="label">Product Name</label>
                <input type="text" id="name" name="nome" class="input-text" value="<?php echo $produto->getNome() ?>"/>
            </div>
            <div class="input-field">
                <label for="price" class="label">Price</label>
                <input type="number" id="price" name="preco" class="input-text" step="any" value="<?php echo $produto->getPreco() ?>"/>
            </div>
            <div class="input-field">
                <label for="quantity" class="label">Quantity</label>
                <input type="text" id="quantity" name="quantidade" class="input-text" value="<?php echo $produto->getQuantidade() ?>"/>
            </div>
            <?php if (count($categorias) > 0): ?>
                <div class="input-field">
                    <label for="category" class="label">Categories</label>
                    <select multiple id="category" class="input-text" name="categorias[]">
                        <?php foreach ($categorias as $categoria): ?>
                            <option value="<?php echo $categoria->getId(); ?>"
                                <?php echo (in_array($categoria->getId(), $categoriaSelecionadas)) ? ' selected' : '' ?>>
                                <?php echo $categoria->getNome(); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endif; ?>
            <div class="input-field">
                <label for="description" class="label">Description</label>
                <textarea id="description" class="input-text" name="descricao"><?php echo $produto->getDescricao() ?></textarea>
            </div>
            <div class="actions-form">
                <a href="products.php" class="action back">Back</a>
                <input class="btn-submit btn-action" type="submit" value="Save Product"/>
            </div>
        </form>
    </main>
    <!-- Main Content -->

<?php $view->footer() ?>