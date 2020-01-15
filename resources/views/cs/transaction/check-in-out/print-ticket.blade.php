<?php


require __DIR__ . '/../../../vendor/autoload.php';; 
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;



$nombre_impresora = "Receipt Printer"; 


$connector = new WindowsPrintConnector($nombre_impresora);
$printer = new Printer($connector);
echo 1;


/* Initialize */
$printer -> initialize();

$printer -> setTextSize(2,2);
$printer -> text("Queue No :" . $checked_in_customer[0]->check_in_ticket+1 . "\n");
$printer -> feed(1);
$printer -> setTextSize(1,1);
$printer -> text( $checked_in_customer[0]->check_in_time );
$printer -> feed(1);
$printer -> text("License Number :" . $checked_in_customer[0]->customer_detail_licensePlate . "\n");
$printer -> feed(1);
$printer -> text("Brand :" . $checked_in_customer[0]->vehicle_brand_name . "\n");

$printer->feed(5);

$printer -> cut();
$printer -> close();

function title(Printer $printer, $text)
{
    $printer -> selectPrintMode(Printer::MODE_EMPHASIZED);
    $printer -> text("\n" . $text);
    $printer -> selectPrintMode(); // Reset
}
?>
