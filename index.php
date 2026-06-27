<?php
session_start();
if (isset($_GET['lang']) && in_array($_GET['lang'], ['pt','en'])) {
    $_SESSION['lang'] = $_GET['lang'];
}
$lang = $_SESSION['lang'] ?? 'en';

// Suppress any debug output from ponte.php during rate updates
ob_start();
include "./conexao.php";
include "funcoes.php";
ob_end_clean();
include "currencies_meta.php";

include_once "moedas.php";
include "lang.php";

// Redirect authenticated users to their dashboard
if (isset($_SESSION['id'])) {
    header('Location: dashboard.php' . ($lang !== 'en' ? '?lang='.$lang : ''));
    exit;
}

// ── Process converter form ────────────────────────────────────────────────────
$milionarias  = [];
$proxima      = null;
$countMil     = 0;
$valorForm    = null;
$moedaForm    = null;
$hasResults   = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['valor'], $_POST['moeda'])
    && is_numeric($_POST['valor'])
    && (float)$_POST['valor'] > 0
) {
    $valorForm = (float) $_POST['valor'];
    $moedaForm = preg_replace('/[^A-Z]/', '', strtoupper($_POST['moeda']));

    // Get dollar rate of user's chosen currency
    $stmtVa = $conexao->prepare("SELECT dollarValue FROM currencies WHERE acronym = ? LIMIT 1");
    $stmtVa->bind_param("s", $moedaForm);
    $stmtVa->execute();
    $vmaRow = $stmtVa->get_result()->fetch_assoc();
    $stmtVa->close();

    if ($vmaRow) {
        $va = (float) $vmaRow['dollarValue'];

        $Moedas = $conexao->query("SELECT * FROM currencies ORDER BY dollarValue DESC");
        while ($row = $Moedas->fetch_assoc()) {
            $convertido = converterMoeda($va, (float)$row['dollarValue']) * $valorForm;

            if ($convertido >= Milion) {
                $cmeta = getCurrencyMeta($row['acronym'], $lang);
                $milionarias[] = [
                    'nome'       => $lang === 'en' ? $row['nameEnglish'] : $row['namePortuguese'],
                    'sigla'      => $row['acronym'],
                    'valor'      => $convertido,
                    'flag'       => $cmeta['flag'],
                    'country'    => $cmeta['country'],
                    'amount'     => formatAmount($convertido),
                    'is_billion' => $convertido >= Bilion,
                ];
                $countMil++;
            } else {
                if ($proxima === null) {
                    $falta   = Milion - $convertido;
                    $faltaOr = converterFaltante($falta, (float)$row['dollarValue'], $va);
                    $pct     = max(0, min(99.9, ($convertido / Milion) * 100));
                    $proxima = [
                        'nome'      => $lang === 'en' ? $row['nameEnglish'] : $row['namePortuguese'],
                        'sigla'     => $row['acronym'],
                        'falta'     => $faltaOr,
                        'pct'       => $pct,
                        'valorAtual' => $convertido,
                    ];
                }
                break;
            }
        }
        $hasResults = true;
    }
}

// Rank based on count
if ($countMil === 0)       { $rankIcon = '🌱'; $rankKey = 'dash_rank_0'; }
elseif ($countMil <= 10)   { $rankIcon = '💰'; $rankKey = 'dash_rank_1'; }
elseif ($countMil <= 50)   { $rankIcon = '🌍'; $rankKey = 'dash_rank_2'; }
elseif ($countMil <= 100)  { $rankIcon = '💎'; $rankKey = 'dash_rank_3'; }
else                       { $rankIcon = '👑'; $rankKey = 'dash_rank_4'; }

$currencyWord = $countMil === 1 ? $t['dash_currency'] : $t['dash_currencies'];

