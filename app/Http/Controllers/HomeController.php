<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application as ContractApplication;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class HomeController
{
    /**
     * Welcome page
     *
     * @return View|Application|Factory|ContractApplication
     */
    public function welcome(): View|Application|Factory|ContractApplication
    {
        return view('welcome');
    }

    /**
     * Show user's dashboard .
     *
     * @return Renderable
     */
    public function home(): Renderable
    {
        return view('dashboard');
    }
}
