<?php

namespace App\Models;

use CodeIgniter\Model;

class BerkasModel extends Model
{
	protected $table = 'berkas';
	protected $primaryKey = 'id';

	protected $returnType     = 'array';
	protected $useSoftDeletes = false;

	protected $allowedFields = ['id', 'kegiatan', 'nama', 'link', 'permission', 'create_at'];

}
