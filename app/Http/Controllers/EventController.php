<?php

namespace App\Http\Controllers;

use App\Domain\Event\Service\EventService as ServiceEventService;
use App\Domain\Petition\Model;
use Illuminate\Http\Request;
use App\Domain\Petition\Service\PetitionService;
use App\Domain\Profile\Service\ProfileService;
use App\Domatin\Event\Service\EventService;
use App\Domain\Helper\HelperService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    private $event_service;
    private $profile_service;

    public function __construct()
    {
        $this->event_service = new ServiceEventService();
        $this->profile_service = new ProfileService();
    }

    //! Mengecek verifikasi data diri yang diberikan sebelum membuat event
    public function verifyProfileCreateEvent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'phone' => 'numeric|nullable'
        ]);

        if ($validator->fails()) {
            return json_encode("Validation Error");
        };

        return json_encode($this->event_service->verifyProfileCreateEvent($request->email, $request->phone));
    }

    public function getAllCategoriesEvent()
    {
        return $this->event_service->getAllCategoriesEvent();
    }
}
