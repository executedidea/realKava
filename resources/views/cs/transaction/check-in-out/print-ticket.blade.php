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

$printer -> feed(1);
$printer -> setTextSize(1,1);
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> text($carwash_data[0]->outlet_name);
$printer -> text("\n");
$printer -> text($carwash_data[0]->outlet_detail_address);
$printer -> text("\n");
$printer -> feed(3);
$printer -> setTextSize(2,2);
$printer -> text("Queue No");
$printer -> text("\n");
$printer -> feed(1);
$printer -> text($checked_in_customer[0]->check_in_ticket+1);
$printer -> text("\n");
$printer -> feed(3);
$printer -> setTextSize(1,1);
$printer -> text($checked_in_customer[0]->check_in_time . "\n");
$printer -> feed(1);
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> text("License Number : " . $checked_in_customer[0]->customer_detail_licensePlate . "\n");
$printer -> text("Brand          : " . $checked_in_customer[0]->vehicle_brand_name . "\n");

$printer->feed(3);

$printer -> cut();
$printer -> close();

function title(Printer $printer, $text)
{
    $printer -> selectPrintMode(Printer::MODE_EMPHASIZED);
    $printer -> text("\n" . $text);
    $printer -> selectPrintMode(); // Reset
}
?>
