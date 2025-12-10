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
<div class="stats-grid">
    <div class="stat-item moduletable<?php echo htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_COMPAT, 'UTF-8'); ?>">
        <?php if ($module->showtitle) : ?>
            <div class="stat-number"><?php echo $module->title; ?></div>
        <?php endif; ?>
        <div class="stat-label">
            <?php echo $module->content; ?>
        </div>
    </div>
</div>
