<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class MutexService
{
    /**
     * 實作互斥鎖
     * @param string $key 鎖的key值
     * @return boolean
     */
    public function hasLock(string $key)
    {
        $hasLock = Cache::store('redis')->has("lock:$key");
        if ($hasLock) {
            return true;
        }
        Cache::store('redis')->put("lock:$key", "$key", $seconds = 2);

        return false;
    }
}
