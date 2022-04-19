<?php
/**
 * Karaka
 *
 * PHP Version 8.1
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://karaka.app
 */
declare(strict_types=1);

namespace Modules\Calendar\tests\Models;

use Modules\Calendar\Models\NullCalendar;

/**
 * @internal
 */
final class NullCalendarTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\Calendar\Models\NullCalendar
     * @group framework
     */
    public function testNull() : void
    {
        self::assertInstanceOf('\Modules\Calendar\Models\Calendar', new NullCalendar());
    }

    /**
     * @covers Modules\Calendar\Models\NullCalendar
     * @group framework
     */
    public function testId() : void
    {
        $null = new NullCalendar(2);
        self::assertEquals(2, $null->getId());
    }
}
