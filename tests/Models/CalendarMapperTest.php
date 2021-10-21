<?php
/**
 * Orange Management
 *
 * PHP Version 8.0
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Calendar\tests\Models;

use Modules\Admin\Models\NullAccount;
use Modules\Calendar\Models\Calendar;
use Modules\Calendar\Models\CalendarMapper;
use Modules\Calendar\Models\Event;

/**
 * @internal
 */
class CalendarMapperTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\Calendar\Models\CalendarMapper
     * @group module
     */
    public function testCR() : void
    {
        $calendar = new Calendar();

        $calendar->name        = 'Title';
        $calendar->description = 'Description';

        $calendarEvent1              = new Event();
        $calendarEvent1->name        = 'Running test';
        $calendarEvent1->description = 'Desc1';
        $calendarEvent1->setCreatedBy(new NullAccount(1));
        $calendarEvent1->schedule->createdBy = new NullAccount(1);
        $calendar->addEvent($calendarEvent1);

        $calendarEvent2              = new Event();
        $calendarEvent2->name        = 'Running test2';
        $calendarEvent2->description = 'Desc2';
        $calendarEvent2->setCreatedBy(new NullAccount(1));
        $calendarEvent2->schedule->createdBy = new NullAccount(1);
        $calendar->addEvent($calendarEvent2);

        $id = CalendarMapper::create($calendar);
        self::assertGreaterThan(0, $calendar->getId());
        self::assertEquals($id, $calendar->getId());

        $calendarR = CalendarMapper::get($calendar->getId());
        self::assertEquals($calendar->createdAt->format('Y-m-d'), $calendarR->createdAt->format('Y-m-d'));
        self::assertEquals($calendar->description, $calendarR->description);
        self::assertEquals($calendar->name, $calendarR->name);

        $expected = $calendar->getEvents();
        $actual   = $calendarR->getEvents();

        self::assertEquals(\end($expected)->description, \end($actual)->description);
    }
}
