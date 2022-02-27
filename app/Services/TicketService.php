<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Repositories\TicketRepository;
use App\Exceptions\TicketException;
use Illuminate\Support\Facades\Cache;
use App\Services\MutexService;

class TicketService
{
    private $ticketRepo;
    private $exception;
    private $mutex;

    public function __construct(
        TicketRepository $ticketRepo,
        TicketException $exception,
        MutexService $mutex
    ) {
        $this->ticketRepo = $ticketRepo;
        $this->exception = $exception;
        $this->mutex = $mutex;
    }

    /**
     * 取票
     * @param array $data [
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
            //互斥鎖，避免大量request
            $this->mutex->hasLock($data['user_id']) && $this->exception->error(20003);
            
            $redis = app('redis');
            $ticket = $redis->lpop('ticket');
            if (empty($ticket)) {
                $this->exception->error(20002, 'redis上已無可用票卷');
            }
            $this->ticketRepo->create($ticketData);
            DB::commit();
        }
        catch (\Throwable $e) {
            DB::rollBack();
            //新增ticket失敗
            $this->exception->error(20001, $e->getMessage());
        }
    }
}
