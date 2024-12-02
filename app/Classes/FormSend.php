<?php
namespace App\Classes;
use Illuminate\Support\Facades\App;

class FormSend
{



   public function __construct($url)
    {

        $this->url = $url;

    }

    /**

     * @param $text string

     */
  public function sendVacancy( $data)
    {
        $data = json_encode($data, JSON_UNESCAPED_UNICODE );

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'API-KEY: j59zLOpp',

            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $result = json_decode($response, true);
//        dd($result);
    }


}
