<?php

namespace App\Models;

use CodeIgniter\Model;

class PesertaModel extends Model
{
	protected $table = 'peserta';
	protected $primaryKey = 'id';

	protected $returnType     = 'array';
	protected $useSoftDeletes = false;

	protected $allowedFields = ['id', 'kegiatan', 'user', 'tgl_daftar', 'hadir'];

	public function getByKegiatan($id)
	{
		return $this->table($this->table)
								->select("$this->table.*, users.nama")
								->where("$this->table.kegiatan", $id)
								->join('users', "$this->table.user = users.id")
								->join('kegiatan', "$this->table.kegiatan = kegiatan.id")
								->findAll();
	}

	public function getByUser($id)
	{
		return $this->table($this->table)
								->select("$this->table.*, kegiatan.*, users.nama nama_user")
								->where("$this->table.user", $id)
								->join('users', "$this->table.user = users.id")
								->join('kegiatan', "$this->table.kegiatan = kegiatan.id")
								->findAll();
	}


	public function simpan($data){
			$query = $this->db->table($this->table)->insert($data);
			$id = $this->db->insertId($this->table);
			return $id ?? false;
	}
}
