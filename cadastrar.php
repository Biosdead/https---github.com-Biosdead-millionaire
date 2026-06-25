<?php
session_start();
if (isset($_GET['lang']) && in_array($_GET['lang'], ['pt','en'])) {
    $_SESSION['lang'] = $_GET['lang'];
}
$lang = $_SESSION['lang'] ?? 'pt';
include_once "./conexao.php";
include_once "moedas.php";
include "lang.php";

if (isset($_SESSION['id'])) {
    header('Location: dashboard.php');
    exit;
}

$error   = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['email'], $_POST['password'], $_POST['confirmPassword'], $_POST['currencie'], $_POST['amount'])) {

    if ($_POST['password'] !== $_POST['confirmPassword']) {
        $error = $t['reg_pass_mismatch'];
    } else {
        $email = $_POST['email'];

        $check = $conexao->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $error = $t['reg_email_exists'];
        } else {
            $senhaHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt = $conexao->prepare("INSERT INTO users (name, password, email, currencie, amount) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssd", $_POST['name'], $senhaHash, $_POST['email'], $_POST['currencie'], $_POST['amount']);
            if ($stmt->execute()) {
                $success = $t['reg_success'];
                echo "<script>setTimeout(()=>location.href='./login.php',2000)</script>";
            }
            $stmt->close();
        }
        $check->close();
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
    <title><?= htmlspecialchars($t['reg_title']) ?> — <?= htmlspecialchars($t['site_name']) ?></title>
    <meta name="description" content="<?= htmlspecialchars($t['meta_desc_register']) ?>">
    <meta name="robots" content="noindex, follow">
    <meta property="og:title"       content="<?= htmlspecialchars($t['site_name']) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($t['meta_desc_register']) ?>">
    <meta property="og:type"        content="website">
    <link rel="alternate" hreflang="pt" href="cadastrar.php?lang=pt">
    <link rel="alternate" hreflang="en" href="cadastrar.php?lang=en">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Oswald:wght@400;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="site-header">
    <div class="header-inner">
        <a href="index.php<?= $langParam ?>" class="logo">🎩 <?= htmlspecialchars($t['site_name']) ?></a>
        <a href="cadastrar.php?lang=<?= $switchLang ?>" class="lang-btn"><?= $switchLabel ?></a>
    </div>
</header>

<main class="auth-main" style="max-width:480px;">
    <?php if ($error):   ?><div class="alert alert-error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <?php if ($success): ?><div class="alert alert-success"><?= htmlspecialchars($success) ?></div><?php endif; ?>

    <div class="form-card">
        <div class="form-card-header">
            <span class="form-card-icon">💰</span>
            <h1 class="form-card-title"><?= htmlspecialchars($t['reg_title']) ?></h1>
            <p class="form-card-subtitle"><?= htmlspecialchars($t['reg_subtitle']) ?></p>
        </div>
        <div class="form-body">
            <form method="POST" action="cadastrar.php<?= $langParam ?>">
                <div class="form-group">
                    <label class="form-label" for="name"><?= htmlspecialchars($t['reg_name']) ?></label>
                    <input class="form-input" type="text" id="name" name="name"
                           autocomplete="name" required
                           value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label" for="email"><?= htmlspecialchars($t['reg_email']) ?></label>
                    <input class="form-input" type="email" id="email" name="email"
                           autocomplete="email" required
                           value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label" for="password"><?= htmlspecialchars($t['reg_password']) ?></label>
                    <input class="form-input" type="password" id="password" name="password"
                           autocomplete="new-password" required minlength="6">
                </div>
                <div class="form-group">
                    <label class="form-label" for="confirmPassword"><?= htmlspecialchars($t['reg_confirm']) ?></label>
                    <input class="form-input" type="password" id="confirmPassword" name="confirmPassword"
                           autocomplete="new-password" required minlength="6">
                </div>
                <div class="form-group">
                    <label class="form-label" for="currencie"><?= htmlspecialchars($t['reg_currency']) ?></label>
                    <select class="form-select" id="currencie" name="currencie" required>
                        <?php foreach ($moedas as $moeda):
                            $nome     = $lang === 'en' ? $moeda['nome_en'] : $moeda['nome_pt'];
                            $selected = (isset($_POST['currencie']) && $_POST['currencie'] === $moeda['sigla']) ? 'selected' : '';
                        ?>
                        <option value="<?= htmlspecialchars($moeda['sigla']) ?>" <?= $selected ?>>
                            <?= htmlspecialchars($moeda['sigla']) ?> — <?= htmlspecialchars($nome) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="amount"><?= htmlspecialchars($t['reg_amount']) ?></label>
                    <input class="form-input" type="number" id="amount" name="amount"
                           step="0.01" min="0" required
                           placeholder="<?= htmlspecialchars($t['reg_amount_hint']) ?>"
                           value="<?= htmlspecialchars($_POST['amount'] ?? '') ?>">
                </div>
                <button type="submit" class="btn-primary"><?= htmlspecialchars($t['reg_btn']) ?></button>
            </form>
            <div class="form-link">
                <?= htmlspecialchars($t['reg_has_account']) ?>
                <a href="login.php<?= $langParam ?>"><?= htmlspecialchars($t['reg_login']) ?></a>
            </div>
        </div>
    </div>
</main>

<footer class="site-footer">
    <p><?= htmlspecialchars($t['footer_copy']) ?></p>
</footer>
</body>
</html>
