<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cinema_m extends CI_Model {

    public function insert($data)
    {
        $this->db->trans_start();

        $this->db->insert('transactions', $data);
        
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		}else{
			$this->db->trans_commit();
			return TRUE;
		}
    }
    
    public function insertUser($data)
    {
        $this->db->trans_start();

        $this->db->insert('users', $data);
        
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
        
        $this->db->update('transactions', $data);
        
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
        
        return $this->db->query("SELECT
            `transactions`.`order_id`
            , `users`.`name`
            , `users`.`email`
            , `movies`.`title`
            , `transactions`.`gross_amount`
            , `transactions`.`amount`
            , `transactions`.`status_code`
        FROM
            `transactions`
            INNER JOIN `movies` 
                ON (`transactions`.`movie_id` = `movies`.`id`)
            INNER JOIN `users` 
                ON (`transactions`.`user_id` = `users`.`id`)
                ORDER BY transaction_time DESC;")->result();
        
    }
    
    public function selectMovies()
    {
        return $this->db->get('movies')->result();
    }
    
    public function selectMoviesId($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('movies')->row();
    }

    public function selectUserEmail($email)
    {
        $this->db->where('email', $email);
        return $this->db->get('users')->row();
    }
    
}

/* End of file Cinema_m.php */
