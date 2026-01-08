<?php require __DIR__ . '/header.php'; ?>
<div class="row justify-content-center">
  <div class="col-12 col-md-8">
    <h3><?= $item ? 'Edit' : 'Create' ?> Product</h3>
    <form method="post">
      <div class="mb-3">
        <label class="form-label">Name</label>
        <input class="form-control" name="name" value="<?=htmlspecialchars($item['name'] ?? '')?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea class="form-control" name="description"><?=htmlspecialchars($item['description'] ?? '')?></textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Price</label>
        <input class="form-control" name="price" value="<?=htmlspecialchars($item['price'] ?? '')?>" required>
      </div>
      <button class="btn btn-primary">Save</button>
      <a class="btn btn-secondary" href="<?= ($basePath === '' ? '' : $basePath) ?>/products">Back</a>
    </form>
  </div>
</div>
<?php require __DIR__ . '/footer.php'; ?>
