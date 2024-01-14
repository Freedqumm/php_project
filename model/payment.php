<?php


require_once "../public/rsc/fpdf.php";
require_once "order.php";

session_start();

class PDF extends FPDF
{
    function BasicTable($header, $data)
    {
        // En-tête
        $height = 12;
        $this->SetFont('Arial', 'B', 10);
        foreach ($header as $col) {
            $str = iconv('UTF-8', 'windows-1252', $col);
            $this->Cell(38, $height, $str, "TB");

        }
        $this->Ln(); // Données

        $this->SetFont('Arial', '', 10);
        foreach ($data as $row) {
            foreach ($row as $col) {

                if (substr($col, -3) === "jpg" || substr($col, -3) === "png" ) {   
                    
                    $this->Image("../public/images/$col", $this->GetX() + 5, $this->GetY(), 12);
                    $this->Cell(38, $height, "", "TB");
                } else {
                    $str = iconv('UTF-8', 'windows-1252', $col);
                    $this->Cell(38, $height, $str, "TB");
                }
            }
            $this->Ln();
        }
    }
}

$pdf = new PDF();
$pdf->AddPage();


// Titre 
$pdf->SetFont('Arial', 'B', 20);
$pdf->Cell(38, 12, "Facture pour votre commande", "");

$pdf->Ln();
$pdf->Ln();

// Client 
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(130, 12, "", "");
$pdf->Cell(52, 12, $_SESSION['user']['surname']." ".$_SESSION['user']['forname'], "TLR");
$pdf->SetY($pdf->GetY() + 6);
$pdf->Cell(130, 12, "", "");
$pdf->Cell(52, 12, $_SESSION['adress'][2], "LR");
$pdf->SetY($pdf->GetY() + 6);
$pdf->Cell(130, 12, "", "");
$pdf->Cell(52, 12, $_SESSION['adress'][1]." ".$_SESSION['adress'][0], "BLR");

$pdf->Ln();
$pdf->Ln();

// Recapitulatif de commande
$header = array('id', 'Nom du produit', '', 'Prix', 'Quantité');
$pdf->BasicTable($header, $_SESSION['cart']);

// Total
$total = 0;
foreach ($_SESSION['cart'] as $product) {
    $total += $product['price'];
}

$pdf->ln();
$pdf->cell(120, 6, "");
$pdf->SetFont('Arial', 'B', 10);
$str = iconv('UTF-8', 'windows-1252', "Total facturé:");
$pdf->cell(38, 6, $str, "TLB");

$pdf->SetFont('Arial', '', 10);
$str = iconv('UTF-8', 'windows-1252', $total . "€");
$pdf->cell(30, 6, $str, "TRB");

$pdf->ln();
$pdf->ln();
$pdf->ln();
// Indication chèque 

$pdf->SetFont('Arial', 'I', 10);
$str = iconv('UTF-8', 'windows-1252', "Afin de régler votre commande, nous vous prions de bien vouloir nous faire parvenir un chèque d'une valeur du montant");
$pdf->cell(30, 6, $str);
$pdf->ln();
$str = iconv('UTF-8', 'windows-1252', "indiqué dans le champ `Total facturé` à l'ordre SARL ISI4WEB à l'adresse suivante:");
$pdf->cell(30, 6, $str);
$pdf->ln();
$pdf->SetFont('Arial', '', 12);
$str = iconv('UTF-8', 'windows-1252', "15 Bd André Latarjet, 69100 Villeurbanne");
$pdf->ln();
$pdf->cell(50, 6, "");
$pdf->cell(30, 6, $str);
 

$pdf->ln();
$pdf->ln();
$pdf->ln();

$pdf->SetFont('Arial', 'I', 10);
$str = iconv('UTF-8', 'windows-1252', "Nous vous remercions pour votre confiance et espérons vous revoir très prochainement sur ISI4WEB.com !");
$pdf->cell(30, 6, $str);
$pdf->ln();




$pdf->Output("F", "../public/rsc/docs/Facture.pdf");


saveOrder("cheque");
header("Location: ../public/?page=orderCompleted");


exit();