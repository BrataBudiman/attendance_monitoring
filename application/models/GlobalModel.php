<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @package CI_Model
 * @author AdiStwn
 * @since 2017
 * @license https://opensource.org/licenses/MIT MIT License
 */

class GlobalModel extends CI_Model
{
    /**
     * [__construct description]
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * [addGlobal description]
     * @param [type] $table [description]
     * @param [type] $data  [description]
     */
    public function addGlobal($table,$data)
    {
        $this->db->insert($table, $data);
        $item = $this->db->insert_id();
        return $item;
    }

    public function getGlobal($table,$field,$id)
    {
        $this->db->from($table);
        $this->db->where($field,$id);
        // $this->db->limit(1);
        $query = $this->db->get();
        return $query->row();
    }

    public function getarrayGlobal($table,$array=FALSE)
    {
        $this->db->from($table);
        if($array):
            $this->db->where($array);
        endif;
        $query = $this->db->get();
        return $query;
    }

    public function getallGlobal($table, $field=FALSE, $id=FALSE)
    {
        $this->db->from($table);
        if ($field)
        {
            $this->db->where($field,$id);
        }

        $query = $this->db->get();

        return $query->result();
    }

    /**
     * [getGlobalMax description]
     * @param  [type] $table [description]
     * @param  [type] $field [description]
     * @return [type]        [description]
     */
    public function getGlobalMax($table,$field)
    {
        $this->db->select('*');
        $this->db->select_max($field);
        $this->db->from($table);
        $query = $this->db->get();

        return $query->row();
    }

    /**
     * [updateGlobal description]
     * @param  [type] $table [description]
     * @param  [type] $data  [description]
     * @param  [type] $item  [description]
     * @param  [type] $field [description]
     * @return [type]        [description]
     */
    public function updateGlobal($table,$data,$item,$field)
    {
        $this->db->where($field, $item);
        $this->db->update($table, $data);
        return $this->db->affected_rows();
    }

    /**
     * [delGlobal description]
     * @param  [type] $table [description]
     * @param  [type] $field [description]
     * @param  [type] $id    [description]
     * @return [type]        [description]
     */
    public function delGlobal($table,$field,$id)
    {
        $this->db->where($field, $id);
        $this->db->delete($table);
        return $this->db->affected_rows();
    }
    

}

/* End of file GlobalModel.php */
/* Location: ./application/models/GlobalModel.php */