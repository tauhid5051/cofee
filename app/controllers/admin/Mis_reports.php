<?php

use PHPJasper\PHPJasper;


defined('BASEPATH') or exit('No direct script access allowed');

class Mis_reports extends MY_Controller
{
    private $PHPJasper;

    public function __construct()
    {
        parent::__construct();

        if (!$this->loggedIn) {
            $this->session->set_userdata('requested_page', $this->uri->uri_string());
            $this->sma->md('login');
        }

        $this->lang->admin_load('reports', $this->Settings->user_language);
        $this->load->library('form_validation');
        $this->load->admin_model('reports_model');
        $this->load->admin_model('products_model');
        $this->PHPJasper = new PHPJasper();

        $this->data['pb'] = [
            'cash'       => lang('cash'),
            'CC'         => lang('CC'),
            'Cheque'     => lang('Cheque'),
            'paypal_pro' => lang('paypal_pro'),
            'stripe'     => lang('stripe'),
            'gift_card'  => lang('gift_card'),
            'deposit'    => lang('deposit'),
            'authorize'  => lang('authorize'),
        ];

        $this->load->helper('pos');
        $this->load->admin_model('companies_model');
    }

    public function index()
    {


        // $this->sma->checkPermissions();


        // $this->sma->print_arrays($this->sma->checkPermissions());


        $data['error']               = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
        $this->data['monthly_sales'] = $this->reports_model->getChartData();
        $this->data['stock']         = $this->reports_model->getStockValue();
        $bc                          = [['link' => base_url(), 'page' => lang('home')], ['link' => '#', 'page' => lang('reports')]];
        $meta                        = ['page_title' => lang('reports'), 'bc' => $bc];
        $this->page_construct('mis_reports/index', $meta, $this->data);
    }


    public function openModal($type = null, $subtype = null)
    {

        $user_id = null;
        $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
        $this->data['users'] = $this->reports_model->getStaff();
        $this->data['user_id'] = $user_id;
        $this->data['warehouse'] = $this->site->getWarehouseByID($this->Settings->default_warehouse ? $this->Settings->default_warehouse : 1);
        $this->data['modal_js'] = $this->site->modal_js();
        $this->data['type'] = $type;
        $this->data['subtype'] = $subtype;

        //$this->print_arrays($subtype);

        switch ($type) {
            case 'paymentSummeryReport':
                $this->data['reportType'] = 'User Wise Collection';
                $this->data['subReport'] = true;
                break;
            case 'paymentSummaryDayReport':
                $this->data['reportType'] = 'Date Wise Collection';
                $this->data['subReport'] = false;
                break;
            default:
                echo "no type";
                break;
        }

        $this->load->view($this->theme . 'mis_reports/report_modals', $this->data);
    }




    public function createJasper()
    {

        // $this->listParametersExample();
        //$this->print_arrays($this->input->post());

        $name = $this->input->post('type');
        $subname = $this->input->post('subtype');
        $format = $this->input->post('format');
        $input = FCPATH . 'jasper/compiled/' . $name . '.jasper';
        $outputfile =  'jasper/output/' . $name . '.' . $format;
        $output = FCPATH . 'jasper/output';

        $this->compileExample($name, $subname);


        $options = [
            // 'format' => $this->input->post('format'),
            'format' => ['pdf'],
            'locale' => 'en',
            'params' => [
                'startDate' => $this->input->post('startDate'),
                'createdBy' => $this->input->post('createdBy'),
                'endDate' => $this->input->post('endDate'),
                'address' => $this->input->post('branchAddress'),
                'branchName' => $this->data['Settings']->site_name,
                //'SUBREPORT_DIR' => FCPATH . 'jasper/resources',
            ],
            'resources' => '"' . FCPATH . 'jasper/compiled' . '"', //place of resources	
            'db_connection' => $this->config->item('jasper')
        ];

        if ($this->input->post('subReport') == false) {
            unset($options['resources']);
        }

        // $this->print_arrays($outputfile);

        $this->PHPJasper->process($input, $output, $options)->execute();
        redirect($outputfile);
    }

    public function compileExample($name = null, $subname = null)
    {
        if ($name) {
            $input_file = FCPATH . 'jasper/compiled/' . $name . '.jrxml';
            $output_file = FCPATH . 'jasper/compiled';
            $this->PHPJasper->compile($input_file, $output_file)->execute();
        }
        if ($subname) {
            $input_file = FCPATH . 'jasper/compiled/' . $subname . '.jrxml';
            $output_file = FCPATH . 'jasper/compiled';
            $this->PHPJasper->compile($input_file, $output_file)->execute();
        }
    }


    public function listParametersExample()
    {
        $input = FCPATH . 'jasper/input/paymentSummeryReport.jrxml';
        $output = $this->PHPJasper->listParameters($input)->execute();

        foreach ($output as $parameter_description) {
            print '<pre>' . $parameter_description . '</pre>';
        }
    }
}
