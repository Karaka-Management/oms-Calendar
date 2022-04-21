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

use Modules\Admin\Models\AccountMapper;
use Modules\Tag\Models\TagMapper;
use phpOMS\DataStorage\Database\Mapper\DataMapperFactory;

/**
 * Mapper class.
 *
 * @package Modules\Calendar\Models
 * @license OMS License 1.0
 * @link    https://karaka.app
 * @since   1.0.0
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
        'calendar_event_id'          => ['name' => 'calendar_event_id',          'type' => 'int',          'internal' => 'id'],
        'calendar_event_name'        => ['name' => 'calendar_event_name',        'type' => 'string',       'internal' => 'name'],
        'calendar_event_description' => ['name' => 'calendar_event_description', 'type' => 'string',       'internal' => 'description'],
        'calendar_event_location'    => ['name' => 'calendar_event_location',    'type' => 'Serializable', 'internal' => 'location'],
        'calendar_event_type'        => ['name' => 'calendar_event_type',        'type' => 'int',          'internal' => 'type'],
        'calendar_event_status'      => ['name' => 'calendar_event_status',      'type' => 'int',          'internal' => 'status'],
        'calendar_event_schedule'    => ['name' => 'calendar_event_schedule',    'type' => 'int',          'internal' => 'schedule'],
        'calendar_event_calendar'    => ['name' => 'calendar_event_calendar',    'type' => 'int',          'internal' => 'calendar'],
        'calendar_event_created_by'  => ['name' => 'calendar_event_created_by',  'type' => 'int',          'internal' => 'createdBy', 'readonly' => true],
        'calendar_event_created_at'  => ['name' => 'calendar_event_created_at',  'type' => 'DateTimeImmutable', 'internal' => 'createdAt', 'readonly' => true],
    ];

    /**
     * Has one relation.
     *
     * @var array<string, array{mapper:string, external:string, by?:string, column?:string, conditional?:bool}>
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
     * @var array<string, array{mapper:string, external:string, column?:string, by?:string}>
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
     * @var array<string, array{mapper:string, table:string, self?:?string, external?:?string, column?:string}>
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
    public const PRIMARYFIELD ='calendar_event_id';
}
