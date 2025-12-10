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
use Joomla\CMS\Uri\Uri;

$app = Factory::getApplication();
$wa  = $this->getWebAssetManager();

// Assets registrieren
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
<body class="contentpane component">
    <jdoc:include type="message" />
    <jdoc:include type="component" />
</body>
</html>
