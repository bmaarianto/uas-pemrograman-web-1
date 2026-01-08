<?php
require_once __DIR__ . '/app/Auth.php';
require_once __DIR__ . '/app/ProductModel.php';

// Compute request URI relative to the application base (supports sub-folder deployment)
$scriptDir = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
$basePath = $scriptDir === '' || $scriptDir === '/' ? '' : $scriptDir;
$requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($basePath !== '' && strpos($requestPath, $basePath) === 0) {
    $uri = substr($requestPath, strlen($basePath));
    if ($uri === '') $uri = '/';
} else {
    $uri = $requestPath;
}
$method = $_SERVER['REQUEST_METHOD'];

// Simple routing
if ($uri === '/' || $uri === '') {
    header('Location: ' . ($basePath === '' ? '' : $basePath) . '/products');
    exit;
}

if ($uri === '/login') {
    if ($method === 'POST') {
        $u = $_POST['username'] ?? '';
        $p = $_POST['password'] ?? '';
        if (Auth::attempt($u, $p)) {
            header('Location: ' . ($basePath === '' ? '' : $basePath) . '/products'); exit;
        } else {
            $error = 'Invalid credentials';
        }
    }
    require __DIR__ . '/views/login.php';
    exit;
}

if ($uri === '/logout') {
    Auth::logout();
    header('Location: ' . ($basePath === '' ? '' : $basePath) . '/login'); exit;
}

// product routes
if (strpos($uri, '/products') === 0) {
    $pm = new ProductModel();
    // list
    if ($uri === '/products') {
        $q = $_GET['q'] ?? '';
        $page = max(1, (int)($_GET['page'] ?? 1));
        $res = $pm->paginate($q, $page, 5);
        require __DIR__ . '/views/products_list.php';
        exit;
    }

    // create
    if ($uri === '/products/create') {
        if (!Auth::check() || Auth::user()['role'] !== 'admin') { header('HTTP/1.1 403 Forbidden'); echo 'Forbidden'; exit; }
        if ($method === 'POST') {
            $pm->create($_POST);
            header('Location: ' . ($basePath === '' ? '' : $basePath) . '/products'); exit;
        }
        $item = null;
        require __DIR__ . '/views/products_form.php';
        exit;
    }

    // edit
    if (preg_match('#^/products/edit/(\d+)$#', $uri, $m)) {
        $id = (int)$m[1];
        if (!Auth::check() || Auth::user()['role'] !== 'admin') { header('HTTP/1.1 403 Forbidden'); echo 'Forbidden'; exit; }
        if ($method === 'POST') {
            $pm->update($id, $_POST);
            header('Location: ' . ($basePath === '' ? '' : $basePath) . '/products'); exit;
        }
        $item = $pm->find($id);
        require __DIR__ . '/views/products_form.php';
        exit;
    }

    // delete
    if (preg_match('#^/products/delete/(\d+)$#', $uri, $m)) {
        $id = (int)$m[1];
        if (!Auth::check() || Auth::user()['role'] !== 'admin') { header('HTTP/1.1 403 Forbidden'); echo 'Forbidden'; exit; }
        $pm->delete($id);
        header('Location: ' . ($basePath === '' ? '' : $basePath) . '/products'); exit;
    }
}

// 404
http_response_code(404);
echo "Not Found";
