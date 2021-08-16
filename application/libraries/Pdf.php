<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Pair TCPDF library as PDF Generation tool here.
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class Pdf extends TCPDF
{
    function __construct()
    {
        parent::__construct();
    }
}

// TCPDF from Github Repo Release Cloned in this Folder.