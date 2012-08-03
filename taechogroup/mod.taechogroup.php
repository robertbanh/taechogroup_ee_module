<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

if( ! class_exists( 'Channel' )) { require_once PATH_MOD.'channel/mod.channel.php'; }

// =======================
// Author: Robert Banh
// Taecho Group, LLC
// Date: 
//
// =======================
class Taechogroup extends Channel
{
	public $return_data = NULL;

	// =================
	//
	// =================
	public function __construct()
	{
		$this->EE =& get_instance();

		// load models
		$this->EE->load->model('taechogroup_model');
	}

    // =================
    // {exp:taechogroup:display_flashdata}
    // =================
    public function display_flashdata()
    {
        $err = $this->EE->session->flashdata('message_error');
        if ($err)
            return '<div class="error">'.$err.'</div>';

        $success = $this->EE->session->flashdata('message_success');
        if ($success)
            return '<div class="success">'.$success.'</div>';
    }

    // =================
    // {exp:taechogroup:secure_form_register_user}
    // =================
    public function secure_form_register_user()
    {
        $form_details = array(
                  'id'             => $this->EE->TMPL->fetch_param('id'),
                  'class'          => $this->EE->TMPL->fetch_param('class'),
                  'secure'         => TRUE,
                  'action'         => '/?ACT=' . $this->EE->functions->fetch_action_id('Taechogroup', 'blah_blah')
                  );
        return $this->EE->functions->form_declaration($form_details);
    }

    // =================
    // Action: blah_blah
    // =================
    public function blah_blah()
    {
        $previous_page = ($_SERVER['HTTP_REFERER'] ?: '/');

        // security check
        if ($this->EE->security->secure_forms_check($this->EE->input->post('XID')) == FALSE)
        {
            $this->EE->session->set_flashdata('message_error', 'Error: session invalid. Please try again.');
            $this->EE->functions->redirect($previous_page);
            exit;
        }

        $clean_data = array();
        $fields = array(
            'first_name',
            );
        foreach ($fields as $f)
        {
            $$f = $this->EE->input->post($f);
            // clean
            $$f = $this->EE->security->xss_clean($$f);
            // all fields are required
            if (empty($$f))
            {
                $this->EE->session->set_flashdata('message_error', 'Please fill out all fields.');
                $this->EE->functions->redirect($previous_page);
            }

            $clean_data[$f] = $$f;
        }

        // insert into DB
        $this->EE->taechogroup_model->add_blah($clean_data);
        $this->EE->session->set_flashdata('message_success', 'Your information has been submitted.');

        $this->EE->functions->redirect($previous_page);
    }


	// =================
    // 
    //  {exp:taechogroup:category_entry_loop cat_url="{segment_2}"}
    //      {title}
    //      {url_title}
    //      {...}
    //  {/exp:taechogroup:category_entry_loop}
    // 
    // =================
    public function Category_entry_loop()
    {
        parent::Channel();

        $output = '';

        $cat_url = $this->EE->TMPL->fetch_param('cat_url','');

        if (!empty($cat_url))
        {
            $sql = $this->EE->db->query("
                SELECT 
                    *
                FROM ".$this->EE->db->dbprefix('categories')."
                WHERE 
                    cat_url_title = '".$this->EE->db->escape_str($cat_url)."'
            ");
            $re = $sql->result_array();
            $re = current($re);
            if (isset($re['cat_id']))
            {
                $cat_id = $re['cat_id'];

                $this->EE->TMPL->tagparams['category'] = $cat_id;
                $this->EE->TMPL->tagparams['channel'] = $this->EE->TMPL->fetch_param('channel','');
                $this->EE->TMPL->tagparams['limit'] = $this->EE->TMPL->fetch_param('limit','');
                $this->EE->TMPL->tagparams['orderby'] = $this->EE->TMPL->fetch_param('orderby','');
                $this->EE->TMPL->tagparams['sort'] = $this->EE->TMPL->fetch_param('sort','');
                $this->EE->TMPL->tagparams['dynamic'] = $this->EE->TMPL->fetch_param('dynamic','');
                $this->EE->TMPL->tagparams['disable'] = $this->EE->TMPL->fetch_param('disable','');
                $this->EE->TMPL->tagparams['cache'] = $this->EE->TMPL->fetch_param('cache','');
                $this->EE->TMPL->tagparams['refresh'] = $this->EE->TMPL->fetch_param('refresh','');
                $this->EE->TMPL->tagparams['paginate'] = $this->EE->TMPL->fetch_param('paginate','');

                $this->return_data = parent::entries();

            }
        }
        
        return $this->return_data;
    }

}

