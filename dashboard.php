<?php
session_start();
if (isset($_GET['lang']) && in_array($_GET['lang'], ['pt','en'])) {
    $_SESSION['lang'] = $_GET['lang'];
}
$lang = $_SESSION['lang'] ?? 'pt';
include_once "./autenticador.php";
include "./conexao.php";
include "funcoes.php";
include "currencies_meta.php";
include "lang.php";

// Handle logout
if (isset($_GET['acao']) && $_GET['acao'] === 'sair') {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
}

$QtdMoeda  = (float) $_SESSION['montante'];
$moedaOrigem = $_SESSION['moeda'];
$userName    = htmlspecialchars($_SESSION['nome']);

// Get dollar value of user's currency (prepared statement)
$stmtVa = $conexao->prepare("SELECT dollarValue FROM currencies WHERE acronym = ? LIMIT 1");
$stmtVa->bind_param("s", $moedaOrigem);
$stmtVa->execute();
$vmaRow = $stmtVa->get_result()->fetch_assoc();
$stmtVa->close();
$va = $vmaRow ? (float)$vmaRow['dollarValue'] : 1.0;

// Get last rate update date
$dateRow    = $conexao->query("SELECT date FROM currencies WHERE id = 1")->fetch_assoc();
$lastUpdate = $dateRow['date'] ?? '';

// Fetch all currencies sorted by dollarValue DESC (weakest first = easiest millionaire first)
$Moedas = $conexao->query("SELECT * FROM currencies ORDER BY dollarValue DESC");

// Collect millionaire currencies and find next milestone
$milionarias = [];
$proxima     = null;

while ($resultado = $Moedas->fetch_assoc()) {
    $MoedaConvertida = converterMoeda($va, (float)$resultado['dollarValue']) * $QtdMoeda;

    if ($MoedaConvertida >= Milion) {
        $cmeta = getCurrencyMeta($resultado['acronym'], $lang);
        $milionarias[] = [
            'nome'       => $lang === 'en' ? $resultado['nameEnglish'] : $resultado['namePortuguese'],
            'sigla'      => $resultado['acronym'],
            'valor'      => $MoedaConvertida,
            'flag'       => $cmeta['flag'],
            'country'    => $cmeta['country'],
            'amount'     => formatAmount($MoedaConvertida),
            'is_billion' => $MoedaConvertida >= Bilion,
        ];
    } else {
        if ($proxima === null) {
            $Falta          = Milion - $MoedaConvertida;
            $FaltaOrigem    = converterFaltante($Falta, (float)$resultado['dollarValue'], $va);
            $pct            = ($MoedaConvertida / Milion) * 100;
            $pct            = max(0, min(99.9, $pct));
            $proxima = [
                'nome'      => $lang === 'en' ? $resultado['nameEnglish'] : $resultado['namePortuguese'],
                'sigla'     => $resultado['acronym'],
                'falta'     => $FaltaOrigem,
                'pct'       => $pct,
                'valorAtual' => $MoedaConvertida,
            ];
        }
        // Keep iterating to count total — but we already have what we need; break for performance
        break;
    }
}

$countMilionarias = count($milionarias);
$currencyWord     = $countMilionarias === 1 ? $t['dash_currency'] : $t['dash_currencies'];

// Rank system
if ($countMilionarias === 0)       { $rankIcon = '🌱'; $rankKey = 'dash_rank_0'; }
elseif ($countMilionarias <= 10)   { $rankIcon = '💰'; $rankKey = 'dash_rank_1'; }
elseif ($countMilionarias <= 50)   { $rankIcon = '🌍'; $rankKey = 'dash_rank_2'; }
elseif ($countMilionarias <= 100)  { $rankIcon = '💎'; $rankKey = 'dash_rank_3'; }
else                               { $rankIcon = '👑'; $rankKey = 'dash_rank_4'; }

$switchLang  = $lang === 'pt' ? 'en' : 'pt';
$switchLabel = $lang === 'pt' ? '🇺🇸 EN' : '🇧🇷 PT';
$langParam   = $lang !== 'pt' ? '?lang='.$lang : '';

// Structured data for SEO
$schemaName = $t['site_name'];
$schemaDesc = $t['meta_desc_dash'];
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title><?= $userName ?> — <?= htmlspecialchars($t['site_name']) ?></title>
    <meta name="description" content="<?= htmlspecialchars($t['meta_desc_dash']) ?>">
    <meta name="robots" content="noindex, nofollow">
    <meta property="og:title"       content="<?= htmlspecialchars($t['site_name']) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($t['meta_desc_dash']) ?>">
    <meta property="og:type"        content="website">
    <link rel="alternate" hreflang="pt" href="dashboard.php?lang=pt">
    <link rel="alternate" hreflang="en" href="dashboard.php?lang=en">
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
            <a href="dashboard.php?lang=<?= $switchLang ?>" class="lang-btn"><?= $switchLabel ?></a>
            <nav class="nav-links" aria-label="Main navigation">
                <a href="sacar.php<?= $langParam ?>" class="nav-link">✏️ <?= htmlspecialchars($t['nav_update']) ?></a>
                <a href="dashboard.php?acao=sair<?= $lang !== 'pt' ? '&lang='.$lang : '' ?>" class="nav-link">⬛ <?= htmlspecialchars($t['nav_logout']) ?></a>
                <a href="apagar.php<?= $langParam ?>" class="nav-link danger">🗑 <?= htmlspecialchars($t['nav_delete']) ?></a>
            </nav>
        </div>
    </div>
