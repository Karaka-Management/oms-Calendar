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
use Modules\Calendar\Models\Schedule;
use Modules\Calendar\Models\ScheduleStatus;
use Modules\Calendar\Models\FrequencyType;
use Modules\Calendar\Models\FrequencyInterval;
use Modules\Calendar\Models\FrequencyRelative;
use Modules\Calendar\Models\IntervalType;

/**
 * @internal
 */
final class ScheduleTest extends \PHPUnit\Framework\TestCase
{
    private Schedule $schedule;

    /**
     * {@inheritdoc}
     */
    protected function setUp() : void
    {
        $this->schedule = new Schedule();
    }

    /**
     * @covers Modules\Calendar\Models\Schedule
     * @group module
     */
    public function testDefault() : void
    {
        self::assertEquals(0, $this->schedule->getId());
        self::assertEquals(ScheduleStatus::ACTIVE, $this->schedule->getStatus());
        self::assertEquals(FrequencyType::ONCE, $this->schedule->getFreqType());
        self::assertEquals(IntervalType::ABSOLUTE, $this->schedule->getIntervalType());
        self::assertEquals(FrequencyRelative::FIRST, $this->schedule->getFrequencyRelative());
        self::assertEquals(FrequencyInterval::DAY, $this->schedule->getFreqInterval());
        self::assertInstanceOf('\Modules\Admin\Models\NullAccount', $this->schedule->createdBy);
    }

    /**
     * @covers Modules\Calendar\Models\Schedule
     * @group module
     */
    public function testStatusInputOutput() : void
    {
        $this->schedule->setStatus(ScheduleStatus::INACTIVE);
        self::assertEquals(ScheduleStatus::INACTIVE, $this->schedule->getStatus());
    }

    /**
     * @covers Modules\Calendar\Models\Schedule
     * @group module
     */
    public function testInvalidStatus() : void
    {
        $this->expectException(\phpOMS\Stdlib\Base\Exception\InvalidEnumValue::class);
        $this->schedule->setStatus(999);
    }

    /**
     * @covers Modules\Calendar\Models\Schedule
     * @group module
     */
    public function testFreqIntervalInputOutput() : void
    {
        $this->schedule->setFreqInterval(FrequencyInterval::DAY);
        self::assertEquals(FrequencyInterval::DAY, $this->schedule->getFreqInterval());
    }

    /**
     * @covers Modules\Calendar\Models\Schedule
     * @group module
     */
    public function testInvalidFreqInterval() : void
    {
        $this->expectException(\phpOMS\Stdlib\Base\Exception\InvalidEnumValue::class);
        $this->schedule->setFreqInterval(999);
    }

    /**
     * @covers Modules\Calendar\Models\Schedule
     * @group module
     */
    public function testFreqTypeInputOutput() : void
    {
        $this->schedule->setFreqType(FrequencyType::YEARLY);
        self::assertEquals(FrequencyType::YEARLY, $this->schedule->getFreqType());
    }

    /**
     * @covers Modules\Calendar\Models\Schedule
     * @group module
     */
    public function testInvalidFreqType() : void
    {
        $this->expectException(\phpOMS\Stdlib\Base\Exception\InvalidEnumValue::class);
        $this->schedule->setFreqType(999);
    }

    /**
     * @covers Modules\Calendar\Models\Schedule
     * @group module
     */
    public function testFrequencyRelativeInputOutput() : void
    {
        $this->schedule->setFrequencyRelative(FrequencyRelative::LAST);
        self::assertEquals(FrequencyRelative::LAST, $this->schedule->getFrequencyRelative());
    }

    /**
     * @covers Modules\Calendar\Models\Schedule
     * @group module
     */
    public function testInvalidFrequencyRelative() : void
    {
        $this->expectException(\phpOMS\Stdlib\Base\Exception\InvalidEnumValue::class);
        $this->schedule->setFrequencyRelative(999);
    }

    /**
     * @covers Modules\Calendar\Models\Schedule
     * @group module
     */
    public function testIntervalTypeInputOutput() : void
    {
        $this->schedule->setIntervalType(IntervalType::RELATIVE);
        self::assertEquals(IntervalType::RELATIVE, $this->schedule->getIntervalType());
    }

    /**
     * @covers Modules\Calendar\Models\Schedule
     * @group module
     */
    public function testInvalidIntervalType() : void
    {
        $this->expectException(\phpOMS\Stdlib\Base\Exception\InvalidEnumValue::class);
        $this->schedule->setIntervalType(999);
    }

    /**
     * @covers Modules\Calendar\Models\Schedule
     * @group module
     */
    public function testSerialize() : void
    {
        $this->schedule->setStatus(ScheduleStatus::INACTIVE);
        $this->schedule->setFreqType(FrequencyType::YEARLY);
        $this->schedule->setFreqInterval(FrequencyInterval::DAY);
        $this->schedule->setFrequencyRelative(FrequencyRelative::LAST);
        $this->schedule->setIntervalType(IntervalType::RELATIVE);

        $serialized = $this->schedule->jsonSerialize();
        unset($serialized['start']);
        unset($serialized['createdAt']);

        self::assertEquals(
            [
                'id'    => 0,
                'uuid' => '',
                'status' => ScheduleStatus::INACTIVE,
                'freqType' => FrequencyType::YEARLY,
                'freqInterval' => FrequencyInterval::DAY,
                'relativeInternal' => FrequencyRelative::LAST,
                'intervalType' => IntervalType::RELATIVE,
                'recurrenceFactor' => 0,
            ],
            $serialized
        );
    }
}
