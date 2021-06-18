<?php

namespace App\Models;

use CodeIgniter\Model;

class LogModel extends Model
{
	protected $table                = 'log';
	protected $primaryKey           = 'id';
	protected $returnType           = 'array';

	protected $allowedFields = ['users', 'keterangan', 'asal', 'kunci', 'nama_tabel', 'sesudah', 'sebelum', 'time'];


}
