<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts_model2 extends CI_Model {

	var $table = 'user';
	var $column_order = array('id_user', 'firstname', 'lastname', 'email', 'statut', 'create_by', 'role',null); //set column field database for datatable orderable
	var $column_search = array('firstname', 'lastname', 'email', 'statut', 'create_by', 'role'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('id_user' => 'desc'); // default order 


	private function _get_datatables_query()
	{
		
		$this->db->from($this->table);

		$i = 0;
		
		foreach ($this->column_search as $item) // loop column 
		{
			if(isset($_POST['search']['value'])) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
				}
				$i++;
			}
			
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if (isset($_POST['length'])) {
			if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
		}
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id_user',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('id_user', $id);
		$this->db->delete($this->table);
	}

	public function unset_by_id($id)
	{
		$user = $this->get_by_id($id);
		//var_dump($user->statut);die();
		if ($user->statut == '0')
		{
			$this->db->set('statut', '1');
		}
		else
		{
			$this->db->set('statut', '0');
		}
		
		$this->db->where('id_user', $id);
		$this->db->update($this->table);
	}

	public function can_login($email, $password)
	{
		$this->db->where('email', $email);
		$this->db->where('password', $password);

		$query = $this->db->get($this->table);

		if ($query->num_rows() > 0)
		{
			return true;
		}else
		{
			return false;
		}
	}
	public function get_by_email_and_password($email, $password)
	{
		$this->db->from($this->table);
		$this->db->where('email',$email);
		$this->db->where('password',$password);
		$query = $this->db->get();

		return $query->row(0, 'array');
	}

	public function get_by_email($email)
	{
		$this->db->from($this->table);
		$this->db->where('email',$email);
		$query = $this->db->get();

		return $query->row(0, 'array');
	}


}
