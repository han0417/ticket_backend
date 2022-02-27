<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class TicketAdd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ticket:add {amount}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '將票卷依照數量補進redis當中 ex: php artisan ticket:add {amount}';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 將票卷依照數量補進redis當中
     * @param int $amount 票卷數量
     * @return int
     */
    public function handle()
    {
        //TODO:之後再來補 error exception
        $redis = app('redis');
        $amount = $this->argument('amount');
        for ($i=0;$i<$amount;$i++){
            $tickets[$i] = Str::random('10');
        }
        $redis->lpush('ticket', ...$tickets);
        print('票卷補貨成功' . "\n");
        return 0;
    }
}
