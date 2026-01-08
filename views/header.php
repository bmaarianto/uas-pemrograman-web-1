<?php if (session_status() === PHP_SESSION_NONE) session_start();
$scriptDir = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
$basePath = $scriptDir === '' || $scriptDir === '/' ? '' : $scriptDir;
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>UAS App</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= ($basePath === '' ? '' : $basePath) ?>/products">UAS App</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <?php if(isset($_SESSION['user'])): ?>
          <li class="nav-item"><a class="nav-link">Hello, <?=htmlspecialchars($_SESSION['user']['username'])?></a></li>
          <li class="nav-item"><a class="nav-link" href="<?= ($basePath === '' ? '' : $basePath) ?>/logout">Logout</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="<?= ($basePath === '' ? '' : $basePath) ?>/login">Login</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
