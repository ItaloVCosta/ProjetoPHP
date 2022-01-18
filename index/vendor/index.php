<?php

require __DIR__.'/autoload.php';
require __DIR__.'/enviaDado.php';

//dependencias
use \App\WebService\ViaCEP;
use \App\WebService\ALMG;


//*********************************************************************************** */
// Parte que solicita e organiza os dados das redes sociais
 
 $deputados = ALMG::consultarDeputado();

 $usoDasRedes = array(
    array("ID"=>0, "NOME"=>"Instagram",   "usuarios"=>0),
    array("ID"=>1, "NOME"=>"Facebook",   "usuarios"=>0),
    array("ID"=>2, "NOME"=>"SoundCloud",   "usuarios"=>0),
    array("ID"=>3, "NOME"=>"Twitter",   "usuarios"=>0),
    array("ID"=>4, "NOME"=>"Youtube",   "usuarios"=>0),
    array("ID"=>5, "NOME"=>"WhatsApp",   "usuarios"=>0),
    array("ID"=>6, "NOME"=>"Flickr",   "usuarios"=>0),
    array("ID"=>7, "NOME"=>"LinkedIn",   "usuarios"=>0),

);

  foreach($deputados['list'] as $value)
{
    $deputadoeId[]=array("Nome"=>$value['nome'],"Id"=>$value['id']);
    $dadoDeputado = ALMG::consultarDadoDeputado($value['id']);
    sleep(1);

       foreach($dadoDeputado['deputado']['redesSociais'] as $value2)
    {
        switch(strtolower($value2['redeSocial']['nome']))
        {
            case 'facebook';
                $usoDasRedes[0]['usuarios']++;
                break;
            case 'instagram';
                $usoDasRedes[1]['usuarios']++;
                break;
            case 'soundcloud';
                $usoDasRedes[2]['usuarios']++;
                break;
            case 'twitter';
                $usoDasRedes[3]['usuarios']++;
                break;
            case 'youtube';
                $usoDasRedes[4]['usuarios']++;
                break;
            case 'whatsapp';
                $usoDasRedes[5]['usuarios']++;
                break;
            case 'flickr';
                $usoDasRedes[6]['usuarios']++;
                break;
            case 'linkedin';
                $usoDasRedes[7]['usuarios']++;
                break;
        }
    }    
} 

//print_r("Redes sociais e sua utilizacao:\n\n");

$columns = array_column($usoDasRedes, 'usuarios');
array_multisort($columns, SORT_DESC, $usoDasRedes);

/* for($i=0;$i<8;$i++) // For para printar as redes sociais no console caso necessario
    print_r($usoDasRedes[$i]["NOME"].": ".$usoDasRedes[$i]["usuarios"]." usuarios\n"); 
print_r("*************************************\n");   */ 
 
//*********************************************************************************** */

//*********************************************************************************** */
// Funcao que solicida e organiza os dados das verbas indenizatórias

   function verbasdosDeputados($mes, $deputadoeId)
{
    foreach($deputadoeId as $value3)
    {   
        $total=0;
        $verbaIndenizatoria=ALMG::consultarDadoVerbaIndenizatoria($value3['Id'],$mes);
        sleep(1.2);

        foreach($verbaIndenizatoria['list'] as $value4)
        {
            $total+=$value4['valor'];
        }
        $verbasMes[]=array("Nome"=>$value3['Nome'],"Id"=>$value3['Id'],"Total Pedido"=>$total);
    }  

    $columns = array_column($verbasMes, 'Total Pedido');
    array_multisort($columns, SORT_DESC, $verbasMes);
    array_splice($verbasMes,5,count($verbasMes)-5);
    return ($verbasMes);
}  
$meses=array("Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");

for($i=0;$i<=11;$i++)
    $verbasAno[]=array($meses[$i] => verbasdosDeputados($i+1,$deputadoeId));

//*********************************************************************************** */
// Enviando para o banco de dados

for($i=0;$i<8;$i++)
    enviaDado::enviaRedesSociais($usoDasRedes[$i]["NOME"],$usoDasRedes[$i]["usuarios"]);

     foreach($verbasAno as $value5)
    {      
        foreach($value5 as $value6)
        {
            foreach($value6 as $value7)
            {   
                enviaDado::enviaVerbas($value7['Id'],key($value5),$value7['Nome'],$value7['Total Pedido']);
            }
        }
    }