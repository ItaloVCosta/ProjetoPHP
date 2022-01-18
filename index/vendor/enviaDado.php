
<?php

require __DIR__.'/autoload.php';

Class enviaDado{

    public static function enviaRedesSociais($redeSocial, $usuarios){
        $dbFile = 'database/database.sqlite';

        $db = new PDO("sqlite:$dbFile");

        $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try {
            $stmt_h = $db -> prepare ('insert into rede_sociais values (:val_1, :val_2, :val_3)');

            $stmt_h -> bindParam(':val_1', $v1);
            $stmt_h -> bindParam(':val_2', $v2);
            $stmt_h -> bindParam(':val_3', $v3);

            $v1 = null;
            $v2 = $redeSocial;
            $v3=  $usuarios;
            $stmt_h -> execute();


        }
        catch(PDOException $e) {

            print ("exception " . $e->getMessage());
  
        } 
    }
    public static function enviaVerbas($idDeputado,$mes,$nomeDeputado,$valor){
        $dbFile = 'database/database.sqlite';

        $db = new PDO("sqlite:$dbFile");

        $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try {
            $stmt_h = $db -> prepare ('insert into verba_indenizatorias values (:val_1, :val_2, :val_3, :val_4,:val_5)');

            $stmt_h -> bindParam(':val_1', $v1);
            $stmt_h -> bindParam(':val_2', $v2);
            $stmt_h -> bindParam(':val_3', $v3);
            $stmt_h -> bindParam(':val_4', $v4);
            $stmt_h -> bindParam(':val_5', $v5);
            
            $v1=null;
            $v2 = $idDeputado;
            $v3 =$mes;
            $v4=$nomeDeputado;
            $v5=$valor;
            $stmt_h -> execute();

        }
        catch(PDOException $e) {

            print ("exception " . $e->getMessage());
  
        } 
    }
}
