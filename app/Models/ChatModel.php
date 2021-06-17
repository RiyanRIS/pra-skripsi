<?php

namespace App\Models;

use CodeIgniter\Model;

class ChatModel extends Model
{
	protected $table = 'chat';
	protected $primaryKey = 'id';

	protected $returnType     = 'array';
	protected $useSoftDeletes = false;

	protected $allowedFields = ['id', 'user', 'jenis', 'pesan','time'];
}
