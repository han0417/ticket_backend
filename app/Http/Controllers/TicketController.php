<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TicketService;
use App\Http\Resources\BaseJsonResource;
use App\Http\Resources\GetticketListCollection;
use App\Http\Resources\GetticketResource;

class TicketController extends Controller
{
    private $ticketService;

    public function __construct(
        TicketService $ticketService
    ) {
        $this->ticketService = $ticketService;
    }

    /**
     * create ticket
     * @return BaseJsonResource
     */
    public function create(Request $request)
    {
        $inputData = $request->all();
        $inputData['user_id'] = auth('admin')->user()->id;
        $validateRule = [
            'user_id'      => 'required|int'
        ];

        $this->validateByRule($inputData, $validateRule);

        $this->ticketService->create($inputData);
        return new BaseJsonResource(null);
    }

}
