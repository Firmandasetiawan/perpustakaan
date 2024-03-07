<?php
// Panggil file FPDF
require('fpdf.php');

// Buat instance objek FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Tambahkan judul laporan
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Laporan Peminjaman Buku', 0, 1, 'C');
$pdf->Ln(10);

// Tambahkan header tabel
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(10, 10, 'No', 1, 0, 'C');
$pdf->Cell(40, 10, 'Nama Siswa', 1, 0, 'C');
$pdf->Cell(50, 10, 'Judul Buku', 1, 0, 'C');
$pdf->Cell(40, 10, 'Tanggal Peminjaman', 1, 0, 'C');
$pdf->Cell(40, 10, 'Tanggal Pengembalian', 1, 0, 'C');
$pdf->Cell(30, 10, 'Status Peminjaman', 1, 1, 'C');

// Tambahkan isi tabel (contoh data)
$pdf->SetFont('Arial', '', 12);
$data = [
    ['1', 'Firmanda Setiawan', 'Harry Potter', '2024-02-10', '2024-02-20', 'Dipinjam'],
    ['2', 'Rina Lestari', 'Lord of the Rings', '2024-02-05', '2024-02-15', 'Dikembalikan'],
    ['3', 'Budi Santoso', 'Game of Thrones', '2024-01-15', '2024-01-25', 'Dipinjam'],
];

foreach ($data as $row) {
    $pdf->Cell(10, 10, $row[0], 1, 0, 'C');
    $pdf->Cell(40, 10, $row[1], 1, 0, 'C');
    $pdf->Cell(50, 10, $row[2], 1, 0, 'C');
    $pdf->Cell(40, 10, $row[3], 1, 0, 'C');
    $pdf->Cell(40, 10, $row[4], 1, 0, 'C');
    $pdf->Cell(30, 10, $row[5], 1, 1, 'C');
}

// Outputkan laporan sebagai file PDF
$pdf->Output();
?>
