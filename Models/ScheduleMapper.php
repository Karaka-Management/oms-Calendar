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

use Modules\Admin\Models\AccountMapper;
use phpOMS\DataStorage\Database\Mapper\DataMapperFactory;

/**
 * Mapper class.
 *
 * @package Modules\Calendar\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 *
 * @template T of Schedule
 * @extends DataMapperFactory<T>
 */
final class ScheduleMapper extends DataMapperFactory
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    public const COLUMNS = [
        'schedule_id'                          => ['name' => 'schedule_id',                          'type' => 'int',      'internal' => 'id'],
        'schedule_uid'                         => ['name' => 'schedule_uid',                         'type' => 'string',   'internal' => 'uid'],
        'schedule_status'                      => ['name' => 'schedule_status',                      'type' => 'int',      'internal' => 'status'],
        'schedule_freq_type'                   => ['name' => 'schedule_freq_type',                   'type' => 'int',      'internal' => 'freqType'],
        'schedule_date'                        => ['name' => 'schedule_date',                        'type' => 'DateTime',      'internal' => 'date'],
        'schedule_start'                       => ['name' => 'schedule_start',                       'type' => 'DateTime',      'internal' => 'start'],
        'schedule_end'                         => ['name' => 'schedule_end',                         'type' => 'DateTime',      'internal' => 'end'],
        'schedule_pattern_numberofoccurrences' => ['name' => 'schedule_pattern_numberofoccurrences', 'type' => 'int',      'internal' => 'numberOfOccurrences'],
        'schedule_pattern_type'                => ['name' => 'schedule_pattern_type',                'type' => 'int',      'internal' => 'intervalType'],
        'schedule_pattern_pattern_interval'    => ['name' => 'schedule_pattern_pattern_interval',            'type' => 'int',      'internal' => 'patternInterval'],
        'schedule_pattern_dayofmonth'          => ['name' => 'schedule_pattern_dayofmonth',          'type' => 'int',      'internal' => 'dayOfMonth'],
        'schedule_pattern_daysofweek'          => ['name' => 'schedule_pattern_daysofweek',          'type' => 'int',      'internal' => 'daysOfWeek'],
        'schedule_pattern_index'               => ['name' => 'schedule_pattern_index',               'type' => 'int',      'internal' => 'patternIndex'],
        'schedule_pattern_month'               => ['name' => 'schedule_pattern_month',               'type' => 'int',      'internal' => 'patternMonth'],
        'schedule_created_by'                  => ['name' => 'schedule_created_by',                  'type' => 'int',      'internal' => 'createdBy'],
        'schedule_created_at'                  => ['name' => 'schedule_created_at',                  'type' => 'DateTime',      'internal' => 'createdAt'],
    ];

    /**
     * Belongs to.
     *
     * @var array<string, array{mapper:class-string, external:string, column?:string, by?:string}>
     * @since 1.0.0
     */
    public const BELONGS_TO = [
        'createdBy' => [
            'mapper'   => AccountMapper::class,
            'external' => 'schedule_created_by',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    public const TABLE = 'schedule';

    /**
     * Created at.
     *
     * @var string
     * @since 1.0.0
     */
    public const CREATED_AT = 'schedule_created_at';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    public const PRIMARYFIELD = 'schedule_id';
}
