<?php
require_once APPPATH . 'libraries/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class Dompdf_lib
{
    public $dompdf;

    public function __construct()
    {
        $options = new Options();
        $options->set('isRemoteEnabled', true); // Enable remote images, etc.

        $this->dompdf = new Dompdf($options);
    }
}
