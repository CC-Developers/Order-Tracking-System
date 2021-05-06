<?php namespace helpers\fpdf;
/**
* This file may not be redistributed in whole or significant part.
* ---------------- THIS IS NOT FREE SOFTWARE ---------------- 
*
* @file       helpers/fpdf/pdf.php
 * @package    Work Order Tracking System
 * @author     Comestoarra Labs <hello@comestoarra.com>
 * @copyright  2014 PT. Comestoarra Bentarra Noesantarra All Rights Reserved.
 * @license    http://codecanyon.net/licenses
 * @version    Release: @1.0@
 * @link       http://wots.comestoarra.com/v1/
 * @framework  http://simplemvcframework.com
*/

/* _COMESTOARRA_LABS_ */
class pdf extends fpdf {

    public function __construct ($orientation = 'P', $unit = 'pt', $format = 'Letter', $margin = 40) 
    {
        $this->FPDF($orientation, $unit, $format);
        $this->SetTopMargin($margin);
        $this->SetLeftMargin($margin);
        $this->SetRightMargin($margin);
        
        $this->SetAutoPageBreak(true, $margin);
    }
    
    public function Header () 
    {
        $this->SetFont('Arial', 'B', 18);
        $this->SetFillColor(255,255,255);
        $this->SetTextColor(153,153,153);
        $this->Cell(0, 25, _INVOICE_LANG_, 0, 1, 'C', true);
        $this->SetTextColor(62,20,185);
        $this->Cell(0, 20, SITETITLE, 0, 1, 'C', true);
        $this->SetFont('Arial','I',11);
        $this->Cell(0, 20, "", 0, 1, 'C', true);
        $this->SetTextColor(122,118,134);
        $this->Cell(0, 25, BARTITLE, 0, 1, 'C', true);
        $uploaddir = "uploads/logo/default.png";
        $this->Image($uploaddir,50,30,100);
        $this->Line(40, 130, 610-40, 130);
    }
    
    public function Footer () 
    {
        $this->SetFont('Arial', '', 8);
        $this->SetTextColor(122,118,134);
        $this->SetXY(40, -60);
        $this->Cell(0, 20, SITETITLE, 'T', 0, 'C');
        $this->Ln(0);
        $this->Cell(0,45, BARTITLE, 'T', 0, 'C');
        $this->Ln(0);
        $this->Cell(0, 65, SITEMAIL, 'T', 0, 'C');
        $this->SetY(-15);
        $this->SetFont('Arial','I',6);
        $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
    } 


}