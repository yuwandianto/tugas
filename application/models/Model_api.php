<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_api extends CI_Model
{

    function api_url()
    {
        return $this->db->get('data_api')->row()->url;
    }
}

/* End of file Model_api.php */
