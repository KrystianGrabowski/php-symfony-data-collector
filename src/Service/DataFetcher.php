<?php
namespace App\Service;

class DataFetcher
{
    public function fetch($url)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url
        ]);
        $resp = curl_exec($curl);
        curl_close($curl);
        return json_decode($resp, true);
    }
}
?>