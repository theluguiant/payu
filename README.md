API PAY U PARA LARAVEL 5.1

Theluguiant\Payu version 1.0




para instalar en composer 

{
    ......
    ......
    ......
    ......
    "require": {
         ......,
         ......,
         ......,
        "theluguiant/payu": "dev-master"
    },
    ......
    ......
    ......
}


-------------------------------------------------------------------------------



ahora damos vamos a nuestra consola y/o terminal, nos pones en la raiz 
de nuestro proyecto y escribimos el siguiente comando 

!!!atencion si no tienen el archivo composer.phar pueden descargarlo desde
la pagina oficial del composer y ahora si ingresamos el comado en nuestra terminal!!!


          php composer.phar update    



una ves no todo el proceso halla terminado nos encontraremos que la api
se intalara en la siguiente ruta

   app
     /vendor
           /theluguiat


-------------------------------------------------------------------------------


ahora nos vamos a config/app.php y en    providers   agregamos la siguiente linea

     
          Theluguiant\Payu\PayuServiceProvider::class



ahora nos vamos a config/app.php y en   aliases   agregamos la siguiente linea

          
          'Payu'      => Theluguiant\Payu\Facades\Payu::class,


-------------------------------------------------------------------------------


para usar nos vamos al controlador donde queramos hacer uso de el y agregamos
luego del   namespace App\Http\Controllers;   la siguiente linea

           
           use Payu;


con esto ya podremos usar en cualquiera de las vistas pertenecientes a este controlador
el crear boton de pago payu



-------------------------------------------------------------------------------

pero antes vamos a configurar la merchantId y accountId vamos a 

    app
     /vendor
           /theluguiat
                     /payu
                         /src
                            /Clases
                                  /PayuBotton.php



   private $_luQueryUrl = 'https://gateway.payulatam.com/ppp-web-gateway/'; //url a donde mandamos los datos de la compra
   private $_merchantId = ''; //valor numerico quitar caracteres y deja solo numeros quitar comillas
   private $_accountId  = ''; //valor numerico quitar caracteres y deja solo numeros quitar comillas
   private $_apiKey= '';  //nuestra api key

   private $_test=0; // en 0 para usarla en produccion



   ahora bien antes ir a la prueba vamos a ver una funcion dentro del archivo PayuBotton.php


  
   setSignature(): esta funcion es la que nos crea el hash para el boton es fundamental 
                   que se llenen los campos del siguiente ejemplo, de lo contrario no se 
                   generar el dato de esta funcion, y se nos presentar un error a la hora 
                   de ir a pagar 


   veamos un ejemplo



<?php
	Payu::payuBottom()->setDescription('prueba 1');//descripcion de la compra
	Payu::payuBottom()->setReferenceCode('1');//referecia de la compra y/o factura
	Payu::payuBottom()->setAmount('15000'); //saldo total de la compra y/o factura
	Payu::payuBottom()->setTax('0');//el valor del IVA
	Payu::payuBottom()->setTaxReturnBase('0');//Es el valor base sobre el cual se calcula el IVA (solo valido para Colombia). En caso de que no tenga IVA debe enviarse en 0.
	Payu::payuBottom()->setShipmentValue('0');
	Payu::payuBottom()->setCurrency('COP');//La moneda respectiva en la que se realiza el pago.
	Payu::payuBottom()->setLng('es');//	Idioma en el que se desea mostrar la pasarela de pagos.
	Payu::payuBottom()->setSourceUrl('urlOrigen');
	Payu::payuBottom()->setButtonType('SIMPLE');
	Payu::payuBottom()->setBuyerEmail('correocomprador@gmail.com');//Campo que contiene el correo electrónico del comprador para notificarle el resultado de la transacción por correo electrónico. Se recomienda hacer una validación si se toma este dato en un formulario.
	echo Payu::payuBottom()->renderPaymentForm();
  ?>
?>


para mas informacion de estos campos ir a 

http://developers.payulatam.com/es/web_checkout/integration.html


No siendo mas mil gracias por usar mi api
y espero a futuro hacer la mas util para todos
