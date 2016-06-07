<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->model('post');
        $this->load->helper('string');
        $data["posts"] =$this->post->getLatestPosts(10);
        
        $data["page_title"] = 'News';
        $data["title"] = 'News';
        $data['pages'] =['home/home.php'];
        
        $this->load->view('template/default', $data);
    }
    
    public function downloadPdf() {
        $this->load->model('post');
         
        $id = $this->input->post('id');
        $data["post"] = $this->post->getPost($id);
        $html = $this->load->view('home/single', $data, true);
         //load the view and saved it into $html variable
 
        //this the the PDF filename that user will get to download
        $pdfFilePath = $id .".pdf";
 
        //load mPDF library
        $this->load->library('m_pdf');
 
       //generate the PDF from the given html
        $this->m_pdf->pdf->WriteHTML($html);
 
        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "D"); 
    }
    
    public function single($id) {
         $this->load->model('post');
         
        $data["post"] = $this->post->getPost($id);
        
        $data["title"] = 'News';
        $data["page_title"] = $data["title"];
        $data['pages'] =['home/single.php'];
        
        $this->load->view('template/default', $data);
    }
}