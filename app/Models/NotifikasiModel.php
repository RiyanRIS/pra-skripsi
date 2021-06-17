<?php

namespace App\Models;

use CodeIgniter\Model;

class NotifikasiModel extends Model
{
	protected $table = 'notifikasi';
	protected $primaryKey = 'id';

	protected $returnType     = 'array';
	protected $useSoftDeletes = false;

	protected $allowedFields = ['id', 'user', 'pesan', 'send_at'];
}
