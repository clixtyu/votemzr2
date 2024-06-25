<?php
require('../pdf/fpdf.php');
include '../koneksi.php';

// Instanciation of inherited class
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->Cell(0,5,'Hasil Rekapitulasi','0','3','C',false);

$pdf->Cell(190,0.6,'','0','1','C',true);
$pdf->Ln(5);


$no = 1;
$query = mysqli_query($koneksi, "SELECT * FROM tb_kandidat");
while ($data = mysqli_fetch_array($query)) {
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(35,6,'Nama Kandidat',1,0,'C');
    $pdf->Cell(7,6,':','C');
    $pdf->Cell(35,6,$data['nama_calon'],'C');
    $pdf->Ln(10);
    $pdf->Cell(35,6,'Total Suara',1,0,'C');
    $pdf->Cell(7,6,':','C');
    $pdf->Cell(35,6,$data['suara'],'C');
    $pdf->Ln(8);
    $pdf->Cell(190,0.6,'','0','1','C',true);
    $pdf->Ln(3);
}
$pdf->Output();
?>