<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class GithubController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function create(): View 
    {
        //
    }

    public function store(): RedirectResponse
    {
        //
    }
}
