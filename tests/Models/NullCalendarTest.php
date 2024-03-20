<?php
/**
 * Jingga
 *
 * PHP Version 8.1
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
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
     * @covers \Modules\Calendar\Models\NullCalendar
     * @group module
     */
    public function testNull() : void
    {
        self::assertInstanceOf('\Modules\Calendar\Models\Calendar', new NullCalendar());
    }

    /**
     * @covers \Modules\Calendar\Models\NullCalendar
     * @group module
     */
    public function testId() : void
    {
        $null = new NullCalendar(2);
        self::assertEquals(2, $null->id);
    }

    /**
     * @covers \Modules\Calendar\Models\NullCalendar
     * @group module
     */
    public function testJsonSerialize() : void
    {
        $null = new NullCalendar(2);
        self::assertEquals(['id' => 2], $null->jsonSerialize());
    }
}
