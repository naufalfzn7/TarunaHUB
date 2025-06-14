<?php
session_start();
if (isset($_SESSION['login'])) {
    if ($_SESSION['level'] != 1 and $_SESSION['level'] != 2) {
        // Jika level bukan admin atau user, tampilkan pesan dan redirect
        echo "<script>
            alert('Hanya Admin atau Operator yang dapat mengakses halaman ini');
            document.location.href = 'anggota.php';
        </script>";
        exit();
    }
}
//membatasi halaman
if (!isset($_SESSION['login'])) {
    echo "<script>
        document.location.href = 'login.php';
    
    </script>";
    exit();
}
require 'config/app.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;

$spreadsheet = new Spreadsheet();
$activeWorksheet = $spreadsheet->getActiveSheet();

// Set headers
$activeWorksheet->setCellValue('B2', 'No');
$activeWorksheet->setCellValue('C2', 'Nama Barang');
$activeWorksheet->setCellValue('D2', 'Jumlah');
$activeWorksheet->setCellValue('E2', 'Harga');
$activeWorksheet->setCellValue('F2', 'Tanggal');

// Style untuk header
$headerStyle = [
    'font' => [
        'bold' => true,
    ],
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => 'CCCCCC'
        ]
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['rgb' => '000000']
        ]
    ]
];

// Terapkan style ke header
$activeWorksheet->getStyle('B2:F2')->applyFromArray($headerStyle);

$data_barang = select('SELECT * FROM barang ORDER BY id_barang DESC');
$no = 1;
$start = 3; // Start from row 3 to leave space for headers
$total_harga = 0; // Variable untuk menyimpan total harga

foreach ($data_barang as $barang) {
    $activeWorksheet->setCellValue('B' . $start, $no);
    $activeWorksheet->setCellValue('C' . $start, $barang['nama']);
    $activeWorksheet->setCellValue('D' . $start, $barang['jumlah']);

    // Simpan harga dalam format angka untuk perhitungan
    $harga = $barang['harga'];
    $activeWorksheet->setCellValue('E' . $start, $harga);

    $activeWorksheet->setCellValue('F' . $start, date('d-m-Y', strtotime($barang['tanggal'])));

    // Tambahkan ke total harga
    $total_harga += $harga;

    $no++;
    $start++;
}

// Simpan row terakhir data untuk border
$lastDataRow = $start - 1;

// Style untuk border data
$dataStyle = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['rgb' => '000000']
        ]
    ]
];

// Terapkan border ke semua data (termasuk header)
$activeWorksheet->getStyle('B2:F' . $lastDataRow)->applyFromArray($dataStyle);

// Tambahkan baris kosong setelah data
$start++;

// Tambahkan label dan total harga
$activeWorksheet->setCellValue('D' . $start, 'TOTAL HARGA:');
$activeWorksheet->setCellValue('E' . $start, $total_harga);

// Format styling untuk total
$totalStyle = [
    'font' => [
        'bold' => true
    ],
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => 'FFFF00'
        ]
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THICK,
            'color' => ['rgb' => '000000']
        ]
    ]
];

$activeWorksheet->getStyle('D' . $start . ':E' . $start)->applyFromArray($totalStyle);

// Format currency untuk kolom harga
$activeWorksheet->getStyle('E3:E' . $lastDataRow)->getNumberFormat()
    ->setFormatCode('[$Rp-421] #,##0');

// Format currency untuk total
$activeWorksheet->getStyle('E' . $start)->getNumberFormat()
    ->setFormatCode('[$Rp-421] #,##0');

// Auto size columns
$activeWorksheet->getColumnDimension('B')->setAutoSize(true);
$activeWorksheet->getColumnDimension('C')->setAutoSize(true);
$activeWorksheet->getColumnDimension('D')->setAutoSize(true);
$activeWorksheet->getColumnDimension('E')->setAutoSize(true);
$activeWorksheet->getColumnDimension('F')->setAutoSize(true);

$writer = new Xlsx($spreadsheet);
$writer->save('data-excel-barang.xlsx');

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="data-excel-barang.xlsx"');
readfile('data-excel-barang.xlsx');
unlink('data-excel-barang.xlsx'); // Delete the file after download
exit();
