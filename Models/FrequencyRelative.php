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
 * Frequency relative type enum.
 *
 * @package Modules\Calendar\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
abstract class FrequencyRelative extends Enum
{
    public const FIRST = 1;

    public const SECOND = 2;

    public const THIRD = 4;

    public const FOURTH = 8;

    public const LAST = 64;
}
