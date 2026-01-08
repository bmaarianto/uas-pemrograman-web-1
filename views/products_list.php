<?php require __DIR__ . '/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <h3>Products</h3>
  <div>
    <?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
      <a class="btn btn-sm btn-success" href="<?= ($basePath === '' ? '' : $basePath) ?>/products/create">Create</a>
    <?php endif; ?>
  </div>
</div>

<form class="mb-3" method="get" action="<?= ($basePath === '' ? '' : $basePath) ?>/products">
  <div class="input-group">
    <input name="q" value="<?=htmlspecialchars($_GET['q'] ?? '')?>" class="form-control" placeholder="Search...">
    <button class="btn btn-outline-secondary">Search</button>
  </div>
</form>

<?php if (empty($res['data'])): ?>
  <div class="alert alert-secondary">No items found.</div>
<?php else: ?>
  <div class="list-group">
    <?php foreach($res['data'] as $it): ?>
      <div class="list-group-item d-flex justify-content-between align-items-start">
        <div>
          <div class="fw-bold"><?=htmlspecialchars($it['name'])?></div>
          <div class="text-muted small"><?=htmlspecialchars($it['description'])?></div>
        </div>
        <div class="text-end">
          <div class="mb-2"><?=number_format($it['price'],2)?></div>
          <?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
            <a class="btn btn-sm btn-primary" href="<?= ($basePath === '' ? '' : $basePath) ?>/products/edit/<?=$it['id']?>">Edit</a>
            <a class="btn btn-sm btn-danger" href="<?= ($basePath === '' ? '' : $basePath) ?>/products/delete/<?=$it['id']?>" onclick="return confirm('Delete?')">Delete</a>
          <?php endif; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <?php
    $total = $res['total']; $per = $res['perPage']; $page = $res['page']; $pages = ceil($total / $per);
  ?>
  <?php if ($pages > 1): ?>
    <nav class="mt-3">
      <ul class="pagination">
        <?php for($i=1;$i<=$pages;$i++): ?>
          <li class="page-item <?= $i===$page ? 'active' : ''?>"><a class="page-link" href="<?= ($basePath === '' ? '' : $basePath) ?>/products?q=<?=urlencode($_GET['q'] ?? '')?>&page=<?=$i?>"><?=$i?></a></li>
        <?php endfor; ?>
      </ul>
    </nav>
  <?php endif; ?>

<?php endif; ?>

<?php require __DIR__ . '/footer.php'; ?>
