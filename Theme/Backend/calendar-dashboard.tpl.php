<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Template
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

$calendar = $this->data['calendar'];
?>
<div class="row">
    <div class="col-xs-12 col-md-9">
        <div class="box wf-100">
            <ul class="btns lf">
                <li><a href="<?= \phpOMS\Uri\UriFactory::build('calendar/dashboard?date=' . $calendar->date->createModify(0, -1, 0)->format('Y-m-d')); ?>"><i class="g-icon">arrow_back</i></a>
                <li><a href="<?= \phpOMS\Uri\UriFactory::build('calendar/dashboard?date=' . $calendar->date->createModify(0, 1, 0)->format('Y-m-d')); ?>"><i class="g-icon">arrow_forward</i></a>
            </ul>
            <!-- @feature implement different views
            <ul class="btns rf">
                <li><a href=""><?= $this->getHtml('Day'); ?></a>
                <li><a href=""><?= $this->getHtml('Week'); ?></a>
                <li><a href=""><?= $this->getHtml('Month'); ?></a>
                <li><a href=""><?= $this->getHtml('Year'); ?></a>
            </ul>
            -->
        </div>
        <div class="portlet">
            <div id="calendar" class="m-calendar" data-action='[
                {
                    "listener": "click", "selector": "#calendar span.tag", "action": [
                        {"key": 1, "type": "dom.popup", "tpl": "calendar-event-popup-tpl", "aniIn": "fadeIn"}
                    ]
                }
            ]'>
                <ul class="weekdays">
                    <li><?= $this->getHtml('Sunday'); ?>
                    <li><?= $this->getHtml('Monday'); ?>
                    <li><?= $this->getHtml('Tuesday'); ?>
                    <li><?= $this->getHtml('Wednesday'); ?>
                    <li><?= $this->getHtml('Thursday'); ?>
                    <li><?= $this->getHtml('Friday'); ?>
                    <li><?= $this->getHtml('Saturday'); ?>
                </ul>
                <?php $current = $calendar->date->getMonthCalendar(0); $isActiveMonth = false;
                for ($i = 0; $i < 6; ++$i) : ?>
                <ul class="days">
                    <?php for ($j = 0; $j < 7; ++$j) :
                        $isActiveMonth = ((int) $current[$i * 7 + $j]->format('d') === 1) ? !$isActiveMonth : $isActiveMonth;
                    ?>
                        <?php if ($isActiveMonth) :?>
                        <li class="day">
                            <div class="date"><?= $current[$i * 7 + $j]->format('d'); ?></div>
                                <?php else: ?>
                        <li class="day other-month">
                            <div class="date"><?= $current[$i * 7 + $j]->format('d'); ?></div>
                                <?php endif; ?>
                            <?php
                            $events = $calendar->getEventsOnDate($current[$i * 7 + $j]);
                            foreach ($events as $event) : ?>
                                <div id="event-tag-<?= $event->id; ?>" class="event">
                        <div class="event-desc"><?= $this->printHtml($event->getName()); ?></div>
                        <div class="event-time">2:00pm to 5:00pm</div>
                                </div>
                            <?php endforeach; ?>
                        <?php endfor; ?>
                    </li>
                </ul>
                <?php endfor;?>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-md-3">
        <!-- @feature create additional styles -->
        <section class="portlet">
            <div class="portlet-body">
                <form>
                    <select name="layout">
                        <option><?= $this->getHtml('Month'); ?>
                    </select>
                </form>
            </div>
        </section>

        <!-- @todo allow multiple calendars
        <section class="box wf-100">
            <header><h1>Calendars</h1></header>

            <div class="inner">
                <ul class="boxed">
                    <li><i class="g-icon warning">close</i> <span class="check"><input name="cal-0" type="checkbox" id="iDefault" checked><label for="iDefault">Default</label></span><i class="g-icon rf">settings</i>
                </ul>
                <div class="spacer"></div>
                <button><i class="g-icon">calendar_add_on</i> <?= $this->getHtml('Add', '0', '0'); ?></button> <button><i class="g-icon">event_available</i> <?= $this->getHtml('Create', '0', '0'); ?></button>
            </div>
        </section>
        -->
    </div>
</div>

<menu type="context" id="calendar-day-menu">
    <menuitem label="<?= $this->getHtml('NewEvent'); ?>"></menuitem>
</menu>

<menu type="context" id="calendar-event-menu">
    <menuitem label="Edit"></menuitem>
    <menuitem label="Accept" disabled></menuitem>
    <menuitem label="Re-Schedule"></menuitem>
    <menuitem label="Decline"></menuitem>
    <menuitem label="Delete"></menuitem>
</menu>

<?= $this->getData('calendarEventPopup')->render('iCalendarEvent'); ?>