<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'vendor/autoload.php';
require 'lib/Algorithm.php';
require 'preferred_brands.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (!isset($_FILES['file'])) {
    die("No file uploaded");
}

$pages = intval($_POST['pages'] ?? 10);
$per_page = intval($_POST['per_page'] ?? 30);
$min_stock = intval($_POST['min_stock'] ?? 1);
$prefer_mode = isset($_POST['prefer_mode']);
$preferred_ratio = floatval($_POST['preferred_ratio'] ?? 0.7);
$preferred_cap = intval($_POST['preferred_cap'] ?? 2);

$tmp = $_FILES['file']['tmp_name'];
$spreadsheet = IOFactory::load($tmp);
$sheet = $spreadsheet->getActiveSheet();
$data = $sheet->toArray(null, true, true, true);

list($assigned, $summary) = runAssignment($data, $pages, $per_page, $min_stock,
    $prefer_mode, $PREFERRED_BRANDS, $preferred_ratio, $preferred_cap);

$out = new Spreadsheet();
$out->getActiveSheet()->fromArray($assigned, null, 'A1');
$sumSheet = $out->createSheet();
$sumSheet->setTitle('SUMMARY');
$sumSheet->fromArray($summary, null, 'A1');

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="products_assigned.xlsx"');
$writer = new Xlsx($out);
$writer->save('php://output');
exit;
?>
