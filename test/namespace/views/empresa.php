<hmtl><title>Datos test namespace</title></hmtl>
<?php

//require_once ("../controllers/Empleado.php");
//require_once ("../controllers/Cliente.php");
//require_once ("../controllers/Persona.php");
require_once ("../autoload.php");

use controllers\Empleado;
use controllers\Cliente;
use controllers\Persona;


	$objEmpleado = new Empleado(78978,"Andres Pérez",25);
	$objEmpleado->setPuesto("Administrador");
	$objEmpleado->setMensaje("Bienvenido empleado ");

	echo $objEmpleado->getMensaje();
	echo $objEmpleado->getDatosPersonales();
	echo "Puesto:".$objEmpleado->getPuesto();


	echo "<br><br><br>";
	$objCliente = new Cliente(434543,"Elena Castillo",20);
	$objCliente->setCredito(1000);
	$objCliente->setMensaje("Bienvenido cliente ");

	echo $objCliente->getMensaje();
	echo $objCliente->getDatosPersonales();
	echo "Créditos:".$objCliente->getCredito();


echo "<br><br><br>";

      $mensaje= new Persona();
      echo  $mensaje->saludo();

 ?>