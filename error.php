<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.bionic_world
 *
 * @copyright   Copyright (C) 2024 Bionic World. All rights reserved.
 * @license     GNU General Public License version 2 or later
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;

$app = Factory::getApplication();
$wa  = $this->getWebAssetManager();

// Template-Parameter
$params = $app->getTemplate(true)->params;
$sitename = $app->get('sitename');

// Assets
$wa->useStyle('template.bionic_world');

// Viewport
$this->setMetaData('viewport', 'width=device-width, initial-scale=1');
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
    <jdoc:include type="metas" />
    <jdoc:include type="styles" />
    <jdoc:include type="scripts" />
</head>
<body class="error-page">
    
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="nav-container">
                <a href="<?php echo Uri::base(); ?>" class="logo">
                    <div class="logo-icon">B</div>
                    <span><?php echo htmlspecialchars($sitename); ?></span>
                </a>
            </div>
        </div>
    </header>

    <!-- Error Content -->
    <main class="main-content error-content">
        <div class="container">
            <div class="error-box">
                <div class="error-icon">
                    <?php if ($this->error->getCode() == 404) : ?>
                        <span style="font-size: 5rem;">🔍</span>
                    <?php else : ?>
                        <span style="font-size: 5rem;">⚠️</span>
                    <?php endif; ?>
                </div>
                
                <h1 class="error-title">
                    <?php echo $this->error->getCode(); ?> - 
                    <?php if ($this->error->getCode() == 404) : ?>
                        <?php echo Text::_('JERROR_LAYOUT_PAGE_NOT_FOUND'); ?>
                    <?php else : ?>
                        <?php echo Text::_('JERROR_LAYOUT_ERROR_HAS_OCCURRED_WHILE_PROCESSING_YOUR_REQUEST'); ?>
                    <?php endif; ?>
                </h1>
                
                <p class="error-message">
                    <?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8'); ?>
                </p>
                
                <div class="error-actions">
                    <a href="<?php echo Uri::base(); ?>" class="btn btn-primary">
                        <?php echo Text::_('JERROR_LAYOUT_GO_TO_THE_HOME_PAGE'); ?>
                    </a>
                    <a href="javascript:history.back()" class="btn btn-secondary">
                        <?php echo Text::_('JERROR_LAYOUT_RETURN_TO_THE_PREVIOUS_PAGE'); ?>
                    </a>
                </div>
            </div>
        </div>
    </main>

    <style>
        .error-content {
            min-height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 20px;
        }
        
        .error-box {
            text-align: center;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .error-icon {
            margin-bottom: 30px;
        }
        
        .error-title {
            font-size: 2rem;
            margin-bottom: 20px;
            color: var(--text-dark);
        }
        
        .error-message {
            font-size: 1.1rem;
            margin-bottom: 30px;
            color: var(--text-light);
        }
        
        .error-actions {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .btn-secondary {
            background: var(--text-light);
        }
        
        .btn-secondary:hover {
            background: var(--text-dark);
        }
    </style>
</body>
</html>
