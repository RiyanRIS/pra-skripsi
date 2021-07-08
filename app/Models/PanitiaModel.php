<?php

namespace App\Models;

use CodeIgniter\Model;

class PanitiaModel extends Model
{
	protected $table                = 'panitia';
	protected $primaryKey           = 'id';
	protected $returnType           = 'array';

	protected $allowedFields = ['id', 'kegiatan', 'user', 'posisi'];
	
	public function getByKegiatan($id)
	{
		return $this->table($this->table)
								->select("$this->table.*, users.nama, users.ava")
								->where("$this->table.kegiatan", $id)
								->join('users', "$this->table.user = users.id")
								->findAll();
	}

	public function simpan($data){
			$query = $this->db->table($this->table)->insert($data);
			$id = $this->db->insertId($this->table);
			return $id ?? false;
	}

}
