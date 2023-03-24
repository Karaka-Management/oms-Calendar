<?php
/**
 * Karaka
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

use Modules\Calendar\Models\NullSchedule;

/**
 * @internal
 */
final class NullScheduleTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\Calendar\Models\NullSchedule
     * @group framework
     */
    public function testNull() : void
    {
        self::assertInstanceOf('\Modules\Calendar\Models\Schedule', new NullSchedule());
    }

    /**
     * @covers Modules\Calendar\Models\NullSchedule
     * @group framework
     */
    public function testId() : void
    {
        $null = new NullSchedule(2);
        self::assertEquals(2, $null->getId());
    }
}
