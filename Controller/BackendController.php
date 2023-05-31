<?php
/**
 * Karaka
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

namespace Modules\Calendar\Controller;

use Modules\Calendar\Models\CalendarMapper;
use Modules\Dashboard\Models\DashboardElementInterface;
use phpOMS\Asset\AssetType;
use phpOMS\Contract\RenderableInterface;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Stdlib\Base\SmartDateTime;
use phpOMS\Views\View;

/**
 * Calendar controller class.
 *
 * @package Modules\Calendar
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
final class BackendController extends Controller implements DashboardElementInterface
{
    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewCalendarDashboard(RequestAbstract $request, ResponseAbstract $response, mixed $data = null) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);

        /** @var \phpOMS\Model\Html\Head $head */
        $head = $response->data['Content']->head;
        $head->addAsset(AssetType::CSS, '/Modules/Calendar/Theme/Backend/css/styles.css?v=1.0.0');

        $view->setTemplate('/Modules/Calendar/Theme/Backend/calendar-dashboard');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1001201001, $request, $response);

        /** @var \Modules\Calendar\Models\Calendar $calendar */
        $calendar               = CalendarMapper::get()->where('id', 1)->execute();
        $calendar->date         = new SmartDateTime((string) ($request->getData('date') ?? 'now'));
        $view->data['calendar'] = $calendar;

        $calendarEventPopup               = new \Modules\Calendar\Theme\Backend\Components\Event\BaseView($this->app->l11nManager, $request, $response);
        $view->data['calendarEventPopup'] = $calendarEventPopup;

        return $view;
    }

    /**
     * {@inheritdoc}
     * @codeCoverageIgnore
     */
    public function viewDashboard(RequestAbstract $request, ResponseAbstract $response, mixed $data = null) : RenderableInterface
    {
        /** @var \phpOMS\Model\Html\Head $head */
        $head = $response->data['Content']->head;
        $head->addAsset(AssetType::CSS, '/Modules/Calendar/Theme/Backend/css/styles.css?v=1.0.0');

        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Calendar/Theme/Backend/dashboard-calendar');

        $calendarView = new \Modules\Calendar\Theme\Backend\Components\Calendar\BaseView($this->app->l11nManager, $request, $response);
        $calendarView->setTemplate('/Modules/Calendar/Theme/Backend/Components/Calendar/mini');
        $view->data['calendar'] = $calendarView;

        /** @var \Modules\Calendar\Models\Calendar $calendar */
        $calendar          = CalendarMapper::get()->where('id', 1)->execute();
        $calendar->date    = new SmartDateTime((string) ($request->getData('date') ?? 'now'));
        $view->data['cal'] = $calendar;

        return $view;
    }
}
