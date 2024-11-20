<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$host = 'localhost';
$db   = 'db_penjualan';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$action = $_GET['action'] ?? '';

switch($action) {
    case 'getAllBranches':
        $stmt = $pdo->query('SELECT * FROM penjualan_indonesia');
        echo json_encode($stmt->fetchAll());
        break;
        
    case 'getBranchSales':
        $branchId = $_GET['branch_id'] ?? '';
        if ($branchId === 'all') {
            $stmt = $pdo->query('SELECT * FROM penjualan_indonesia');
        } else {
            $stmt = $pdo->prepare('SELECT * FROM penjualan_indonesia WHERE id_cabang = ?');
            $stmt->execute([$branchId]);
        }
        echo json_encode($stmt->fetchAll());
        break;
        
    case 'getTotalSales':
        $stmt = $pdo->query('SELECT SUM(penjualan_bulanan) as total_penjualan FROM penjualan_indonesia');
        echo json_encode($stmt->fetch());
        break;
        
    default:
        echo json_encode(['error' => 'Invalid action']);
}
?>