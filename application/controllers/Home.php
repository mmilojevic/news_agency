<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->model('post');
        $this->load->helper('string');
        $data["posts"] =$this->post->getLatest(10);
        
        $data["page_title"] = 'News';
        $data["title"] = 'News';
        $data["jscripts"][0] = JS_PATH ."home/Home.js";
        $data['initializes']["Home"] = [''];
        $data['pages'] =[
            'home/v_home.php'
        ];
        
        $this->load->view('template/default', $data);
//        //load the view and saved it into $html variable
//        $html= $this->load->view('template/default', $data, true);
// 
//        //this the the PDF filename that user will get to download
//        $pdfFilePath = "output_pdf_name.pdf";
// 
//        //load mPDF library
//        $this->load->library('m_pdf');
// 
//       //generate the PDF from the given html
//        $this->m_pdf->pdf->WriteHTML($html);
// 
//        //download it.
//        $this->m_pdf->pdf->Output($pdfFilePath, "D");      
    }
    
}