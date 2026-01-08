<?php
require_once __DIR__ . '/Database.php';

class Auth
{
    public static function check()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        return isset($_SESSION['user']);
    }

    public static function user()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        return $_SESSION['user'] ?? null;
    }

    public static function attempt($username, $password)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $pdo = Database::get();
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :u LIMIT 1');
        $stmt->execute(['u' => $username]);
        $u = $stmt->fetch();
        if ($u && password_verify($password, $u['password'])) {
            if (session_status() === PHP_SESSION_ACTIVE) {
                session_regenerate_id(true);
            }
            $_SESSION['user'] = ['id' => $u['id'], 'username' => $u['username'], 'role' => $u['role']];
            return true;
        }
        return false;
    }

    public static function logout()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            setcookie(session_name(), '', time() - 42000);
        }
        session_destroy();
    }
}
