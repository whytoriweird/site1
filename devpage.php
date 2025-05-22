<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Розробники</title>
    <link rel="stylesheet" href="devpage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <nav>
        <div class="logo">WebStore</div>
        <ul>
            <li><a href="../index.php">Головна</a></li>
            <li><a href="../catalog/catalog.php">Каталог</a></li>
            <li><a href="devpage.php" class="active">Про нас</a></li>
            <?php if ($isLoggedIn): ?>
                <li><a href="../authorization/authLogout.php" class="auth-btn">Вийти</a></li>
            <?php else: ?>
                <li><a href="../authorization/auth.php" class="auth-btn">Увійти</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <div class="centered-text">
        <h2>Команда розробників</h2>
    </div>

    <div class="row">
        <?php
        $team = [
            [
                "name" => "Роман Симчич",
                "role" => "Full-stack розробник",
                "image" => "../img/developer.jpg",
            ]
        ];

        foreach ($team as $member) :
        ?>
            <div class="card">
                <img src="<?= $member["image"]; ?>" alt="<?= $member["name"]; ?>">
                <h1><?= $member["name"]; ?></h1>
                <p class="title"><?= $member["role"]; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
