<?php

namespace App\Listeners;

use App\Models\containers;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use League\CommonMark\Exception\IOException;
use App\Models\Activity;
class LogWasteDepositActivity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        Activity::create([
        'log_name'     => 'iot_telemetry',
        'description'  => "Custom deposit log",
        'subject_type' => 'container',
        'subject_id'   => $event->container->id,
        'causer_type'  => 'student',
        'causer_id'    => $event->student->id,
        'event'        => 'deposit',
        'weight'   => $event->weight,
        'material' => $event->materialtype,
        'points'   => $event->pointesearned,
        'university_id'=>$event->student->university_id,
        'serial_number'=>$event->container->serial_number,
                ]);

    }
}
