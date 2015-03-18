<?php
class Friends_model extends CI_Model {

    var $table = 'friends'; //Table Name

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    //Batch Insert
    public function insert($data = FALSE)
    {
    	$output = FALSE;

    	if($data)
    	{
    		if($this->db->insert_batch($this->table, $data))
    		{
    			$output = TRUE;
    		}
    	}
    	return $output;
    }

    //Batch Update
    public function update($data = FALSE)
    {
    	$output = FALSE;

    	if($data)
    	{
    		if($this->db->update_batch($this->table, $data, 'id'))
    		{
    			$output = TRUE;
    		}
    	}
    	return $output;
    }

	// return all friends of the selected user
    public function get($id=-1)
    {
    	$output = FALSE;

    	if($id>0)
    	{
    		$this->db->where('user_id', $id);
    		$query = $this->db->get($this->table);
    		if($query->num_rows()>0)
    		{
    			$output = $query->result();
    		}
    	}

    	return $output;
    }

    public function remove($id=-1)
    {
        if($id>0)
        {
            $this->db->delete($this->table, array('id' => $id)); 
        }
    }
}