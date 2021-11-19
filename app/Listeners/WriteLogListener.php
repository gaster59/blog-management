<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;

class WriteLogListener implements ShouldQueue
{
    public function __construct()
    {

    }

    public function handle()
    {
        \Log::info('test event - listener');
    }
}
