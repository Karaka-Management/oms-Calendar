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

use Modules\Admin\Models\NullAccount;
use Modules\Calendar\Models\Event;
use Modules\Calendar\Models\EventMapper;

/**
 * @internal
 */
#[\PHPUnit\Framework\Attributes\CoversClass(\Modules\Calendar\Models\EventMapper::class)]
final class EventMapperTest extends \PHPUnit\Framework\TestCase
{
    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testCRUD() : void
    {
        $calendarEvent1 = new Event();

        $calendarEvent1->name        = 'Running test';
        $calendarEvent1->description = 'Desc1';
        $calendarEvent1->setCreatedBy(new NullAccount(1));
        $calendarEvent1->schedule->createdBy = new NullAccount(1);
        $calendarEvent1->calendar            = 1;

        $id = EventMapper::create()->execute($calendarEvent1);
        self::assertGreaterThan(0, $calendarEvent1->id);
        self::assertEquals($id, $calendarEvent1->id);

        $eventR = EventMapper::get()->where('id', $calendarEvent1->id)->execute();
        self::assertEquals($calendarEvent1->getCreatedBy()->id, $eventR->getCreatedBy()->id);
        self::assertEquals($calendarEvent1->description, $eventR->description);
    }
}