$switchLang  = $lang === 'pt' ? 'en' : 'pt';
$switchLabel = $lang === 'pt' ? '🇺🇸 EN' : '🇧🇷 PT';
$langParam   = $lang !== 'en' ? '?lang='.$lang : '';
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($t['site_name']) ?> — <?= htmlspecialchars($t['tagline']) ?></title>
    <meta name="description" content="<?= htmlspecialchars($t['meta_desc_home']) ?>">
    <meta name="keywords" content="millionaire calculator, currency millionaire, am i a millionaire, wealth tracker, financial reserve, sou milionario, milionario moedas, calculadora milionario">
    <meta name="robots" content="index, follow">
    <meta property="og:title"       content="<?= htmlspecialchars($t['site_name']) ?> — <?= htmlspecialchars($t['tagline']) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($t['meta_desc_home']) ?>">
    <meta property="og:type"        content="website">
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="<?= htmlspecialchars($t['site_name']) ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($t['meta_desc_home']) ?>">
    <link rel="canonical"     href="https://amiamillionaire.io/">
    <link rel="alternate" hreflang="pt"      href="index.php?lang=pt">
    <link rel="alternate" hreflang="en"      href="index.php?lang=en">
    <link rel="alternate" hreflang="x-default" href="index.php">
        <link rel="icon" type="image/svg+xml" href="favicon.svg">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon.png">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Oswald:wght@400;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        /* ── Converter-specific styles ── */
        .conv-hero {
            text-align: center;
            padding: 36px 16px 24px;
        }
        .conv-hero-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            font-weight: 900;
            color: var(--gold);
            line-height: 1.15;
            margin-bottom: 12px;
        }
        .conv-hero-sub {
            font-size: 0.95rem;
            color: rgba(255,255,255,0.78);
            line-height: 1.6;
            max-width: 400px;
            margin: 0 auto 24px;
        }
        .conv-form-card {
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-bottom: 14px;
            border-top: 4px solid var(--gold);
        }
        .conv-form-body { padding: 20px 20px 22px; }
        .conv-row {
            display: flex;
            gap: 10px;
            align-items: flex-end;
        }
        .conv-row .form-group { flex: 1; margin-bottom: 0; }
        .conv-row .form-group:first-child { flex: 1.2; }
        .btn-conv {
            width: 100%;
            padding: 14px;
            background: var(--gold);
            color: var(--green-dark);
            border: none;
            border-radius: var(--radius-sm);
            font-family: 'Oswald', sans-serif;
            font-size: 1.05rem;
            font-weight: 700;
            letter-spacing: 2px;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 14px;
        }
        .btn-conv:hover { background: white; box-shadow: 0 4px 16px rgba(255,255,255,0.2); }
        /* CTA card to register */
        .cta-card {
            background: linear-gradient(145deg, #1A4A1E, var(--green-mid));
            border: 2px solid var(--gold);
            border-radius: var(--radius);
            padding: 24px 20px;
            text-align: center;
            margin-bottom: 14px;
            box-shadow: var(--shadow);
        }
        .cta-card h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.35rem;
            font-weight: 900;
            color: var(--gold);
            margin-bottom: 8px;
        }
        .cta-card p {
            font-size: 0.88rem;
            color: rgba(255,255,255,0.75);
            line-height: 1.55;
            margin-bottom: 18px;
        }
        .btn-cta-gold {
            display: inline-block;
            background: var(--gold);
            color: var(--green-dark);
            font-family: 'Oswald', sans-serif;
            font-weight: 700;
            font-size: 0.95rem;
            letter-spacing: 2px;
            padding: 14px 28px;
            border-radius: var(--radius-sm);
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-cta-gold:hover { background: white; transform: translateY(-1px); }
        .cta-login-link {
            display: block;
            margin-top: 12px;
            color: rgba(255,255,255,0.5);
            font-size: 0.82rem;
            text-decoration: none;
        }
        .cta-login-link:hover { color: rgba(255,255,255,0.8); }
        /* How it works (shown before results) */
        .how-section {
            background: white;
            border-radius: var(--radius);
            padding: 20px;
            margin-bottom: 14px;
            box-shadow: var(--shadow-sm);
        }
        .how-section .land-section-title { margin-bottom: 14px; }
        @media (min-width: 480px) {
            .conv-hero-title { font-size: 2.8rem; }
        }
    </style>

    <!-- Structured data -->
    <script type="application/ld+json">
    <?= json_encode([
        '@context'            => 'https://schema.org',
        '@type'               => 'WebApplication',
        'name'                => 'Am I A Millionaire?',
        'alternateName'       => 'Sou Milionário?',
        'url'                 => 'https://amiamillionaire.io',
        'description'         => $t['meta_desc_home'],
        'applicationCategory' => 'FinanceApplication',
        'operatingSystem'     => 'Any',
        'offers'              => ['@type' => 'Offer', 'price' => '0', 'priceCurrency' => 'USD'],
        'inLanguage'          => ['pt', 'en'],
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>
    </script>
</head>
<body>

<header class="site-header">
    <div class="header-inner">
        <a href="index.php<?= $langParam ?>" class="logo">🎩 <?= htmlspecialchars($t['site_name']) ?></a>
        <div class="header-right">
            <a href="index.php?lang=<?= $switchLang ?>" class="lang-btn"><?= $switchLabel ?></a>
        </div>
    </div>
</header>

<main class="landing-main">

    <!-- ── HERO + CONVERTER FORM ────────────────────────── -->
    <section class="conv-hero">
        <h1 class="conv-hero-title"><?= htmlspecialchars($t['conv_hero_title']) ?></h1>
        <p class="conv-hero-sub"><?= htmlspecialchars($t['conv_hero_sub']) ?></p>
    </section>

    <div class="conv-form-card">
        <div class="conv-form-body">
            <form method="POST" action="index.php<?= $langParam ?>">
                <div class="conv-row">
                    <div class="form-group">
                        <label class="form-label" for="valor"><?= htmlspecialchars($t['conv_amount']) ?></label>
                        <input class="form-input" type="number" id="valor" name="valor"
                               step="0.01" min="0.01" required
                               placeholder="1000.00"
                               value="<?= $valorForm !== null ? htmlspecialchars($valorForm) : '' ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="moeda"><?= htmlspecialchars($t['conv_currency']) ?></label>
                        <select class="form-select" id="moeda" name="moeda">
                            <?php foreach ($moedas as $m):
                                $nome     = $lang === 'en' ? $m['nome_en'] : $m['nome_pt'];
                                $selected = ($moedaForm === $m['sigla']) ? 'selected' : '';
                                // Pre-select BRL for PT, USD for EN
                                if ($moedaForm === null) {
                                    $defaultSel = ($lang === 'pt' && $m['sigla'] === 'BRL') ||
                                                  ($lang === 'en' && $m['sigla'] === 'USD');
                                    if ($defaultSel) $selected = 'selected';
                                }
                            ?>
                            <option value="<?= htmlspecialchars($m['sigla']) ?>" <?= $selected ?>>
                                <?= htmlspecialchars($m['sigla']) ?> — <?= htmlspecialchars($nome) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn-conv"><?= htmlspecialchars($t['conv_btn']) ?></button>
            </form>
        </div>
    </div>

    <?php if ($hasResults): ?>

        <!-- ── MILLIONAIRE COUNT ───────────────────────── -->
        <section class="count-card" aria-label="Millionaire status">
            <div class="rank-badge"><?= $rankIcon ?> <?= htmlspecialchars($t[$rankKey]) ?></div>
            <p class="count-label"><?= htmlspecialchars($t['conv_result_in']) ?></p>
            <p class="count-number" id="count-num"><?= $countMil ?></p>
            <p class="count-sub"><?= htmlspecialchars($currencyWord) ?></p>
        </section>

        <!-- ── NEXT MILESTONE ─────────────────────────── -->
        <?php if ($proxima): ?>
        <section class="milestone-card">
            <div class="milestone-header">
                <span class="icon">🎯</span>
                <h2><?= htmlspecialchars($t['conv_next']) ?></h2>
            </div>
            <div class="milestone-body">
                <p class="milestone-target-name"><?= htmlspecialchars($proxima['nome']) ?></p>
                <span class="milestone-acronym"><?= htmlspecialchars($proxima['sigla']) ?></span>
                <p class="milestone-amount">
                    + <?= number_format($proxima['falta'], 2, ',', '.') ?>
                    <small style="font-size:0.75rem;color:#999;font-family:'Roboto',sans-serif;">
                        <?= htmlspecialchars($moedaForm) ?>
                    </small>
                </p>
                <p class="milestone-sub"><?= htmlspecialchars($t['dash_missing']) ?> <?= htmlspecialchars($proxima['sigla']) ?></p>
                <div class="progress-track" role="progressbar"
                     aria-valuenow="<?= round($proxima['pct'],1) ?>" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-fill" style="width:<?= max(3, round($proxima['pct'],1)) ?>%"></div>
                </div>
                <div class="progress-meta">
                    <span><?= number_format($proxima['valorAtual'], 0, ',', '.') ?> <?= htmlspecialchars($proxima['sigla']) ?></span>
                    <span><?= number_format($proxima['pct'], 2) ?>% → 1.000.000</span>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <!-- ── CONQUERED CURRENCIES ───────────────────── -->
        <?php if (!empty($milionarias)): ?>
        <p class="section-title">🏆 <?= htmlspecialchars($t['conv_conquered']) ?> (<?= $countMil ?>)</p>
        <div class="currency-grid" role="list">
            <?php foreach ($milionarias as $i => $m): ?>
            <article class="currency-card" role="listitem"
                     title="<?= htmlspecialchars($m['nome']) ?> — <?= number_format($m['valor'], 0, ',', '.') ?>">
                <div class="currency-card-stripe stripe-<?= $i % 8 ?>"></div>
                <div class="currency-card-body">
                    <span class="currency-flag"><?= $m['flag'] ?></span>
                    <span class="currency-country"><?= htmlspecialchars($m['country']) ?></span>
                    <span class="currency-acronym"><?= htmlspecialchars($m['sigla']) ?></span>
                    <span class="currency-amount"><?= htmlspecialchars($m['amount']) ?></span>
                    <span class="currency-badge<?= $m['is_billion'] ? ' billion' : '' ?>">
                        <?= htmlspecialchars($m['is_billion'] ? $t['badge_billion'] : $t['conv_badge']) ?>
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

        <!-- ── CTA: REGISTER ──────────────────────────── -->
        <div class="cta-card">
            <h2>💾 <?= htmlspecialchars($t['conv_save_title']) ?></h2>
            <p><?= htmlspecialchars($t['conv_save_desc']) ?></p>
            <a href="cadastrar.php<?= $langParam ?>" class="btn-cta-gold">
                <?= htmlspecialchars($t['conv_save_btn']) ?>
            </a>
            <a href="login.php<?= $langParam ?>" class="cta-login-link">
                <?= htmlspecialchars($t['conv_login_link']) ?>
            </a>
        </div>

    <?php else: ?>

        <!-- ── HOW IT WORKS (shown before any result) ─── -->
        <div class="how-section">
            <p class="land-section-title">⚙️ <?= htmlspecialchars($t['conv_how_title']) ?></p>
            <div class="steps">
                <div class="step">
                    <div class="step-icon">1</div>
                    <div class="step-content">
                        <h4><?= htmlspecialchars($t['land_step1_title']) ?></h4>
                        <p><?= htmlspecialchars($t['land_step1_desc']) ?></p>
                    </div>
                </div>
                <div class="step">
                    <div class="step-icon">2</div>
                    <div class="step-content">
                        <h4><?= htmlspecialchars($t['land_step2_title']) ?></h4>
                        <p><?= htmlspecialchars($t['land_step2_desc']) ?></p>
                    </div>
                </div>
                <div class="step">
                    <div class="step-icon">3</div>
                    <div class="step-content">
                        <h4><?= htmlspecialchars($t['land_step3_title']) ?></h4>
                        <p><?= htmlspecialchars($t['land_step3_desc']) ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="land-section">
            <div class="why-box">
                <h4>💡 <?= htmlspecialchars($t['land_why_title']) ?></h4>
                <p><?= htmlspecialchars($t['land_why_desc']) ?></p>
            </div>
        </div>

        <div style="text-align:center;padding:4px 0 16px;">
            <a href="cadastrar.php<?= $langParam ?>" class="btn-cta-gold">
                <?= htmlspecialchars($t['conv_save_btn']) ?>
            </a>
            <br>
            <a href="login.php<?= $langParam ?>" class="cta-login-link">
                <?= htmlspecialchars($t['conv_login_link']) ?>
            </a>
        </div>

    <?php endif; ?>

</main>

<footer class="site-footer">
    <p><?= htmlspecialchars($t['footer_copy']) ?></p>
</footer>

<?php if ($hasResults && $countMil > 0): ?>
<script>
(function(){
    const el = document.getElementById('count-num');
    if (!el) return;
    const target = parseInt(el.textContent, 10);
    if (target === 0) return;
    let current = 0;
    const step = Math.max(1, Math.floor(target / 40));
    const timer = setInterval(() => {
        current = Math.min(current + step, target);
        el.textContent = current;
        if (current >= target) clearInterval(timer);
    }, 28);
})();
</script>
<?php endif; ?>

</body>
</html>
