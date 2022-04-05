<?php
/**
 * Karaka
 *
 * PHP Version 8.0
 *
 * @package   Modules\Calendar\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://karaka.app
 */
declare(strict_types=1);

namespace Modules\Calendar\Models;

use phpOMS\Stdlib\Base\SmartDateTime;

/**
 * Calendar class.
 *
 * @package Modules\Calendar\Models
 * @license OMS License 1.0
 * @link    https://karaka.app
 * @since   1.0.0
 */
class Calendar
{
    /**
     * Calendar ID.
     *
     * @var int
     * @since 1.0.0
     */
    protected int $id = 0;

    /**
     * Name.
     *
     * @var string
     * @since 1.0.0
     */
    public string $name = '';

    /**
     * Description.
     *
     * @var string
     * @since 1.0.0
     */
    public string $description = '';

    /**
     * Created at.
     *
     * @var \DateTimeImmutable
     * @since 1.0.0
     */
    public \DateTimeImmutable $createdAt;

    /**
     * Current date of the calendar.
     *
     * @var \DateTime
     * @since 1.0.0
     */
    public \DateTime $date;

    /**
     * Events.
     *
     * @var array<int, \Modules\Calendar\Models\Event>
     * @since 1.0.0
     */
    private $events = [];

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable('now');
        $this->date      = new SmartDateTime('now');
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
     * @param Event $event Calendar event
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function addEvent(Event $event) : int
    {
        $this->events[] = $event;

        \end($this->events);
        $key = \key($this->events);
        \reset($this->events);

        return $key;
    }

    /**
     * @return Event[]
     *
     * @since 1.0.0
     */
    public function getEvents() : array
    {
        return $this->events;
    }

    /**
     * @param int $id Event id
     *
     * @return bool
     *
     * @since 1.0.0
     */
    public function removeEvent(int $id) : bool
    {
        if (isset($this->events[$id])) {
            unset($this->events[$id]);

            return true;
        }

        return false;
    }

    /**
     * @param int $id Event id
     *
     * @return Event
     *
     * @since 1.0.0
     */
    public function getEvent(int $id) : Event
    {
        return $this->events[$id] ?? new NullEvent();
    }

    /**
     * Get event by date
     *
     * @param \DateTime $date Date of the event
     *
     * @return Event[]
     *
     * @since 1.0.0
     */
    public function getEventsOnDate(\DateTime $date) : array
    {
        $events = [];
        foreach ($this->events as $event) {
            if ($event->schedule->start->format('Y-m-d') === $date->format('Y-m-d')) {
                $events[] = $event;
            }
        }

        return $events;
    }

    /**
     * Has event on date
     *
     * @param \DateTime $date Date of the event
     *
     * @return bool
     *
     * @since 1.0.0
     */
    public function hasEventOnDate(\DateTime $date) : bool
    {
        foreach ($this->events as $event) {
            if ($event->schedule->start->format('Y-m-d') === $date->format('Y-m-d')) {
                return true;
            }
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'createdAt'   => $this->createdAt,
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
