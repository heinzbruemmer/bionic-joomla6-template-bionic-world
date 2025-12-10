<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.bionic_world
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Html\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
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

// Korrekter Namespace für Joomla 6
$twofactormethods = method_exists('Joomla\CMS\Helper\AuthenticationHelper', 'getTwoFactorMethods') 
    ? \Joomla\CMS\Helper\AuthenticationHelper::getTwoFactorMethods() 
    : [];
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
    <jdoc:include type="metas" />
    <jdoc:include type="styles" />
    <jdoc:include type="scripts" />
</head>

<body class="offline-page">
    
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

    <!-- Offline Content -->
    <main class="main-content offline-content">
        <div class="container">
            <div class="offline-box">
                <div class="offline-icon">
                    <span style="font-size: 5rem;">🔧</span>
                </div>
                
                <h1 class="offline-title">
                    <?php echo Text::_('JOFFLINE_MESSAGE'); ?>
                </h1>
                
                <?php if ($app->get('offline_message')) : ?>
                <p class="offline-message">
                    <?php echo $app->get('offline_message'); ?>
                </p>
                <?php else : ?>
                <p class="offline-message">
                    Diese Website befindet sich im Wartungsmodus. Bitte versuchen Sie es später erneut.
                </p>
                <?php endif; ?>
                
                <!-- Login-Formular für Administratoren -->
                <div class="offline-login">
                    <h2><?php echo Text::_('JLOGIN'); ?></h2>
                    <jdoc:include type="message" />
                    
                    <form action="<?php echo Route::_('index.php', true); ?>" method="post" id="form-login">
                        <fieldset class="login-fields">
                            <div class="form-group">
                                <label for="username"><?php echo Text::_('JGLOBAL_USERNAME'); ?></label>
                                <input 
                                    name="username" 
                                    id="username" 
                                    type="text" 
                                    class="form-control" 
                                    required 
                                    autofocus
                                    autocomplete="username"
                                >
                            </div>
                            
                            <div class="form-group">
                                <label for="password"><?php echo Text::_('JGLOBAL_PASSWORD'); ?></label>
                                <input 
                                    type="password" 
                                    name="password" 
                                    id="password" 
                                    class="form-control" 
                                    required
                                    autocomplete="current-password"
                                >
                            </div>
                            
                            <?php if (count($twofactormethods) > 1) : ?>
                            <div class="form-group">
                                <label for="secretkey"><?php echo Text::_('JGLOBAL_SECRETKEY'); ?></label>
                                <input 
                                    type="text" 
                                    name="secretkey" 
                                    id="secretkey" 
                                    class="form-control"
                                    autocomplete="one-time-code"
                                >
                            </div>
                            <?php endif; ?>
                            
                            <div class="form-group">
                                <button type="submit" name="Submit" class="btn btn-primary">
                                    <?php echo Text::_('JLOGIN'); ?>
                                </button>
                            </div>
                            
                            <input type="hidden" name="option" value="com_users">
                            <input type="hidden" name="task" value="user.login">
                            <input type="hidden" name="return" value="<?php echo base64_encode(Uri::base()); ?>">
                            <?php echo HTMLHelper::_('form.token'); ?>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <style>
        .offline-content {
            min-height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 20px;
        }
        
        .offline-box {
            text-align: center;
            max-width: 500px;
            margin: 0 auto;
        }
        
        .offline-icon {
            margin-bottom: 30px;
        }
        
        .offline-title {
            font-size: 2rem;
            margin-bottom: 20px;
            color: var(--text-dark);
        }
        
        .offline-message {
            font-size: 1.1rem;
            margin-bottom: 40px;
            color: var(--text-light);
        }
        
        .offline-login {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            text-align: left;
        }
        
        .offline-login h2 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .login-fields {
            border: none;
            padding: 0;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }
    </style>
</body>
</html>