<?php require __DIR__ . '/header.php'; ?>
<div class="row justify-content-center">
  <div class="col-12 col-sm-8 col-md-6">
    <h3>Login</h3>
    <?php if (!empty($error)): ?><div class="alert alert-danger"><?=htmlspecialchars($error)?></div><?php endif; ?>
    <form method="post">
      <div class="mb-3">
        <label class="form-label">Username</label>
        <input class="form-control" name="username" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" name="password" required>
      </div>
      <button class="btn btn-primary">Login</button>
    </form>
  </div>
</div>
<?php require __DIR__ . '/footer.php'; ?>
