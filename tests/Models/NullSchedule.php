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

use Modules\Calendar\Models\NullSchedule;

/**
 * @internal
 */
final class Null extends \PHPUnit\Framework\TestCase
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
