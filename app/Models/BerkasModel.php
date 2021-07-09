<?php

namespace App\Models;

use CodeIgniter\Model;

class BerkasModel extends Model
{
	protected $table = 'berkas';
	protected $primaryKey = 'id';

	protected $returnType     = 'array';
	protected $useSoftDeletes = false;

	protected $allowedFields = ['id', 'kegiatan', 'nama', 'link', 'permission', 'size', 'create_at'];

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
