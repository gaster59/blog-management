<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Google_Client as BaseGoogleClient;

class CalendarController extends Controller
{
    public function __construct(BaseGoogleClient $client)
    {
        $this->client = $client;
    }

    public function index()
    {
        //kiểm tra credentials và token có tồn tại hay không
        if (!file_exists(config('google-api.client_path'))) {
            throw new \Exception(
                'You have not create client for application.'
                . ' Please create on "console.google.com" and save to your storage "storage/google/credentials.json"!'
            );
        }
        $this->client->setAuthConfig(config('google-api.client_path'));
        $this->client->setSubject('https://blog-management.com/');
        $this->client->setAccessType('offline');

        $credentialsPath = config('google-api.token_path');
        if (!file_exists($credentialsPath)) {
            throw new \Exception('Do not receive access token. Please run command "php artisan google:get-token" to get token!');
        }

        $accessToken = json_decode(file_get_contents($credentialsPath), true);
        $this->client->setAccessToken($accessToken);

        // nếu token hết hạn sẽ tiến hành refresh lại token để sử dụng
        if ($this->client->isAccessTokenExpired()) {
            $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());
            file_put_contents($credentialsPath, json_encode($this->client->getAccessToken()));
        }
        // dd($this->client);

        $calendarService = new \Google_Service_Calendar($this->client);
        // dd($calendarService);

        $dt = Carbon::now();
        // $event = new \Google_Service_Calendar_Event([
        //     'summary'     => 'title',
        //     'description' => 'description',
        //     'start'       => [
        //         'dateTime' => $dt,
        //     ],
        //     'end'         => [
        //         'dateTime' => $dt->addHours(1),
        //     ],
        // ]);
        // dd($calendarService->events->insert('primary', $event));

        $event = new \Google_Service_Calendar_Event([
            'summary'        => 'Google I/O 2',
            'location'       => 'HCM',
            'description'    => 'Google I/O - send to another gmail have google meeting link (and have reminder), notification.',
            'start'          => [
                'dateTime' => $dt,
            ],
            'end'            => [
                'dateTime' => $dt->addHours(1),
            ],
            'attendees'      => [
                [
                    'email' => 'trantuananh1986104@gmail.com',
                ],
            ],
            //with google meeting link
            "conferenceData" => [
                "createRequest" => [
                    "conferenceSolutionKey" => [
                        "type" => "hangoutsMeet",
                    ],
                    "requestId"             => "123",
                ],
            ],
            //reminder
            // 'reminders' => array(
            //     'useDefault' => FALSE,
            //     'overrides' => array(
            //         array('method' => 'email', 'minutes' => 24 * 60),
            //         array('method' => 'popup', 'minutes' => 10),
            //     ),
            // ),
        ]);
        //have google meeting link
        dd($calendarService->events->insert('primary', $event, ['conferenceDataVersion' => 1, "sendNotifications" => true,]), 8);

        //no google meeting link
        // dd($calendarService->events->insert('primary', $event), 5);

        return $this->client;
    }
}
