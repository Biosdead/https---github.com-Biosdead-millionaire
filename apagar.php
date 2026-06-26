<?php
session_start();
if (isset($_GET['lang']) && in_array($_GET['lang'], ['pt','en'])) {
    $_SESSION['lang'] = $_GET['lang'];
}
$lang = $_SESSION['lang'] ?? 'en';
include_once "./autenticador.php";
include_once "./conexao.php";
include "lang.php";

$error   = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
    $password = $_POST['password'];
    $id       = (int) $_SESSION['id'];

    $stmt = $conexao->prepare("SELECT password FROM users WHERE id = ? LIMIT 1");
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        if ($row && password_verify($password, $row['password'])) {
            $del = $conexao->prepare("DELETE FROM users WHERE id = ?");
            $del->bind_param("i", $id);
            $del->execute();
            $del->close();
            session_unset();
            session_destroy();
            $success = $t['del_success'];
            echo "<script>setTimeout(()=>location.href='./login.php',1500)</script>";
        } else {
            $error = $t['del_error'];
        }
    }
}

$switchLang  = $lang === 'pt' ? 'en' : 'pt';
$switchLabel = $lang === 'pt' ? '🇺🇸 EN' : '🇧🇷 PT';
$langParam   = $lang !== 'en' ? '?lang='.$lang : '';
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title><?= htmlspecialchars($t['del_title']) ?> — <?= htmlspecialchars($t['site_name']) ?></title>
    <meta name="robots" content="noindex, nofollow">
        <link rel="icon" type="image/svg+xml" href="favicon.svg">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon.png">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Oswald:wght@400;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="site-header">
    <div class="header-inner">
        <a href="dashboard.php<?= $langParam ?>" class="logo">🎩 <?= htmlspecialchars($t['site_name']) ?></a>
        <div class="header-right">
            <a href="apagar.php?lang=<?= $switchLang ?>" class="lang-btn"><?= $switchLabel ?></a>
            <nav class="nav-links">
                <a href="dashboard.php<?= $langParam ?>" class="nav-link">← <?= $lang === 'en' ? 'Dashboard' : 'Painel' ?></a>
            </nav>
        </div>
    </div>
</header>

<main class="auth-main">
    <?php if ($error):   ?><div class="alert alert-error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <?php if ($success): ?><div class="alert alert-success"><?= htmlspecialchars($success) ?></div><?php endif; ?>

    <div class="form-card">
        <div class="form-card-header" style="background:linear-gradient(145deg,#4a1a1a,#C62828);">
            <span class="form-card-icon">🗑️</span>
            <h1 class="form-card-title"><?= htmlspecialchars($t['del_title']) ?></h1>
        </div>
        <div class="form-body">
            <div class="warning-box">
                <span class="wicon">⚠️</span>
                <p><?= htmlspecialchars($t['del_warning']) ?></p>
            </div>

            <form method="POST" action="apagar.php<?= $langParam ?>">
                <div class="form-group">
                    <label class="form-label" for="password"><?= htmlspecialchars($t['del_password']) ?></label>
                    <input class="form-input" type="password" id="password" name="password"
                           autocomplete="current-password" required>
                </div>
                <button type="submit" class="btn-primary btn-danger"><?= htmlspecialchars($t['del_btn']) ?></button>
            </form>

            <div class="form-link" style="margin-top:14px;">
                <a href="dashboard.php<?= $langParam ?>"><?= htmlspecialchars($t['del_back']) ?></a>
            </div>
        </div>
    </div>
</main>

<footer class="site-footer">
    <p><?= htmlspecialchars($t['footer_copy']) ?></p>
</footer>
</body>
</html>
