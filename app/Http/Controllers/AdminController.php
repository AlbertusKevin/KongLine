<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Admin\Service\AdminService;

class AdminController extends Controller
{
    private $admin_service;

    public function __construct()
    {
        $this->admin_service = new AdminService();
    }
    public function getAll()
    {
        $users = $this->admin_service->getAllUser();
        return view('/listUser', compact('users'));
    }
}
