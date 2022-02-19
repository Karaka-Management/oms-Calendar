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

use Modules\Calendar\Models\NullEvent;

/**
 * @internal
 */
final class NullEventTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\Calendar\Models\NullEvent
     * @group framework
     */
    public function testNull() : void
    {
        self::assertInstanceOf('\Modules\Calendar\Models\Event', new NullEvent());
    }

    /**
     * @covers Modules\Calendar\Models\NullEvent
     * @group framework
     */
    public function testId() : void
    {
        $null = new NullEvent(2);
        self::assertEquals(2, $null->getId());
    }
}
