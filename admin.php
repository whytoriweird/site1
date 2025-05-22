<?php
session_start();
require_once '../mySQL/database.php';

// Перевірка прав адміністратора
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../authorization/auth.php');
    exit;
}

// Отримання списку сайтів
try {
    $stmt = $pdo->query("SELECT * FROM saiti");
    $websites = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Помилка отримання даних: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Адмін панель</title>
    <link rel="stylesheet" href="adminPage.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">Адмін панель</div>
            <ul>
                <li><a href="../index.php">На сайт</a></li>
                <li><a href="../authorization/authLogout.php">Вихід</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="admin-panel">
            <h1>Управління сайтами</h1>
            
            <!-- Додати новий сайт -->
            <div class="add-website">
                <h2>Додати новий сайт</h2>
                <form method="POST" action="add_website.php">
                    <input type="text" name="nazva" placeholder="Назва сайту" required>
                    <textarea name="opis" placeholder="Опис сайту" required></textarea>
                    <input type="number" name="tsina" placeholder="Ціна" required>
                    <button type="submit">Додати</button>
                </form>
            </div>

            <!-- Список сайтів -->
            <div class="websites-list">
                <h2>Список сайтів</h2>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Назва</th>
                        <th>Ціна</th>
                        <th>Статус</th>
                        <th>Дії</th>
                    </tr>
                    <?php foreach ($websites as $website): ?>
                    <tr>
                        <td><?= htmlspecialchars($website['id']) ?></td>
                        <td><?= htmlspecialchars($website['nazva']) ?></td>
                        <td><?= number_format($website['tsina'], 2) ?> грн</td>
                        <td><?= $website['dostupnyi'] ? 'Активний' : 'Неактивний' ?></td>
                        <td>
                            <a href="edit_website.php?id=<?= $website['id'] ?>" class="btn-edit">Редагувати</a>
                            <a href="toggle_website.php?id=<?= $website['id'] ?>" class="btn-toggle">
                                <?= $website['dostupnyi'] ? 'Деактивувати' : 'Активувати' ?>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </section>
    </main>
    <script src="admin.js"></script>
</body>
</html>