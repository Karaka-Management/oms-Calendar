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

use Modules\Admin\Models\Account;
use Modules\Admin\Models\NullAccount;
use Modules\Calendar\Models\Event;

/**
 * @internal
 */
class EventTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\Calendar\Models\Event
     * @group module
     */
    public function testDefault() : void
    {
        $event = new Event();

        self::assertEquals(0, $event->getId());
        self::assertEquals(0, $event->getCreatedBy()->getId());
        self::assertEquals('', $event->name);
        self::assertEquals((new \DateTime('now'))->format('Y-m-d'), $event->createdAt->format('Y-m-d'));
        self::assertEquals('', $event->description);
        self::assertEquals([], $event->getPeople());
        self::assertInstanceOf('\Modules\Admin\Models\NullAccount', $event->getPerson(1));
        self::assertInstanceOf('\phpOMS\Stdlib\Base\Location', $event->getLocation());
    }

    /**
     * @covers Modules\Calendar\Models\Event
     * @group module
     */
    public function testSetGet() : void
    {
        $event = new Event();

        $event->setCreatedBy(new NullAccount(1));
        self::assertEquals(1, $event->getCreatedBy()->getId());

        $event->name = 'Name';
        self::assertEquals('Name', $event->name);

        $event->description = 'Description';
        self::assertEquals('Description', $event->description);

        $event->addPerson(new Account());
        $event->addPerson(new Account());
        $success = $event->removePerson(99);

        self::assertFalse($success);

        $success = $event->removePerson(0);
        self::assertTrue($success);
    }
}
