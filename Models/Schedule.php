<?php
/**
 * Karaka
 *
 * PHP Version 8.1
 *
 * @package   Modules\Calendar\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://karaka.app
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
 * @license OMS License 1.0
 * @link    https://karaka.app
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
    protected int $id = 0;

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
    private int $status = ScheduleStatus::ACTIVE;

    /**
     * Frequency type.
     *
     * @var int
     * @since 1.0.0
     */
    private int $freqType = FrequencyType::ONCE;

    /**
     * Frequency interval.
     *
     * @var int
     * @since 1.0.0
     */
    private int $freqInterval = FrequencyInterval::DAY;

    /**
     * Frequency relative.
     *
     * @var int
     * @since 1.0.0
     */
    private int $relativeInternal = FrequencyRelative::FIRST;

    /**
     * Interval type.
     *
     * @var int
     * @since 1.0.0
     */
    private int $intervalType = IntervalType::ABSOLUTE;

    /**
     * Recurrence factor.
     *
     * @var int
     * @since 1.0.0
     */
    public int $recurrenceFactor = 0;

    /**
     * Start.
     *
     * @var \DateTime
     * @since 1.0.0
     */
    public \DateTime $start;

    /**
     * Duration.
     *
     * @var int
     * @since 1.0.0
     */
    public int $duration = 3600;

    /**
     * End.
     *
     * @var \DateTime
     * @since 1.0.0
     */
    public \DateTime $end;

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
        $this->start     = new \DateTime('now');
        $this->end       = new \DateTime('now');
        $this->end->setTimestamp($this->end->getTimestamp() + $this->duration);
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
     * @return $this
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
     * @return $this
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
        return $this->intervalType;
    }

    /**
     * @param int $intervalType Interval type
     *
     * @return $this
     *
     * @since 1.0.0
     */
    public function setIntervalType(int $intervalType) : self
    {
        if (!IntervalType::isValidValue($intervalType)) {
            throw new InvalidEnumValue($intervalType);
        }

        $this->intervalType = $intervalType;

        return $this;
    }

    /**
     * @return int
     *
     * @since 1.0.0
     */
    public function getFrequencyRelative() : int
    {
        return $this->relativeInternal;
    }

    /**
     * @param int $relativeInterval Relative interval
     *
     * @return $this
     *
     * @since 1.0.0
     */
    public function setFrequencyRelative(int $relativeInterval) : self
    {
        if (!FrequencyRelative::isValidValue($relativeInterval)) {
            throw new InvalidEnumValue($relativeInterval);
        }

        $this->relativeInternal = $relativeInterval;

        return $this;
    }

    /**
     * @param int $freqInterval Frequency interval
     *
     * @return $this
     *
     * @since 1.0.0
     */
    public function setFreqInterval(int $freqInterval) : self
    {
        if (!FrequencyInterval::isValidValue($freqInterval)) {
            throw new InvalidEnumValue($freqInterval);
        }

        $this->freqInterval = $freqInterval;

        return $this;
    }

    /**
     * @return int
     *
     * @since 1.0.0
     */
    public function getFreqInterval() : int
    {
        return $this->freqInterval;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id'               => $this->id,
            'uuid'             => $this->uid,
            'status'           => $this->status,
            'freqType'         => $this->freqType,
            'freqInterval'     => $this->freqInterval,
            'relativeInternal' => $this->relativeInternal,
            'intervalType'     => $this->intervalType,
            'recurrenceFactor' => $this->recurrenceFactor,
            'start'            => $this->start,
            'createdAt'        => $this->createdAt,
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
