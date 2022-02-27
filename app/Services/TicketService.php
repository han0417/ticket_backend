<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Repositories\TicketRepository;
use App\Exceptions\TicketException;

class TicketService
{
    private $ticketRepo;
    private $exception;

    public function __construct(
        TicketRepository $ticketRepo,
        TicketException $exception
    ) {
        $this->ticketRepo = $ticketRepo;
        $this->exception = $exception;
    }

    /**
     * create ticket
     * @param array $data [
     *    @param string  title   ticket標題
     *    @param boolean checked 是否勾選
     *    @param int     user_id 用戶序號
     * ]
     * @return void
     */
    public function create(array $data)
    {
        $ticketData = [
            'user_id'      => $data['user_id']
        ];
        DB::beginTransaction();
        try {
            $this->ticketRepo->create($ticketData);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            //新增ticket失敗
            $this->exception->error(20002, $e->getMessage());
        }
    }
}
