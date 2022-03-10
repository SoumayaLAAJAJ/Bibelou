<?php   

namespace App\Classe;

use Mailjet\Client;
use Mailjet\Resources;

class Mail{
    private $api_key = 'e9ea1f1be832d944b33767ca5ad68cc3';
    private $api_secret_key = '7bd41e6560fc983d8d667dcdd41f13d0';

    public function send($to_email, $to_name, $subject, $content, $total_price, $order_date, $order_id){
        $mj = new Client($this->api_key, $this->api_secret_key, true,['version' => 'v3.1']);
        // $mj = new \Mailjet\Client(getenv('MJ_APIKEY_PUBLIC'), getenv('MJ_APIKEY_PRIVATE'),true,['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "boutique.bibelou@gmail.com",
                        'Name' => "Bibelou"
                    ],
                    'To' => [
                        [
                            'Email' => $to_email,
                            'Name' => $to_name
                        ]
                    ],
                    'TemplateID' => 3729444,
                    'TemplateLanguage' => true,
                    'Subject' => $subject,
                    'Variables' => [
                        'content' => $content,
                        'total_price' => $total_price,
                        'order_date' => $order_date,
                        'order_id' => $order_id
                        
                    ]
                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success();
    }
}