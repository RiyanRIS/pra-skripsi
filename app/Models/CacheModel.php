<?php

namespace App\Models;

use CodeIgniter\Model;

class CacheModel extends Model
{
	protected $table = 'cache';
	protected $primaryKey = 'id';

	protected $returnType     = 'array';
	protected $useSoftDeletes = false;

	protected $allowedFields = ['id', 'chatid', 'nama', 'status'];

	function getByChatid($id)
	{
		return $this->table($this->table)
								->where('chatid', $id)
								->findAll();
	}

	function destroy($id)
	{
		return $this->table($this->table)
								->where('chatid', $id)
								->delete();
	}
}
