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
}
