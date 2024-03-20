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

use Modules\Calendar\Models\FrequencyType;
use Modules\Calendar\Models\IntervalType;
use Modules\Calendar\Models\Schedule;
use Modules\Calendar\Models\ScheduleStatus;

/**
 * @internal
 */
#[\PHPUnit\Framework\Attributes\CoversClass(\Modules\Calendar\Models\Schedule::class)]
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

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testDefault() : void
    {
        self::assertEquals(0, $this->schedule->id);
        self::assertEquals(ScheduleStatus::ACTIVE, $this->schedule->getStatus());
        self::assertEquals(FrequencyType::ONCE, $this->schedule->getFreqType());
        self::assertEquals(IntervalType::ABSOLUTE, $this->schedule->getIntervalType());
        self::assertInstanceOf('\Modules\Admin\Models\NullAccount', $this->schedule->createdBy);
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testSerialize() : void
    {
        $this->schedule->status       = ScheduleStatus::INACTIVE;
        $this->schedule->freqType     = FrequencyType::YEARLY;
        $this->schedule->patternInterval = IntervalType::RELATIVE;

        $serialized = $this->schedule->jsonSerialize();
        unset($serialized['start']);
        unset($serialized['createdAt']);

        self::assertEquals(
            [
                'id'              => 0,
                'uuid'            => '',
                'status'          => ScheduleStatus::INACTIVE,
                'freqType'        => FrequencyType::YEARLY,
                'patternInterval' => IntervalType::RELATIVE,
            ],
            $serialized
        );
    }
}
