<?php
/**
 * Jingga
 *
 * PHP Version 8.1
 *
 * @package   Modules\Calendar\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Calendar\Models;

use Modules\Admin\Models\Account;
use Modules\Admin\Models\NullAccount;
use phpOMS\Stdlib\Base\Exception\InvalidEnumValue;

/**
 * Schedule class.
 *
 * @package Modules\Calendar\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
class Schedule
{
    /**
     * Schedule ID.
     *
     * @var int
     * @since 1.0.0
     */
    public int $id = 0;

    /**
     * Calendar uid.
     *
     * @var string
     * @since 1.0.0
     */
    private string $uid = '';

    /**
     * Schedule status.
     *
     * @var int
     * @since 1.0.0
     */
    public int $status = ScheduleStatus::ACTIVE;

    /**
     * Frequency type.
     *
     * @var int
     * @since 1.0.0
     */
    private int $freqType = FrequencyType::ONCE;

    public int $dayOfMonth = 0;

    public int $daysOfWeek = 0;

    public int $patternIndex = 0;

    public int $patternMonth = 0;

    public int $intervalType = 0;

    /**
     * Interval type.
     *
     * @var int
     * @since 1.0.0
     */
    private int $patternInterval = IntervalType::ABSOLUTE;

    /**
     * Recurrence factor.
     *
     * @var int
     * @since 1.0.0
     */
    public int $numberOfOccurrences = 0;

    /**
     * Date.
     *
     * @var null|\DateTime
     * @since 1.0.0
     */
    public ?\DateTime $date = null;

    /**
     * Start.
     *
     * @var null|\DateTime
     * @since 1.0.0
     */
    public ?\DateTime $start = null;

    /**
     * End.
     *
     * @var null|\DateTime
     * @since 1.0.0
     */
    public ?\DateTime $end = null;

    /**
     * Created at.
     *
     * @var \DateTimeImmutable
     * @since 1.0.0
     */
    public \DateTimeImmutable $createdAt;

    /**
     * Created by.
     *
     * @var Account
     * @since 1.0.0
     */
    public Account $createdBy;

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->createdBy = new NullAccount();
        $this->createdAt = new \DateTimeImmutable('now');
    }

    /**
     * @return int
     *
     * @since 1.0.0
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @return int
     *
     * @since 1.0.0
     */
    public function getStatus() : int
    {
        return $this->status;
    }

    /**
     * @param int $status Schedule status
     *
     * @return self
     *
     * @throws InvalidEnumValue
     *
     * @since 1.0.0
     */
    public function setStatus(int $status) : self
    {
        if (!ScheduleStatus::isValidValue($status)) {
            throw new InvalidEnumValue($status);
        }

        $this->status = $status;

        return $this;
    }

    /**
     * @return int
     *
     * @since 1.0.0
     */
    public function getFreqType() : int
    {
        return $this->freqType;
    }

    /**
     * @param int $freqType Frequency type
     *
     * @return self
     *
     * @throws InvalidEnumValue
     *
     * @since 1.0.0
     */
    public function setFreqType(int $freqType) : self
    {
        if (!FrequencyType::isValidValue($freqType)) {
            throw new InvalidEnumValue($freqType);
        }

        $this->freqType = $freqType;

        return $this;
    }

    /**
     * @return int
     *
     * @since 1.0.0
     */
    public function getIntervalType() : int
    {
        return $this->patternInterval;
    }

    /**
     * @param int $patternInterval Interval type
     *
     * @return self
     *
     * @throws InvalidEnumValue
     *
     * @since 1.0.0
     */
    public function setIntervalType(int $patternInterval) : self
    {
        if (!IntervalType::isValidValue($patternInterval)) {
            throw new InvalidEnumValue($patternInterval);
        }

        $this->patternInterval = $patternInterval;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id'                  => $this->id,
            'uuid'                => $this->uid,
            'status'              => $this->status,
            'freqType'            => $this->freqType,
            'patternInterval'     => $this->patternInterval,
            'start'               => $this->start,
            'createdAt'           => $this->createdAt,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize() : mixed
    {
        return $this->toArray();
    }
}
