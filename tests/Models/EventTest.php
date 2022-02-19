<?php
/**
 * Karaka
 *
 * PHP Version 8.0
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://karaka.app
 */
declare(strict_types=1);

namespace Modules\Calendar\tests\Models;

use Modules\Admin\Models\Account;
use Modules\Admin\Models\NullAccount;
use Modules\Calendar\Models\Event;
use Modules\Calendar\Models\EventStatus;
use Modules\Calendar\Models\EventType;
use Modules\Tag\Models\Tag;

/**
 * @internal
 */
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

    /**
     * @covers Modules\Calendar\Models\Event
     * @group module
     */
    public function testDefault() : void
    {
        self::assertEquals(0, $this->event->getId());
        self::assertEquals(0, $this->event->getCreatedBy()->getId());
        self::assertEquals('', $this->event->name);
        self::assertEquals((new \DateTime('now'))->format('Y-m-d'), $this->event->createdAt->format('Y-m-d'));
        self::assertEquals('', $this->event->description);
        self::assertEquals([], $this->event->getPeople());
        self::assertInstanceOf('\Modules\Admin\Models\NullAccount', $this->event->getPerson(1));
        self::assertInstanceOf('\phpOMS\Stdlib\Base\Location', $this->event->location);
    }

    /**
     * @covers Modules\Calendar\Models\Event
     * @group module
     */
    public function testCreatedByInputOutput() : void
    {
        $this->event->setCreatedBy(new NullAccount(1));
        self::assertEquals(1, $this->event->getCreatedBy()->getId());
    }

    /**
     * @covers Modules\Calendar\Models\Event
     * @group module
     */
    public function testCalendarInputOutput() : void
    {
        $this->event->calendar = 99;
        self::assertEquals(99, $this->event->calendar);
    }

    /**
     * @covers Modules\Calendar\Models\Event
     * @group module
     */
    public function testNameInputOutput() : void
    {
        $this->event->name = 'Name';
        self::assertEquals('Name', $this->event->name);
    }

    /**
     * @covers Modules\Calendar\Models\Event
     * @group module
     */
    public function testDescriptionInputOutput() : void
    {
        $this->event->description = 'Description';
        self::assertEquals('Description', $this->event->description);
    }

    /**
     * @covers Modules\Calendar\Models\Event
     * @group module
     */
    public function testPersonInputOutput() : void
    {
        $this->event->addPerson(new Account());
        self::assertCount(1, $this->event->getPeople());
    }

    /**
     * @covers Modules\Calendar\Models\Event
     * @group module
     */
    public function testPersonRemove() : void
    {
        $this->event->addPerson(new Account());
        $this->event->addPerson(new Account());
        $success = $this->event->removePerson(99);

        self::assertFalse($success);

        $success = $this->event->removePerson(0);
        self::assertTrue($success);
    }

    /**
     * @covers Modules\Calendar\Models\Event
     * @group module
     */
    public function testTypeInputOutput() : void
    {
        $this->event->setType(EventType::TEMPLATE);
        self::assertEquals(EventType::TEMPLATE, $this->event->getType());
    }

    /**
     * @covers Modules\Calendar\Models\Event
     * @group module
     */
    public function testStatusInputOutput() : void
    {
        $this->event->setStatus(EventStatus::INACTIVE);
        self::assertEquals(EventStatus::INACTIVE, $this->event->getStatus());
    }

    /**
     * @covers Modules\Calendar\Models\Event
     * @group module
     */
    public function testTagInputOutput() : void
    {
        $tag = new Tag();
        $tag->setL11n('Tag');

        $this->event->addTag($tag);
        self::assertEquals($tag, $this->event->getTag(0));
        self::assertCount(1, $this->event->getTags());
    }

    /**
     * @covers Modules\Calendar\Models\Event
     * @group module
     */
    public function testTagRemove() : void
    {
        $tag = new Tag();
        $tag->setL11n('Tag');

        $this->event->addTag($tag);
        self::assertTrue($this->event->removeTag(0));
        self::assertCount(0, $this->event->getTags());
        self::assertFalse($this->event->removeTag(0));
    }

    /**
     * @covers Modules\Calendar\Models\Event
     * @group module
     */
    public function testSerialize() : void
    {
        $this->event->name        = 'Name';
        $this->event->description = 'Description';
        $this->event->setType(EventType::TEMPLATE);
        $this->event->setStatus(EventStatus::INACTIVE);

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
