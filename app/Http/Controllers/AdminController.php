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
        $eventCount = $this->admin_service->countEventParticipate($users);
        $changeDateFormat = $this->admin_service->changeDateFormat();
        return view('/admin/listUser', compact('users', 'eventCount', 'changeDateFormat'));
        
    }

    public function listUserByRole(Request $request)
    {
        // return $this->admin_service->listUserByRole($request);

        // dd("Hello ");
        $users = $this->admin_service->listUserByRole($request);
        $eventCount = $this->admin_service->countEventParticipate($users);
        $combine = [];
        $combine[] = $users;
        $combine[] = $eventCount;
        // array_push($combine, $users, $eventCount);
        // var_dump($combine);
        return json_encode($combine);
    }

    public function countEventParticipate(Request $request)
    {
        $eventCount = $this->admin_service->countEventParticipate($request);
        return $eventCount;
    }
}
