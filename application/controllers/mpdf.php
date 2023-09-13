<?php
defined('BASEPATH') or exit('No direct script access allowed');




class mpdf extends CI_Controller
{
    public function mpdf()
    {
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML('<h1>Hello world!</h1>');
        $mpdf->Output();
    }
}
