<?php
session_start();
if (isset($_GET['lang']) && in_array($_GET['lang'], ['pt','en'])) {
    $_SESSION['lang'] = $_GET['lang'];
}
$lang = $_SESSION['lang'] ?? 'pt';
include "lang.php";

// Redirect authenticated users straight to their dashboard
if (isset($_SESSION['id'])) {
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($t['site_name']) ?> — <?= htmlspecialchars($t['tagline']) ?></title>
    <meta name="description" content="<?= htmlspecialchars($t['meta_desc_home']) ?>">
    <meta name="keywords" content="millionaire calculator, currency millionaire, am i a millionaire, wealth tracker, financial reserve, sou milionario, milionario moedas">
    <meta name="robots" content="index, follow">
    <meta property="og:title"       content="<?= htmlspecialchars($t['site_name']) ?> — <?= htmlspecialchars($t['tagline']) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($t['meta_desc_home']) ?>">
    <meta property="og:type"        content="website">
    <meta property="og:image"       content="assets/og-image.png">
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="<?= htmlspecialchars($t['site_name']) ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($t['meta_desc_home']) ?>">
    <link rel="canonical"     href="https://amiamillionaire.io/">
    <link rel="alternate" hreflang="pt" href="index.php?lang=pt">
    <link rel="alternate" hreflang="en" href="index.php?lang=en">
    <link rel="alternate" hreflang="x-default" href="index.php">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Oswald:wght@400;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Structured data: WebApplication -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebApplication",
      "name": "Am I A Millionaire?",
      "alternateName": "Sou Milionário?",
      "url": "https://amiamillionaire.io",
      "description": "<?= addslashes($t['meta_desc_home']) ?>",
      "applicationCategory": "FinanceApplication",
      "operatingSystem": "Any",
      "offers": { "@type": "Offer", "price": "0", "priceCurrency": "USD" },
      "inLanguage": ["pt","en"]
    }
    </script>
</head>
<body>
<header class="site-header">
    <div class="header-inner">
        <a href="index.php" class="logo">🎩 <?= htmlspecialchars($t['site_name']) ?></a>
        <div class="header-right">
            <a href="index.php?lang=<?= $switchLang ?>" class="lang-btn"><?= $switchLabel ?></a>
        </div>
    </div>
</header>

<main class="landing-main">

    <!-- HERO -->
    <section class="land-hero">
        <h1 class="land-hero-title"><?= htmlspecialchars($t['land_hero']) ?></h1>
        <p class="land-hero-sub"><?= htmlspecialchars($t['land_subhero']) ?></p>
        <a href="cadastrar.php<?= $langParam ?>" class="btn-cta"><?= htmlspecialchars($t['land_cta']) ?></a>
        <a href="login.php<?= $langParam ?>" class="land-login-link"><?= htmlspecialchars($t['land_login']) ?></a>
    </section>

    <!-- HOW IT WORKS -->
    <div class="land-section">
        <p class="land-section-title">⚙️ <?= htmlspecialchars($t['land_how_title']) ?></p>
        <div class="steps">
            <div class="step">
                <div class="step-icon">1</div>
                <div class="step-content">
                    <h3><?= htmlspecialchars($t['land_step1_title']) ?></h3>
                    <p><?= htmlspecialchars($t['land_step1_desc']) ?></p>
                </div>
            </div>
            <div class="step">
                <div class="step-icon">2</div>
                <div class="step-content">
                    <h3><?= htmlspecialchars($t['land_step2_title']) ?></h3>
                    <p><?= htmlspecialchars($t['land_step2_desc']) ?></p>
                </div>
            </div>
            <div class="step">
                <div class="step-icon">3</div>
                <div class="step-content">
                    <h3><?= htmlspecialchars($t['land_step3_title']) ?></h3>
                    <p><?= htmlspecialchars($t['land_step3_desc']) ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- WHY IT MATTERS -->
    <div class="land-section">
        <div class="why-box">
            <h4>💡 <?= htmlspecialchars($t['land_why_title']) ?></h4>
            <p><?= htmlspecialchars($t['land_why_desc']) ?></p>
        </div>
    </div>

    <!-- FINAL CTA -->
    <div style="text-align:center;padding:8px 0 16px;">
        <a href="cadastrar.php<?= $langParam ?>" class="btn-cta"><?= htmlspecialchars($t['land_cta']) ?></a>
    </div>

</main>

<footer class="site-footer">
    <p><?= htmlspecialchars($t['footer_copy']) ?></p>
</footer>
</body>
</html>
