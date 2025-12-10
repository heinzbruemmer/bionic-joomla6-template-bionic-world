<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.bionic_world
 *
 * @copyright   Copyright (C) 2024 Bionic World. All rights reserved.
 * @license     GNU General Public License version 2 or later
 */

defined('_JEXEC') or die;
?>
<div class="tech-grid">
    <div class="tech-card moduletable<?php echo htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8'); ?>">
        <?php if ($module->showtitle) : ?>
            <div class="tech-icon">⚡</div>
            <h3><?php echo $module->title; ?></h3>
        <?php endif; ?>
        <div class="tech-content">
            <?php echo $module->content; ?>
        </div>
    </div>
</div>
