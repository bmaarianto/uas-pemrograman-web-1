<?php
require_once __DIR__ . '/../app/Database.php';

// Run: php scripts/setup.php
try {
    $pdo = Database::get();
    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        role VARCHAR(20) NOT NULL DEFAULT 'user'
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    $pdo->exec("CREATE TABLE IF NOT EXISTS products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        description TEXT,
        price DECIMAL(10,2) DEFAULT 0.00,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    // Insert admin and sample data if not exists
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM users');
    $stmt->execute();
    if ($stmt->fetchColumn() == 0) {
        $pw = password_hash('password', PASSWORD_DEFAULT);
        $pdo->prepare('INSERT INTO users (username, password, role) VALUES (?, ?, ?)')
            ->execute(['admin', $pw, 'admin']);
        $pdo->prepare('INSERT INTO users (username, password, role) VALUES (?, ?, ?)')
            ->execute(['user', $pw, 'user']);
    }

    $stmt = $pdo->prepare('SELECT COUNT(*) FROM products');
    $stmt->execute();
    if ($stmt->fetchColumn() == 0) {
        $pstmt = $pdo->prepare('INSERT INTO products (name, description, price) VALUES (?, ?, ?)');
        for ($i = 1; $i <= 12; $i++) {
            $pstmt->execute(["Sample Product $i", "Description for product $i", rand(1000,10000)/100]);
        }
    }

    echo "Setup complete. Admin credentials: admin / password\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
