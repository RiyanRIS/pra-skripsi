<?php

namespace App\Models;

use CodeIgniter\Model;

class TugasModel extends Model
{
	protected $table = 'tugas';
	protected $primaryKey = 'id';

	protected $returnType     = 'array';
	protected $useSoftDeletes = false;

	protected $allowedFields = ['id', 'kegiatan', 'tugas', 'deadline', 'status'];

	public function getByKegiatan($id)
	{
		return $this->table($this->table)
								->select("*")
								->where("$this->table.kegiatan", $id)
								->findAll();
	}

	public function simpan($data){
			$query = $this->db->table($this->table)->insert($data);
			$id = $this->db->insertId($this->table);
			return $id ?? false;
	}

}
