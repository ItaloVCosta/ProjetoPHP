<?php

namespace app\WebService;

class ViaCEP{

    /**
     *  Método que consulta um CEP no viaCEP
     * @param string $cep
     * @return array 
     */
    public static function consultarCEP($cep){
         
        $curl = curl_init();

        // Confg do curl
        curl_setopt_array($curl,[
            CURLOPT_URL => 'http://viacep.com.br/ws/'.$cep.'/json/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET'
        ]);

        // Response
        $response = curl_exec($curl);

        // Fechando a conexão
        curl_close($curl);

        /* print_r($response); */

        $array = json_decode($response,true);

        return $array;
    }
}