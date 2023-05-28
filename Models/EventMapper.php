<?php
/**
 * Karaka
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

use Modules\Admin\Models\AccountMapper;
use Modules\Tag\Models\TagMapper;
use phpOMS\DataStorage\Database\Mapper\DataMapperFactory;

/**
 * Mapper class.
 *
 * @package Modules\Calendar\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 *
 * @template T of Event
 * @extends DataMapperFactory<T>
 */
final class EventMapper extends DataMapperFactory
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    public const COLUMNS = [
        'calendar_event_id'                     => ['name' => 'calendar_event_id',          'type' => 'int',          'internal' => 'id'],
        'calendar_event_name'                   => ['name' => 'calendar_event_name',        'type' => 'string',       'internal' => 'name'],
        'calendar_event_description'            => ['name' => 'calendar_event_description', 'type' => 'string',       'internal' => 'description'],
        'calendar_event_location'               => ['name' => 'calendar_event_location',    'type' => 'Serializable', 'internal' => 'location'],
        'calendar_event_type'                   => ['name' => 'calendar_event_type',        'type' => 'int',          'internal' => 'type'],
        'calendar_event_status'                 => ['name' => 'calendar_event_status',      'type' => 'int',          'internal' => 'status'],
        'calendar_event_show_as'                => ['name' => 'calendar_event_show_as',      'type' => 'int',          'internal' => 'showAs'],
        'calendar_event_hidden_attendees'       => ['name' => 'calendar_event_hidden_attendees',      'type' => 'bool',          'internal' => 'hiddenAttendees'],
        'calendar_event_is_all_day'             => ['name' => 'calendar_event_is_all_day',      'type' => 'bool',          'internal' => 'isAllDay'],
        'calendar_event_is_cancelled'           => ['name' => 'calendar_event_is_cancelled',      'type' => 'bool',          'internal' => 'isCancelled'],
        'calendar_event_is_draft'               => ['name' => 'calendar_event_is_draft',      'type' => 'bool',          'internal' => 'isDraft'],
        'calendar_event_is_online_meeting'      => ['name' => 'calendar_event_is_online_meeting',      'type' => 'bool',          'internal' => 'isOnlineMeeting'],
        'calendar_event_web_link'               => ['name' => 'calendar_event_web_link',      'type' => 'string',          'internal' => 'webLink'],
        'calendar_event_external_id'            => ['name' => 'calendar_event_external_id',      'type' => 'string',          'internal' => 'externalId'],
        'calendar_event_schedule'               => ['name' => 'calendar_event_schedule',    'type' => 'int',          'internal' => 'schedule'],
        'calendar_event_calendar'               => ['name' => 'calendar_event_calendar',    'type' => 'int',          'internal' => 'calendar'],
        'calendar_event_start'                  => ['name' => 'calendar_event_start',  'type' => 'DateTime', 'internal' => 'start'],
        'calendar_event_end'                    => ['name' => 'calendar_event_end',  'type' => 'DateTime', 'internal' => 'end'],
        'calendar_event_created_by'             => ['name' => 'calendar_event_created_by',  'type' => 'int',          'internal' => 'createdBy', 'readonly' => true],
        'calendar_event_created_at'             => ['name' => 'calendar_event_created_at',  'type' => 'DateTimeImmutable', 'internal' => 'createdAt', 'readonly' => true],
    ];

    /**
     * Has one relation.
     *
     * @var array<string, array{mapper:class-string, external:string, by?:string, column?:string, conditional?:bool}>
     * @since 1.0.0
     */
    public const OWNS_ONE = [
        'schedule' => [
            'mapper'     => ScheduleMapper::class,
            'external'   => 'calendar_event_schedule',
        ],
    ];

    /**
     * Belongs to.
     *
     * @var array<string, array{mapper:class-string, external:string, column?:string, by?:string}>
     * @since 1.0.0
     */
    public const BELONGS_TO = [
        'createdBy' => [
            'mapper'     => AccountMapper::class,
            'external'   => 'calendar_event_created_by',
        ],
    ];

    /**
     * Has many relation.
     *
     * @var array<string, array{mapper:class-string, table:string, self?:?string, external?:?string, column?:string}>
     * @since 1.0.0
     */
    public const HAS_MANY = [
        'tags'         => [
            'mapper'   => TagMapper::class,
            'table'    => 'calendar_event_tag',
            'external' => 'calendar_event_tag_dst',
            'self'     => 'calendar_event_tag_src',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    public const TABLE = 'calendar_event';

    /**
     * Created at.
     *
     * @var string
     * @since 1.0.0
     */
    public const CREATED_AT = 'calendar_event_created_at';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    public const PRIMARYFIELD = 'calendar_event_id';
}
