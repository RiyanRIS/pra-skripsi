<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
	protected $table = 'users';
	protected $primaryKey = 'id';

	protected $returnType     = 'array';
	protected $useSoftDeletes = true;

	protected $allowedFields = ['id', 'nama', 'username', 'password', 'role', 'nohp', 'chat_id', 'ava', 'terahir_dilihat', 'create_at', 'update_at', 'delete_at'];

	protected $useTimestamps = false;
	protected $createdField  = 'create_at';
	protected $updatedField  = 'update_at';
	protected $deletedField  = 'delete_at';

	public function simpan($data){
			$this->db->table($this->table)->insert($data);
			$id = $this->db->insertId($this->table);
			return $id ?? false;
	}

	public function getAllAdmin(){
		return $this->db->table($this->table)
											->where('role', 'admin')
											->where('delete_at', null)
											->get()
											->getResultArray();
	}

	public function getByTerahir(string $terahir)
	{
		return $this->db->table($this->table)
											->where('terahir_dilihat', $terahir)
											->where('delete_at', null)
											->where('chat_id', null)
											->get()
											->getResultArray();
	}

	public function findByUsername(string $username):bool
	{
		$query = $this->db->table($this->table)
											->where('username', $username)
											->where('delete_at', null)
											->limit(1)
											->get();
		
		$user = $query->getRow();

    if (isset($user)){
			return true;
		}

		return false;
	}

	public function getByUsername(string $username)
	{
		return $this->db->table($this->table)
											->where('username', $username)
											->where('delete_at', null)
											->limit(1)
											->get()
											->getRow();
	}

}
