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

use phpOMS\Stdlib\Base\Enum;

/**
 * Interval type type enum.
 *
 * @package Modules\Calendar\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
abstract class IntervalType extends Enum
{
    public const ABSOLUTE = 1;

    public const RELATIVE = 2;
}
