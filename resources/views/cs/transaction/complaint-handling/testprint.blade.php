<?php


require __DIR__ . '/../../../vendor/autoload.php';; //Nota: si renombraste la carpeta a algo diferente de "ticket" cambia el nombre en esta línea
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

/*
	Este ejemplo imprime un
	ticket de venta desde una impresora térmica
*/


/*
    Aquí, en lugar de "POS" (que es el nombre de mi impresora)
	escribe el nombre de la tuya. Recuerda que debes compartirla
	desde el panel de control
*/

$nombre_impresora = "Receipt Printer"; 


$connector = new WindowsPrintConnector($nombre_impresora);
$printer = new Printer($connector);
#Mando un numero de respuesta para saber que se conecto correctamente.
echo 1;
/*
	Vamos a imprimir un logotipo
	opcional. Recuerda que esto
	no funcionará en todas las
	impresoras

	Pequeña nota: Es recomendable que la imagen no sea
	transparente (aunque sea png hay que quitar el canal alfa)
	y que tenga una resolución baja. En mi caso
	la imagen que uso es de 250 x 250
*/

/* Initialize */
$printer -> initialize();

title($printer, "Font A sizes\n");
$printer -> setFont(Printer::FONT_A);
$printer -> setTextSize(1, 1);
$printer -> text("The quick brown fox jumps over the lazy dog.\n");
$printer -> setTextSize(8, 8);
$printer -> text("The quick brown fox jumps over the lazy dog.\n");

title($printer, "Font B sizes\n");
$printer -> setFont(Printer::FONT_B);
$printer -> setTextSize(1, 1);
$printer -> text("The quick brown fox jumps over the lazy dog.\n");
$printer -> setTextSize(2, 2);
$printer -> text("The quick brown fox jumps over the lazy dog.\n");

$printer -> cut();
$printer -> close();

function title(Printer $printer, $text)
{
    $printer -> selectPrintMode(Printer::MODE_EMPHASIZED);
    $printer -> text("\n" . $text);
    $printer -> selectPrintMode(); // Reset
}
?>
