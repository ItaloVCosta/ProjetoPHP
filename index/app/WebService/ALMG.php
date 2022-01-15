<?php

namespace app\WebService;

class ALMG{


    public static function consultarDeputado(){
         
        $curl = curl_init();

        // Confg do curl
        curl_setopt_array($curl,[
            CURLOPT_URL => 'http://dadosabertos.almg.gov.br/ws/legislaturas/19/deputados/situacao/1?formato=json',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET'
        ]);

        // Response
        $response = curl_exec($curl);

        // Fechando a conexão
        curl_close($curl);

        //print_r($response); 

        $array = json_decode($response,true);

        return $array;
    }
}