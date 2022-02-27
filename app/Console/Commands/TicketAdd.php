<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
    protected $description = 'Command description';

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
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //TODO:之後再來補 return message
        $redis = app('redis');
        $amount = $this->argument('amount');
        for ($i=0;$i<$amount;$i++){
            $tickets[$i] = '';
        }
        $redis->lpush('ticket', ...$tickets);

        return 0;
    }
}
