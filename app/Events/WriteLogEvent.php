<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class WriteLogEvent
{
    use SerializesModels;

    public function __construct()
    {
        
    }
}
