<?php
session_start();
require_once '../mySQL/database.php';

$isLoggedIn = isset($_SESSION['user_id']);
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

try {
    $stmt = $pdo->query("SELECT * FROM saiti WHERE dostupnyi = TRUE");
    $websites = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Помилка отримання даних: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Каталог сайтів</title>
    <link rel="stylesheet" href="catalog.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<nav>
    <div class="logo">WebStore</div>
    <ul>
        <li><a href="../index.php">Головна</a></li>
        <li><a href="catalog.php" class="active">Каталог</a></li>
        <li><a href="../about/devpage.php">Про нас</a></li>
        <?php if ($isAdmin): ?>
            <li><a href="../adminPage/admin.php">Адмін панель</a></li>
        <?php endif; ?>
        <?php if ($isLoggedIn): ?>
            <li><a href="../authorization/authLogout.php" class="auth-btn">Вийти</a></li>
        <?php else: ?>
            <li><a href="../authorization/auth.php" class="auth-btn">Увійти</a></li>
        <?php endif; ?>
    </ul>
</nav>

<div class="header-text">
    <h2>Каталог сайтів</h2>
</div>

<div class="catalog-container">
    <?php foreach ($websites as $website): ?>
        <div class="card">
            <h3><?= htmlspecialchars($website['nazva']) ?></h3>
            <p><?= htmlspecialchars($website['opis']) ?></p>
            <p class="price"><?= number_format($website['tsina'], 2) ?> грн</p>
            <button>Замовити</button>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
