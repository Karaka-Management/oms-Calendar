<?php
/**
 * Orange Management
 *
 * PHP Version 7.0
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013 Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
namespace Modules\Calendar\Models;

use phpOMS\Datatypes\Enum;

/**
 * Frequency interval type enum.
 *
 * @category   Calendar
 * @package    Modules
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class FrequencyInterval extends Enum
{
    /* public */ const SUNDAY     = 1;
    /* public */ const MONDAY     = 2;
    /* public */ const TUESDAY    = 4;
    /* public */ const WEDNESDAY  = 8;
    /* public */ const THURSDAY   = 16;
    /* public */ const FRIDAY     = 32;
    /* public */ const SATURDAY   = 64;
    /* public */ const DAY        = 128;
    /* public */ const WEEKDAY    = 256;
    /* public */ const WEEKENDDAY = 512;
}
