<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Calendar\tests\Models;

use Modules\Calendar\Models\Calendar;
use Modules\Calendar\Models\Event;

/**
 * @internal
 */
#[\PHPUnit\Framework\Attributes\CoversClass(\Modules\Calendar\Models\Calendar::class)]
final class CalendarTest extends \PHPUnit\Framework\TestCase
{
    private Calendar $calendar;

    /**
     * {@inheritdoc}
     */
    protected function setUp() : void
    {
        $this->calendar = new Calendar();
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testDefault() : void
    {
        self::assertEquals(0, $this->calendar->id);
        self::assertEquals('', $this->calendar->name);
        self::assertEquals((new \DateTime('now'))->format('Y-m-d'), $this->calendar->createdAt->format('Y-m-d'));
        self::assertEquals((new \DateTime('now'))->format('Y-m-d'), $this->calendar->date->format('Y-m-d'));
        self::assertEquals('', $this->calendar->description);
        self::assertEquals([], $this->calendar->getEvents());
        self::assertInstanceOf('\Modules\Calendar\Models\NullEvent', $this->calendar->getEvent(0));
        self::assertFalse($this->calendar->hasEventOnDate(new \DateTime('now')));
        self::assertEquals([], $this->calendar->getEventsOnDate(new \DateTime('now')));
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testDateInputOutput() : void
    {
        $this->calendar->date = new \DateTime('2000-05-05');
        self::assertEquals('2000-05-05', $this->calendar->date->format('Y-m-d'));
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testTitleInputOutput() : void
    {
        $this->calendar->name = 'Title';
        self::assertEquals('Title', $this->calendar->name);
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testDescriptionInputOutput() : void
    {
        $this->calendar->description = 'Description';
        self::assertEquals('Description', $this->calendar->description);
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testEventInputOutput() : void
    {
        $id   = [];
        $id[] = $this->calendar->addEvent(new Event());

        self::assertEquals(0, $this->calendar->getEvents()[0]->id);
        self::assertEquals(0, $this->calendar->getEvent(0)->id);
        self::assertInstanceOf('\Modules\Calendar\Models\Event', $this->calendar->getEvent(1));
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testEventRemove() : void
    {
        $id      = [];
        $id[]    = $this->calendar->addEvent(new Event());
        $id[]    = $this->calendar->addEvent(new Event());
        $success = $this->calendar->removeEvent(99);

        self::assertFalse($success);

        $success = $this->calendar->removeEvent($id[1]);
        self::assertTrue($success);
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testHasEventOnDate() : void
    {
        $event                  = new Event();
        $event->schedule->start = new \DateTime('2005-10-09');

        $this->calendar->addEvent($event);
        self::assertFalse($this->calendar->hasEventOnDate(new \DateTime('2005-10-10')));
        self::assertTrue($this->calendar->hasEventOnDate(new \DateTime('2005-10-09')));
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testGetEventsOnDate() : void
    {
        $event                  = new Event();
        $event->name            = 'Test';
        $event->schedule->start = new \DateTime('2005-10-09');

        $this->calendar->addEvent($event);
        self::assertEquals([], $this->calendar->getEventsOnDate(new \DateTime('2005-10-10')));
        self::assertEquals([$event], $this->calendar->getEventsOnDate(new \DateTime('2005-10-09')));
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testSerialize() : void
    {
        $this->calendar->name        = 'Name';
        $this->calendar->description = 'Description';

        $serialized = $this->calendar->jsonSerialize();
        unset($serialized['createdAt']);

        self::assertEquals(
            [
                'id'          => 0,
                'name'        => 'Name',
                'description' => 'Description',
            ],
            $serialized
        );
    }
}
