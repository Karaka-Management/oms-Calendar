<?php
/**
 * Jingga
 *
 * PHP Version 8.1
 *
 * @package   Modules\Calendar
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Calendar\Theme\Backend\Components\Calendar;

use Modules\Calendar\Models\Calendar;
use phpOMS\Localization\L11nManager;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Views\View;

/**
 * Component view.
 *
 * @package Modules\Calendar
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 * @codeCoverageIgnore
 */
class BaseView extends View
{
    /**
     * Calendar to render
     *
     * @var Calendar
     * @since 1.0.0
     */
    protected Calendar $calendar;

    /**
     * {@inheritdoc}
     */
    public function __construct(L11nManager $l11n, RequestAbstract $request, ResponseAbstract $response)
    {
        parent::__construct($l11n, $request, $response);
        $this->setTemplate('/Modules/Calendar/Theme/Backend/Components/Calendar/mini');
    }

    /**
     * {@inheritdoc}
     */
    public function render(mixed ...$data) : string
    {
        if (empty($data) || $data[0] === null) {
            return '';
        }

        /** @var array{0:Calendar} $data */
        $this->calendar = $data[0];

        return parent::render();
    }
}
