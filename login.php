<?php
session_start();
if (isset($_GET['lang']) && in_array($_GET['lang'], ['pt','en'])) {
    $_SESSION['lang'] = $_GET['lang'];
}
$lang = $_SESSION['lang'] ?? 'pt';
include_once "./conexao.php";
include "lang.php";

if (isset($_SESSION['id'])) {
    header('Location: dashboard.php');
    exit;
}

$error   = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['password'])) {
    $email    = $_POST['email'];
    $password = $_POST['password'];

    $preparada = $conexao->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
    if ($preparada) {
        $preparada->bind_param("s", $email);
        $preparada->execute();
        $resultado = $preparada->get_result();
        if ($resultado->num_rows > 0) {
            $usuario = $resultado->fetch_assoc();
            if (password_verify($password, $usuario['password'])) {
                $_SESSION['id']       = $usuario['id'];
                $_SESSION['nome']     = $usuario['name'];
                $_SESSION['email']    = $usuario['email'];
                $_SESSION['moeda']    = $usuario['currencie'];
                $_SESSION['montante'] = $usuario['amount'];
                $success = $t['login_success'];
                echo "<script>setTimeout(()=>location.href='./dashboard.php',500)</script>";
            } else {
                $error = $t['login_error'];
            }
        } else {
            $error = $t['login_error'];
        }
        $preparada->close();
    }
}

$switchLang  = $lang === 'pt' ? 'en' : 'pt';
$switchLabel = $lang === 'pt' ? '🇺🇸 EN' : '🇧🇷 PT';
$langParam   = $lang !== 'pt' ? '?lang='.$lang : '';
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title><?= htmlspecialchars($t['login_title']) ?> — <?= htmlspecialchars($t['site_name']) ?></title>
    <meta name="description" content="<?= htmlspecialchars($t['meta_desc_login']) ?>">
    <meta name="robots" content="noindex, follow">
    <meta property="og:title"       content="<?= htmlspecialchars($t['site_name']) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($t['meta_desc_login']) ?>">
    <meta property="og:type"        content="website">
    <link rel="alternate" hreflang="pt" href="login.php?lang=pt">
    <link rel="alternate" hreflang="en" href="login.php?lang=en">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Oswald:wght@400;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="site-header">
    <div class="header-inner">
        <a href="index.php<?= $langParam ?>" class="logo">🎩 <?= htmlspecialchars($t['site_name']) ?></a>
        <a href="login.php?lang=<?= $switchLang ?>" class="lang-btn"><?= $switchLabel ?></a>
    </div>
</header>

<main class="auth-main">
    <?php if ($error):   ?><div class="alert alert-error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <?php if ($success): ?><div class="alert alert-success"><?= htmlspecialchars($success) ?></div><?php endif; ?>

    <div class="form-card">
        <div class="form-card-header">
            <span class="form-card-icon">🎩</span>
            <h1 class="form-card-title"><?= htmlspecialchars($t['login_title']) ?></h1>
            <p class="form-card-subtitle"><?= htmlspecialchars($t['login_subtitle']) ?></p>
        </div>
        <div class="form-body">
            <form method="POST" action="login.php<?= $langParam ?>">
                <div class="form-group">
                    <label class="form-label" for="email"><?= htmlspecialchars($t['login_email']) ?></label>
                    <input class="form-input" type="email" id="email" name="email"
                           autocomplete="email" required
                           value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label" for="password"><?= htmlspecialchars($t['login_password']) ?></label>
                    <input class="form-input" type="password" id="password" name="password"
                           autocomplete="current-password" required>
                </div>
                <button type="submit" class="btn-primary"><?= htmlspecialchars($t['login_btn']) ?></button>
            </form>
            <div class="form-link">
                <?= htmlspecialchars($t['login_no_account']) ?>
                <a href="cadastrar.php<?= $langParam ?>"><?= htmlspecialchars($t['login_register']) ?></a>
            </div>
        </div>
    </div>
</main>

<footer class="site-footer">
    <p><?= htmlspecialchars($t['footer_copy']) ?></p>
</footer>
</body>
</html>
