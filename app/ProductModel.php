<?php
require_once __DIR__ . '/Database.php';

class ProductModel
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = Database::get();
    }

    public function paginate($q = '', $page = 1, $perPage = 5)
    {
        $offset = ($page - 1) * $perPage;
        $params = [];
        $sql = 'SELECT SQL_CALC_FOUND_ROWS * FROM products';
        if ($q) {
            $sql .= ' WHERE name LIKE :q OR description LIKE :q';
            $params['q'] = "%$q%";
        }
        $sql .= ' ORDER BY id DESC LIMIT :lim OFFSET :off';
        $stmt = $this->pdo->prepare($sql);
        foreach ($params as $k => $v) $stmt->bindValue(':' . $k, $v);
        $stmt->bindValue(':lim', (int)$perPage, PDO::PARAM_INT);
        $stmt->bindValue(':off', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        $items = $stmt->fetchAll();
        $total = $this->pdo->query('SELECT FOUND_ROWS()')->fetchColumn();
        return ['data' => $items, 'total' => (int)$total, 'page' => $page, 'perPage' => $perPage];
    }

    public function find($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM products WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $stmt = $this->pdo->prepare('INSERT INTO products (name, description, price) VALUES (:n, :d, :p)');
        return $stmt->execute(['n' => $data['name'], 'd' => $data['description'], 'p' => $data['price']]);
    }

    public function update($id, $data)
    {
        $stmt = $this->pdo->prepare('UPDATE products SET name = :n, description = :d, price = :p WHERE id = :id');
        return $stmt->execute(['n' => $data['name'], 'd' => $data['description'], 'p' => $data['price'], 'id' => $id]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM products WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}
