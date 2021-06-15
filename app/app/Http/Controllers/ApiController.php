<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Ixudra\Curl\Facades\Curl;
use function PHPUnit\Framework\isNull;

class ApiController extends Controller
{
    protected $api_token;
    protected $api_url;


    public function __construct()
    {
        $this->api_url = config('services.api_settings.api_url');
        $this->api_token = config('services.api_settings.api_token');
    }
    public function execApi($method, $link, $data = null)
    {
        $result = '';

        switch ($method){
            case 'post':
                $result = Curl::to($this->api_url . $link)
                    ->withHeader('X-token: '. $this->api_token)
                    ->withData($data)
                    ->asJson( true )
                    ->asJsonResponse()
                    ->post();
            break;
            case 'get':
                $result = Curl::to($this->api_url . $link)
                    ->withHeader('X-token: '. $this->api_token)
                    ->withData($data)
                    ->asJsonResponse()
                    ->get();
            break;
        }

        return $result;
    }

    public function allTickets()
    {
        $result = $this->execApi('get', '/tickets', null);
        return json_decode(json_encode($result), true)['items'];

    }

    public function newTicket($ticket_name, $comment)
    {
        if (! isnull(config('services.api_settings.api_email_client'))) {
            $data = [
                'summary' => $ticket_name,
                'comment_body' => $comment
            ];
        } else {
            $data = [
                'summary' => $ticket_name,
                'comment_body' => $comment,
                'client_emails' => [
                    config('services.api_settings.api_email_client')
                ]
            ];
        }

//        return "error: create, reply to email: " . config("services.api_settings.api_email_client");

        $result = $this->execApi('post', '/tickets', $data);
        return json_decode(json_encode($result), true);
    }

    public function showTicket($ticket_id)
    {
        $ticket_data = json_decode(json_encode($this->execApi('get', '/tickets/'.$ticket_id, null)), true);
        $ticket_data['comments']  = json_decode(json_encode($this->execApi('get', '/tickets/'.$ticket_id.'/comments', null)), true)['items'];

        return $ticket_data;
    }

    public function updateTicket($ticket_id, $comment)
    {
        return json_decode(json_encode($this->execApi('post', '/tickets/' . $ticket_id . '/comments', ['body' => $comment])), true);
    }

    public function closeTicket($ticket_id, $score = null)
    {
        if ($score != '10') {
            $data = null;
        } else {
            $data = [
                'comment' => 'Вопрос решен',
                'score' => 10
            ];
        }

        return json_decode(json_encode($this->execApi('post', '/tickets/' . $ticket_id . '/close', $data)), true);
    }
}
