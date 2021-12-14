<?php

namespace App\Models;

use CodeIgniter\Model;

class ReportNotifKegiatanModel extends Model
{
	protected $table                = 'report_notif_kegiatan';
	protected $primaryKey           = 'id';
	protected $returnType           = 'array';

	protected $allowedFields = ['id', 'id_kegiatan', 'notif_ke'];
	
	public function simpan($data){
			$query = $this->db->table($this->table)->insert($data);
			$id = $this->db->insertId($this->table);
			return $id ?? false;
	}

}
