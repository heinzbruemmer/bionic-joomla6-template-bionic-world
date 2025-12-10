<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Uri\Uri;

/** @var Joomla\CMS\Document\HtmlDocument $this */

$app = Factory::getApplication();
$wa  = $this->getWebAssetManager();

// Load template assets
$wa->registerAndUseStyle('template.bionic_world', 'template.css', [], [], []);
$wa->registerAndUseScript('template.bionic_world', 'mobile-menu.js', [], ['defer' => true], []);
$wa->registerAndUseScript('template.bionic_world.faq', 'faq.js', [], ['defer' => true], []);
$wa->registerAndUseScript('template.bionic_world.tables', 'responsive-tables.js', [], ['defer' => true], []);

// Get template params
$params = $app->getTemplate(true)->params;
$logo = $params->get('logo');
$sitename = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');

// Get current language
$lang = Factory::getLanguage();
$currentLang = $lang->getTag();
$isGerman = (strpos($currentLang, 'de') === 0);
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
    <jdoc:include type="metas" />
    <jdoc:include type="styles" />
    <jdoc:include type="scripts" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="site <?php echo $this->direction === 'rtl' ? 'rtl' : 'ltr'; ?>">

    <!-- Header -->
    <header class="header">
        <!-- Top Bar with new top-middle-right position -->
        <?php if ($this->countModules('top-bar') || $this->countModules('top-middle-right')): ?>
        <div class="top-bar">
            <div class="container">
                <div class="top-bar-content">
                    <!-- Top Bar Text Position -->
                    <div class="top-bar-left">
                        <jdoc:include type="modules" name="top-bar" style="none" />
                    </div>
                    
                    <!-- Language Switcher Position -->
                    <div class="top-bar-right">
                        <jdoc:include type="modules" name="top-middle-right" style="none" />
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Main Navigation -->
        <div class="container">
            <div class="nav-container">
                <!-- Logo -->
                <a href="<?php echo Uri::base(); ?>" class="logo">
                    <?php if ($logo): ?>
                        <img src="<?php echo Uri::root() . htmlspecialchars($logo, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo $sitename; ?>">
                    <?php else: ?>
                        <div class="logo-icon">B</div>
                        <span><?php echo $sitename; ?></span>
                    <?php endif; ?>
                </a>
                
                <!-- Navigation Menu -->
                <nav>
                    <jdoc:include type="modules" name="navigation" style="none" />
                </nav>
            </div>
        </div>
    </header>

    <!-- Breadcrumbs -->
    <?php if ($this->countModules('breadcrumbs')): ?>
    <section class="breadcrumbs-section">
        <div class="container">
            <jdoc:include type="modules" name="breadcrumbs" style="none" />
        </div>
    </section>
    <?php endif; ?>

    <?php
    // Prüfe ob es eine Artikelansicht ist
    $option = $app->input->getCmd('option', '');
    $view = $app->input->getCmd('view', '');
    $isArticleView = ($option == 'com_content' && $view == 'article');
    ?>
    
    <!-- Hero Section - nur auf Homepage, nicht bei Einzelartikeln -->
    <?php if ($this->countModules('hero') && !$isArticleView): ?>
    <section class="hero">
        <div class="hero-content">
            <jdoc:include type="modules" name="hero" style="none" />
        </div>
    </section>
    <?php endif; ?>

    <!-- Stats Section - nur auf Homepage, nicht bei Einzelartikeln -->
    <?php if ($this->countModules('stats') && !$isArticleView): ?>
    <section class="stats">
        <div class="container">
            <jdoc:include type="modules" name="stats" style="none" />
        </div>
    </section>
    <?php endif; ?>

    <!-- Welcome Section - nur auf Homepage, nicht bei Einzelartikeln -->
    <?php if ($this->countModules('welcome') && !$isArticleView): ?>
    <section class="welcome">
        <div class="container">
            <jdoc:include type="modules" name="welcome" style="none" />
        </div>
    </section>
    <?php endif; ?>

    <!-- Technologies Section - nur auf Homepage, nicht bei Einzelartikeln -->
    <?php if ($this->countModules('technologies') && !$isArticleView): ?>
    <section class="technologies">
        <div class="container">
            <jdoc:include type="modules" name="technologies" style="none" />
        </div>
    </section>
    <?php endif; ?>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <jdoc:include type="message" />
            <jdoc:include type="component" />
        </div>
    </main>

    <!-- Main Bottom Section (9 Technologien) - nur auf Homepage, nicht bei Einzelartikeln -->
    <?php if ($this->countModules('main-bottom') && !$isArticleView): ?>
    <section class="main-bottom">
        <div class="container">
            <jdoc:include type="modules" name="main-bottom" style="none" />
        </div>
    </section>
    <?php endif; ?>

    <!-- Highlight Section (NACH main-bottom!) - nur auf Homepage, nicht bei Einzelartikeln -->
    <?php if ($this->countModules('highlight') && !$isArticleView): ?>
    <section class="highlight">
        <div class="container">
            <jdoc:include type="modules" name="highlight" style="none" />
        </div>
    </section>
    <?php endif; ?>

    <!-- Sidebar Right (if needed) -->
    <?php if ($this->countModules('sidebar-right')): ?>
    <aside class="sidebar-right">
        <div class="container">
            <jdoc:include type="modules" name="sidebar-right" style="none" />
        </div>
    </aside>
    <?php endif; ?>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <jdoc:include type="modules" name="footer1" style="none" />
                </div>
                <div class="footer-col">
                    <jdoc:include type="modules" name="footer2" style="none" />
                </div>
                <div class="footer-col">
                    <jdoc:include type="modules" name="footer3" style="none" />
                </div>
                <div class="footer-col">
                    <jdoc:include type="modules" name="footer4" style="none" />
                </div>
            </div>
            
            <!-- Footer Bottom - nur über Module gesteuert -->
            <?php if ($this->countModules('auto-bottom')): ?>
            <div class="footer-bottom">
                <jdoc:include type="modules" name="auto-bottom" style="none" />
            </div>
            <?php endif; ?>
        </div>
    </footer>

    <jdoc:include type="modules" name="debug" style="none" />

</body>
</html>
