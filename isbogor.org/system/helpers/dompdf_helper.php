<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function pdf_create($html, $filename='', $stream=TRUE) 
{
    require_once("dompdf-0.6.1/dompdf_config.inc.php");

    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $dompdf->render();
    if ($stream) {
        $dompdf->stream($filename.".pdf");
    } else {
        return $dompdf->output();
    }
}


/* End of file dompdf_helper.php */
/* Location: ./system/helpers/dompdf_helper.php */
?>