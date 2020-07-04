<?php

namespace App\Services;

use TCPDF;
use App\Company_infomation;
use App\Receipt;
use App\receipt_detail;

class ReceiptPrintService
{
    public function __construct(TCPDF $pdf)
    {
        $this->pdf = $pdf;
    }

    public function printPDF(Company_infomation $company, Receipt $receipt, $details)
    {
        $this->pdf->AddPage();
        $this->pdf->SetFont("kozgopromedium", "", 10);
        $this->pdf->writeHTML(view("form.sampleReceipt", compact('company','receipt','details')));
        $this->pdf->Output('receipt.pdf', 'I');
    }
}
