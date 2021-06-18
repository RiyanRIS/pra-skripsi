<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
	protected $table = 'users';
	protected $primaryKey = 'id';

	protected $returnType     = 'array';
	protected $useSoftDeletes = true;

	protected $allowedFields = ['id', 'nama', 'username', 'password', 'role', 'nohp', 'chatid', 'ava', 'terahir_dilihat', 'create_at', 'update_at', 'delete_at'];

	protected $useTimestamps = false;
	protected $createdField  = 'create_at';
	protected $updatedField  = 'update_at';
	protected $deletedField  = 'delete_at';

	public function simpan($data){
			$query = $this->db->table($this->table)->insert($data);
			$id = $this->db->insertId($this->table);
			return $id ?? false;
	}

}