</header>

<main class="main">

    <!-- HERO: User balance -->
    <section class="hero-card" aria-label="<?= htmlspecialchars($t['dash_balance']) ?>">
        <p class="hero-greeting"><?= htmlspecialchars($t['dash_welcome']) ?></p>
        <h1 class="hero-name"><?= $userName ?></h1>
        <p class="hero-balance-label"><?= htmlspecialchars($t['dash_balance']) ?></p>
        <p class="hero-balance"><?= number_format($QtdMoeda, 2, ',', '.') ?></p>
        <span class="hero-currency-tag"><?= htmlspecialchars($moedaOrigem) ?></span>
        <?php if ($lastUpdate): ?>
            <div style="margin-top:10px;">
                <span class="updated-tag">📅 <?= htmlspecialchars($t['dash_updated']) ?>: <?= htmlspecialchars($lastUpdate) ?></span>
            </div>
        <?php endif; ?>
    </section>

    <!-- MILLIONAIRE COUNT -->
    <section class="count-card" aria-label="Millionaire status">
        <div class="rank-badge"><?= $rankIcon ?> <?= htmlspecialchars($t[$rankKey]) ?></div>
        <p class="count-label"><?= htmlspecialchars($t['dash_millionaire_in']) ?></p>
        <p class="count-number" id="count-num"><?= $countMilionarias ?></p>
        <p class="count-sub"><?= htmlspecialchars($currencyWord) ?></p>
    </section>

    <!-- NEXT MILESTONE -->
    <?php if ($proxima): ?>
    <section class="milestone-card" aria-label="<?= htmlspecialchars($t['dash_next_goal']) ?>">
        <div class="milestone-header">
            <span class="icon">🎯</span>
            <h2><?= htmlspecialchars($t['dash_next_goal']) ?></h2>
        </div>
        <div class="milestone-body">
            <p class="milestone-target-name"><?= htmlspecialchars($proxima['nome']) ?></p>
            <span class="milestone-acronym"><?= htmlspecialchars($proxima['sigla']) ?></span>
            <p class="milestone-amount">
                + <?= number_format($proxima['falta'], 2, ',', '.') ?>
                <small style="font-size:0.75rem;color:#999;font-family:'Roboto',sans-serif;font-weight:400;">
                    <?= htmlspecialchars($moedaOrigem) ?>
                </small>
            </p>
            <p class="milestone-sub"><?= htmlspecialchars($t['dash_missing']) ?> <?= htmlspecialchars($proxima['sigla']) ?></p>
            <div class="progress-track" role="progressbar"
                 aria-valuenow="<?= round($proxima['pct'], 1) ?>"
                 aria-valuemin="0" aria-valuemax="100">
                <div class="progress-fill" style="width:<?= max(3, round($proxima['pct'], 1)) ?>%"></div>
            </div>
            <div class="progress-meta">
                <span><?= number_format($proxima['valorAtual'], 0, ',', '.') ?> <?= htmlspecialchars($proxima['sigla']) ?></span>
                <span><?= number_format($proxima['pct'], 2) ?>% → 1.000.000</span>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- CONQUERED CURRENCIES -->
    <?php if (!empty($milionarias)): ?>
    <p class="section-title">🏆 <?= htmlspecialchars($t['dash_conquered']) ?> (<?= $countMilionarias ?>)</p>
    <div class="currency-grid" role="list">
        <?php foreach ($milionarias as $i => $m):
            $stripeClass = 'stripe-' . ($i % 8);
        ?>
        <article class="currency-card" role="listitem"
                 title="<?= htmlspecialchars($m['nome']) ?> — <?= number_format($m['valor'], 0, ',', '.') ?>">
            <div class="currency-card-stripe <?= $stripeClass ?>"></div>
            <div class="currency-card-body">
                <span class="currency-flag"><?= $m['flag'] ?></span>
                <span class="currency-country"><?= htmlspecialchars($m['country']) ?></span>
                <span class="currency-acronym"><?= htmlspecialchars($m['sigla']) ?></span>
                <span class="currency-amount"><?= htmlspecialchars($m['amount']) ?></span>
                <span class="currency-badge<?= $m['is_billion'] ? ' billion' : '' ?>">
                    <?= htmlspecialchars($m['is_billion'] ? $t['badge_billion'] : $t['dash_yes']) ?>
                </span>
            </div>
        </article>
        <?php endforeach; ?>
    </div>

    <?php else: ?>
    <div class="no-million">
        <div class="big-icon">💼</div>
        <p><?= htmlspecialchars($t['dash_no_million']) ?></p>
        <p class="tip">💡 <?= htmlspecialchars($t['dash_tip']) ?></p>
    </div>
    <?php endif; ?>

</main>

<footer class="site-footer">
    <p><?= htmlspecialchars($t['footer_copy']) ?></p>
</footer>

<script>
// Animate count-up for the millionaire number
(function(){
    const el = document.getElementById('count-num');
    if (!el) return;
    const target = parseInt(el.textContent, 10);
    if (target === 0) return;
    let current = 0;
    const step  = Math.max(1, Math.floor(target / 40));
    const timer = setInterval(() => {
        current = Math.min(current + step, target);
        el.textContent = current;
        if (current >= target) clearInterval(timer);
    }, 30);
})();
</script>

</body>
</html>
