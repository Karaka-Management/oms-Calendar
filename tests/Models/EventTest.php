<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.2
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Calendar\tests\Models;

use Modules\Admin\Models\Account;
use Modules\Admin\Models\NullAccount;
use Modules\Calendar\Models\Event;
use Modules\Calendar\Models\EventStatus;
use Modules\Calendar\Models\EventType;

/**
 * @internal
 */
#[\PHPUnit\Framework\Attributes\CoversClass(\Modules\Calendar\Models\Event::class)]
final class EventTest extends \PHPUnit\Framework\TestCase
{
    private Event $event;

    /**
     * {@inheritdoc}
     */
    protected function setUp() : void
    {
        $this->event = new Event();
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testDefault() : void
    {
        self::assertEquals(0, $this->event->id);
        self::assertEquals(0, $this->event->getCreatedBy()->id);
        self::assertEquals('', $this->event->name);
        self::assertEquals((new \DateTime('now'))->format('Y-m-d'), $this->event->createdAt->format('Y-m-d'));
        self::assertEquals('', $this->event->description);
        self::assertEquals([], $this->event->getPeople());
        self::assertInstanceOf('\Modules\Admin\Models\NullAccount', $this->event->getPerson(1));
        self::assertInstanceOf('\phpOMS\Stdlib\Base\Location', $this->event->location);
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testCreatedByInputOutput() : void
    {
        $this->event->setCreatedBy(new NullAccount(1));
        self::assertEquals(1, $this->event->getCreatedBy()->id);
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testCalendarInputOutput() : void
    {
        $this->event->calendar = 99;
        self::assertEquals(99, $this->event->calendar);
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testNameInputOutput() : void
    {
        $this->event->name = 'Name';
        self::assertEquals('Name', $this->event->name);
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testDescriptionInputOutput() : void
    {
        $this->event->description = 'Description';
        self::assertEquals('Description', $this->event->description);
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testPersonInputOutput() : void
    {
        $this->event->addPerson(new Account());
        self::assertCount(1, $this->event->getPeople());
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testPersonRemove() : void
    {
        $this->event->addPerson(new Account());
        $this->event->addPerson(new Account());
        $success = $this->event->removePerson(99);

        self::assertFalse($success);

        $success = $this->event->removePerson(0);
        self::assertTrue($success);
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testSerialize() : void
    {
        $this->event->name        = 'Name';
        $this->event->description = 'Description';
        $this->event->type        = EventType::TEMPLATE;
        $this->event->status      = EventStatus::INACTIVE;

        $serialized = $this->event->jsonSerialize();
        unset($serialized['location']);
        unset($serialized['schedule']);
        unset($serialized['createdAt']);

        self::assertEquals(
            [
                'id'          => 0,
                'name'        => 'Name',
                'description' => 'Description',
                'type'        => EventType::TEMPLATE,
                'status'      => EventStatus::INACTIVE,
                'calendar'    => 0,
                'people'      => [],
                'tags'        => [],
            ],
            $serialized
        );
    }
}
