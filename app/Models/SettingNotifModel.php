<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingNotifModel extends Model
{
	protected $table = 'setting_notif';
	protected $primaryKey = 'id';

	protected $returnType     = 'array';

	protected $allowedFields = ['id', 'user', 'login'];

	public function simpan($data){
			$this->db->table($this->table)->insert($data);
			$id = $this->db->insertId($this->table);
			return $id ?? false;
	}

  function findByUser($id){
    return $this->db->table($this->table)
                    ->where('user', $id)
										->limit(1)
                    ->get()
                    ->getRow();
  }

	function updateByUser($id, $data){
		return $this->db->table($this->table)->update($data, 'user = ' . $id);
	}

	function loginNotifBool($id):bool{
		$data = $this->db->table($this->table)
										 ->where('user', $id)
										 ->get()
										 ->getRow();
		if($data->login == 1){
			return true;
		}
		return false;
	}

}
