<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RedirectController extends Controller
{
    /**
     * Redireciona para uma URL externa
     *
     * @param string $url URL para redirecionamento
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToExternal($url)
    {
        return Redirect::away(urldecode($url));
    }
}
