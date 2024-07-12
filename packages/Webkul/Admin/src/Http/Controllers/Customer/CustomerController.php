<?php

namespace Webkul\Admin\Http\Controllers\Customer;

use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Admin\Helpers\Dashboard as DashboardHelper;

class CustomerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(protected DashboardHelper $dashboardHelper)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin::dashboard.customers');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function template()
    {
        return view('admin::dashboard.template');
    }

    /**
     * Returns json data for dashboard card.
     */
    public function getCardData()
    {
        //
    }

    /**
     * Returns json data for available dashboard cards.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCards()
    {
       //
    }

    /**
     * Returns updated json data for available dashboard cards.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateCards()
    {
        //
    }
}
