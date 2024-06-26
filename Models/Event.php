<?php
/**
 * Jingga
 *
 * PHP Version 8.2
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
use Modules\Tag\Models\Tag;
use phpOMS\Stdlib\Base\Location;

/**
 * Event class.
 *
 * @package Modules\Calendar\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
class Event
{
    /**
     * Calendar ID.
     *
     * @var int
     * @since 1.0.0
     */
    public int $id = 0;

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
     * Created.
     *
     * @var \DateTimeImmutable
     * @since 1.0.0
     */
    public \DateTimeImmutable $createdAt;

    /**
     * Creator.
     *
     * @var Account
     * @since 1.0.0
     */
    public Account $createdBy;

    /**
     * Event type.
     *
     * Single event or a template (templates have a repeating)
     *
     * @var int
     * @since 1.0.0
     */
    public int $type = EventType::SINGLE;

    /**
     * Event status.
     *
     * Active, inactive etc.
     *
     * @var int
     * @since 1.0.0
     */
    public int $status = EventStatus::ACTIVE;

    /**
     * Schedule
     *
     * @var Schedule
     * @since 1.0.0
     */
    public Schedule $schedule;

    /**
     * Location of the event.
     *
     * @var Location
     * @since 1.0.0
     */
    public Location $location;

    public \DateTime $start;

    public \DateTime $end;

    public int $showAs = 0;

    public bool $hiddenAttendees = false;

    public bool $isAllDay = true;

    public bool $isCancelled = false;

    public bool $isDraft = false;

    public bool $isOnlineMeeting = false;

    public string $webLink = '';

    public string $externalId = '';

    /**
     * Calendar
     *
     * @var int
     * @since 1.0.0
     */
    public int $calendar = 0;

    /**
     * People.
     *
     * @var array
     * @since 1.0.0
     */
    public array $people = [];

    /**
     * Tags.
     *
     * @var Tag[]
     * @since 1.0.0
     */
    public array $tags = [];

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->createdBy = new NullAccount();
        $this->createdAt = new \DateTimeImmutable('now');
        $this->location  = new Location();
        $this->schedule  = new Schedule();
        $this->start     = new \DateTime('now');
        $this->end       = new \DateTime('now');
    }

    /**
     * @return Account[]
     *
     * @since 1.0.0
     */
    public function getPeople() : array
    {
        return $this->people;
    }

    /**
     * @param int $id Account id
     *
     * @return Account
     *
     * @since 1.0.0
     */
    public function getPerson(int $id) : Account
    {
        return $this->people[$id] ?? new NullAccount();
    }

    /**
     * @param Account $person Person to add
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addPerson(Account $person) : void
    {
        $this->people[$person->id] = $person;
    }

    /**
     * Remove Element from list.
     *
     * @param int $id Task element
     *
     * @return bool
     *
     * @since 1.0.0
     */
    public function removePerson(int $id) : bool
    {
        if (isset($this->people[$id])) {
            unset($this->people[$id]);

            return true;
        }

        return false;
    }

    /**
     * @return Account
     *
     * @since 1.0.0
     */
    public function getCreatedBy() : Account
    {
        return $this->createdBy;
    }

    /**
     * Set creator
     *
     * @param Account $createdBy Creator
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setCreatedBy(Account $createdBy) : void
    {
        $this->createdBy = $createdBy;

        if ($this->schedule instanceof Schedule) {
            $this->schedule->createdBy = $this->createdBy;
        }
    }

    /**
     * Adding new tag.
     *
     * @param Tag $tag Tag
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function addTag(Tag $tag) : int
    {
        $this->tags[] = $tag;

        \end($this->tags);
        $key = (int) \key($this->tags);
        \reset($this->tags);

        return $key;
    }

    /**
     * Remove Tag from list.
     *
     * @param int $id Tag
     *
     * @return bool
     *
     * @since 1.0.0
     */
    public function removeTag($id) : bool
    {
        if (isset($this->tags[$id])) {
            unset($this->tags[$id]);

            return true;
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
            'type'        => $this->type,
            'status'      => $this->status,
            'schedule'    => $this->schedule,
            'location'    => $this->location,
            'calendar'    => $this->calendar,
            'people'      => $this->people,
            'tags'        => $this->tags,
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
