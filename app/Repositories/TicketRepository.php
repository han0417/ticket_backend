<?php

namespace App\Repositories;

use App\Models\Ticket;

class TicketRepository
{
    private $model;

    public function __construct(Ticket $model)
    {
        $this->model = $model;
    }

    /**
     *
     * 取得取票清單
     * @return object
     *
     */
    public function listByFilter(array $filter, array $relation = [])
    {
        $query = $this->model->query();

        if (!empty($filter['id'])) {
            $query->where('id', $filter['id']);
        }

        if (!empty($filter['user_id'])) {
            $query->where('user_id', $filter['user_id']);
        }

        // 如果有limit就分頁
        return isset($filter['limit']) ? $query->paginate($filter['limit']) : $query->get();
    }

    /**
     *
     * create
     *
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }
}
