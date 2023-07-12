<?php ob_start(); error_reporting(-1);
  ini_set('display_errors', 'On'); 


require_once 'vendor/autoload.php';
/*Integrator ID:
★ dev_24c65fb163bf11ea96500242ac130004
Test User (Vendedor) | Producción
★ Access Token:
APP_USR-8709825494258279-092911-227a84b3ec8d8b30fff364888abeb67a-1160706432
★ Public Key:
APP_USR-ff96fe80-6866-4888-847e-c69250754d38
Test User (Comprador o pagador)
★ Email:
test_user_36961754@testuser.com*/
//Mastercard 5031 7557 3453 0604 123 11/25

/**** test APRO  ***/
/*** https://web-develop.com.ar/mp-ecommerce-php/notification-mp.php?data_id=60657401474 ***/

$TOKEN="APP_USR-8709825494258279-092911-227a84b3ec8d8b30fff364888abeb67a-1160706432";
$PUBLICKEY="APP_USR-ff96fe80-6866-4888-847e-c69250754d38";


#pagos
$URL_RETURN="https://web-develop.com.ar/mp-ecommerce-php/respuesta.php?id=success";
$URL_RETURN_PENDING="https://web-develop.com.ar/mp-ecommerce-php/respuesta.php?id=pending";
$URL_RETURN_FAILURE="https://web-develop.com.ar/mp-ecommerce-php/respuesta.php?id=failure";
$URL_IPN="https://web-develop.com.ar/mp-ecommerce-php/notification-mp.php";
#sub  
$URL_RETURN_SUB="https://web-develop.com.ar/mp-ecommerce-php/sub/notificationsub-mp.php";


MercadoPago\SDK::setAccessToken($TOKEN);
$payment = MercadoPago\Payment::find_by_id($_GET["data_id"]);


  /*  print "<pre>";
    print_r($payment);
    print "</pre>"; */



if($payment->status == "approved"){
   


    $bodylog = @file_get_contents('php://input');

    file_put_contents('notificaciones/'.$payment->id.".json", $bodylog);


 // header("location: " . $URL_RETURN); 
    
}else{
    header("location: " . $URL_RETURN_FAILURE);
}
?>
<?php ob_end_flush();?>