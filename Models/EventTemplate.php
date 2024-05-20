<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\Calendar\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.2
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Calendar\Models;

/**
 * Event template class.
 *
 * @package Modules\Calendar\Models
 * @license OMS License 2.2
 * @link    https://jingga.app
 * @since   1.0.0
 */
class EventTemplate extends Event
{
    /**
     * Type.
     *
     * @var int
     * @since 1.0.0
     */
    public int $type = EventType::TEMPLATE;
}
