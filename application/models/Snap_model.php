<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Snap_model extends CI_Model {

    public function insert($data)
    {
        $this->db->trans_start();

        $this->db->insert('transaksi', $data);
        
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		}else{
			$this->db->trans_commit();
			return TRUE;
		}
    }
    
    public function update($order_id, $data)
    {
        $this->db->trans_start();

        $this->db->where('order_id', $order_id);
        
        $this->db->update('transaksi', $data);
        
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		}else{
			$this->db->trans_commit();
			return TRUE;
		}
    }

    public function select()
    {
        return $this->db->get('transaksi')->result();
        
    }
    

}

/* End of file Snap_model.php */
