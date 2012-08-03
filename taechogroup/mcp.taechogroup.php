<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

// =======================
// Author: Robert Banh
// Taecho Group, LLC
// Date: 
//
// =======================
class Taechogroup_mcp
{
	private $EE;
	private $base_url;
	private $data = array();

	// ==================
	// 
	// ==================
	public function __construct()
	{
		$this->EE =& get_instance();
		
		$this->base_url = BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=taechogroup';
		$this->form_action_base = AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=taechogroup';

		// set navigation
		$this->EE->cp->set_right_nav(array(
			'Index Page' => $this->base_url.AMP.'method=index',
			//'Admin Tools' => $this->base_url.AMP.'method=admin',
		));

		// load models
		$this->EE->load->model('taechogroup_model');
	}

	// ==================
	// 
	// ==================
	public function index()
	{
		// pagination stuff
		/*
		$curr_page = $this->EE->input->get('page');
		if (!$curr_page) $curr_page = 1;
		$per_page = 30;
		$total_count = $this->EE->tgregistration_model->get_total_users($this->EE->tgregistration_model->get_group_pending());
		$total_pages = ceil($total_count / $per_page);
		$limit = $per_page;
		$offset = (($curr_page == '1') ? 0 : ($limit * ($curr_page - 1)));
		
		$this->data['pagination'] = array(
			'curr_page' => $curr_page,
			'total_count' => $total_count,
			'total_pages' => $total_pages,
			'base_url' => $this->base_url.AMP.'method=index'
			);
		*/

		$this->data['all_events'] = $this->EE->taechogroup_model->get_all_events();


		$this->EE->cp->set_variable('cp_page_title', 'TG Custom Module');
		return $this->EE->load->view('index', $this->data, TRUE);
	}

	// ==================
	// 
	// ==================
	/*public function member_approve()
	{
		if (! $this->EE->cp->allowed_group('can_access_content')  OR ! $this->EE->cp->allowed_group('can_access_files'))
		{
			show_error($this->EE->lang->line('unauthorized_access'));
		}

		// process submission
		if ($this->EE->input->get('member_id'))
		{
			try
    		{
				$total_run = $this->EE->taechogroup_model->approve_user();

				$this->EE->session->set_flashdata('message_success', 'User approved!');
				$this->EE->functions->redirect($this->base_url.AMP.'method=index');
			}
			catch (Exception $e)
	        {
	            $this->EE->session->set_flashdata('message_failure', 'Error: ' . $e->getMessage());
	        }

			$this->EE->functions->redirect($this->base_url.AMP.'method=index');
		}

		$this->EE->functions->redirect($this->base_url.AMP.'method=index');
	}*/


	

}

