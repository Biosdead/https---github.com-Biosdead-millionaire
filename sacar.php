<?php
session_start();
if (isset($_GET['lang']) && in_array($_GET['lang'], ['pt','en'])) {
    $_SESSION['lang'] = $_GET['lang'];
}
$lang = $_SESSION['lang'] ?? 'pt';
include_once "./autenticador.php";
include_once "./conexao.php";
include_once "moedas.php";
include "lang.php";

$montante   = (float) $_SESSION['montante'];
$moedaAtual = $_SESSION['moeda'];
$success    = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['valor'], $_POST['moedaAtual'])) {
    $novoValor  = (float)  $_POST['valor'];
    $novaMoeda  = (string) $_POST['moedaAtual'];
    $id         = (int)    $_SESSION['id'];

    if ($novoValor !== $montante) {
        $stmt = $conexao->prepare("UPDATE users SET amount = ? WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("di", $novoValor, $id);
            $stmt->execute();
            $stmt->close();
            $_SESSION['montante'] = $novoValor;
            $montante = $novoValor;
        }
    }

    if ($novaMoeda !== $moedaAtual) {
        $stmt = $conexao->prepare("UPDATE users SET currencie = ? WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("si", $novaMoeda, $id);
            $stmt->execute();
            $stmt->close();
            $_SESSION['moeda'] = $novaMoeda;
            $moedaAtual = $novaMoeda;
        }
    }

    $success = $t['upd_btn'];
    header('Location: dashboard.php' . ($lang !== 'pt' ? '?lang='.$lang : ''));
    exit;
}

$switchLang  = $lang === 'pt' ? 'en' : 'pt';
$switchLabel = $lang === 'pt' ? 'EN' : 'PT';
$langParam   = $lang !== 'pt' ? '?lang='.$lang : '';
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title><?= htmlspecialchars($t['upd_title']) ?> — <?= htmlspecialchars($t['site_name']) ?></title>
    <meta name="description" content="<?= htmlspecialchars($t['meta_desc_update']) ?>">
    <meta name="robots" content="noindex, nofollow">
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
            <a href="sacar.php?lang=<?= $switchLang ?>" class="lang-btn"><?= $switchLabel ?></a>
            <nav class="nav-links">
                <a href="dashboard.php<?= $langParam ?>" class="nav-link">← <?= htmlspecialchars($t['nav_update'] === 'Update' ? 'Dashboard' : 'Painel') ?></a>
            </nav>
        </div>
    </div>
</header>

<main class="auth-main" style="max-width:480px;">

    <div class="form-card">
        <div class="form-card-header">
            <span class="form-card-icon">✏️</span>
            <h1 class="form-card-title"><?= htmlspecialchars($t['upd_title']) ?></h1>
            <p class="form-card-subtitle"><?= htmlspecialchars($t['upd_subtitle']) ?></p>
        </div>
        <div class="form-body">
            <div class="balance-display">
                <span class="bl-label"><?= htmlspecialchars($t['upd_current']) ?></span>
                <span class="bl-value">
                    <?= number_format($montante, 2, ',', '.') ?>
                    <small style="font-size:0.9rem;color:#666;"><?= htmlspecialchars($moedaAtual) ?></small>
                </span>
            </div>

            <form method="POST" action="sacar.php<?= $langParam ?>">
                <div class="form-group">
                    <label class="form-label" for="moedaAtual"><?= htmlspecialchars($t['upd_currency']) ?></label>
                    <select class="form-select" id="moedaAtual" name="moedaAtual">
                        <?php foreach ($moedas as $moeda):
                            $nome     = $lang === 'en' ? $moeda['nome_en'] : $moeda['nome_pt'];
                            $selected = $moeda['sigla'] === $moedaAtual ? 'selected' : '';
                        ?>
                        <option value="<?= htmlspecialchars($moeda['sigla']) ?>" <?= $selected ?>>
                            <?= htmlspecialchars($moeda['sigla']) ?> — <?= htmlspecialchars($nome) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="valor"><?= htmlspecialchars($t['upd_amount']) ?></label>
                    <input class="form-input" type="number" id="valor" name="valor"
                           step="0.01" min="0" required
                           value="<?= htmlspecialchars($montante) ?>">
                </div>
                <button type="submit" class="btn-primary"><?= htmlspecialchars($t['upd_btn']) ?></button>
            </form>
        </div>
    </div>

</main>

<footer class="site-footer">
    <p><?= htmlspecialchars($t['footer_copy']) ?></p>
</footer>
</body>
</html>
