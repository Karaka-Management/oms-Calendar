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

/**
 * Event template class.
 *
 * @package Modules\Calendar\Models
 * @license OMS License 2.0
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
    private int $type = EventType::TEMPLATE;

    /**
     * Get event type.
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getType() : int
    {
        return $this->type;
    }

    /**
     * Set event type.
     *
     * @param int $type Event type
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setType(int $type = EventType::TEMPLATE) : void
    {
        $this->type = $type;
    }
}
