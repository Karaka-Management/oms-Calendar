<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\Calendar
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

?>
<div id="calendar-dashboard" class="col-xs-12 col-md-6" draggable="true">
    <section class="portlet">
        <div class="portlet-head"><?= $this->getHtml('Calendar', 'Calendar'); ?></div>
        <?= $this->getData('calendar')->render($this->getData('cal')); ?>
    </section>
</div>
