<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Manager Dashboard',
            'list' => ['Home', 'Manager']
        ];

        $page = (object) [
            'title' => 'Manager Dashboard'
        ];

        $activeMenu = 'dashboard'; // set menu yang sedang aktif

        return view('manager', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }
}
