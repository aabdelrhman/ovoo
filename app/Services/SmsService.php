<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SmsService
{

    public function sendSMS($to, $text, $from = "OVOO")
    {
        // return Http::withToken(env('SMS_TOKEN', ''))->post("https://api.oursms.com/msgs/sms", $this->smsData($to, $text, $from));
    }

    // private function smsData($to, $text, $from): array
    // {
    //     return [
    //         "src" => $from,
    //         "dests" => [$to],
    //         "body" => $text,
    //         "priority" => 0,
    //         "delay" => 0,
    //         "validity" => 0,
    //         "maxParts" => 0,
    //         "dlr" => 0,
    //         "prevDups" => 0,
    //         "msgClass" => "promotional",
    //     ];
    // }

}
