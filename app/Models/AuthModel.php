<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
  protected $message = [];

	public function login(string $username, string $password, bool $remember=false): bool
	{
    if (empty($username) || empty($password))
		{
      $this->setError("Username atau password masih ada yang kosong");
			return false;
		}

    $query = $this->db->table("users")
						  ->select('*')
						  ->where('username', $username)
						  ->limit(1)
						  ->orderBy('id', 'desc')
						  ->get();

    $user = $query->getRow();

    if (isset($user))
		{
      if(password_verify($password, $user->password)){
        $this->setSession($user);
        $this->updateLastLogin($user->id);
        if ($remember)
        {
          if(!$this->rememberUser($user->id)){
            $this->setMessage("Gagal buat cookie");
            return false;
          }
        } else {
          $this->db->table('users')
              ->update(['remember_selector' => null], ['id' => $user->id]);
        }
        $this->setMessage("Berhasil masuk");
        return true;
      } else {
        $this->setMessage("Password salah");
        return false;
      }
    }else{
      $this->setMessage("Username tidak ditemukan");
      return false;
    }
  }

  public function logout($id){
    $this->db->table('users')
              ->update(['remember_selector' => null], ['id' => $id]);
    $sessionData = [
      'user_id'             => '',
      'islogin'             => false,
    ];

    session()->set($sessionData);
    return true;
  }

  public function setSession(\stdClass $user): bool
	{
		$sessionData = [
			'user_id'             => $user->id,
			'islogin'             => true,
		];

    session()->set($sessionData);

		return true;
	}

  public function rememberUser(string $identity): bool
	{
		if (!$identity)
		{
			return false;
		}

		$token = randStr(12);
    $this->db->table('users')
              ->update(['remember_selector' => $token], ['id' => $identity]);
    if ($this->db->affectedRows() > -1)
    {
      set_cookie([
        'name'   => 'sim_ketika_riyanpunya_cok',
        'value'  => $token,
        'expire' => time() + (86400 * 2) // 2 hari
      ]);
      return true;
    }
    return false;
	}

  public function cekCookie($val):bool
  {
    if($val){
      $query = $this->db->table("users")
                ->select('*')
                ->where('remember_selector', $val)
                ->limit(1)
                ->orderBy('id', 'desc')
                ->get();

      $user = $query->getRow();

      if (isset($user))
      {
        $this->setSession($user);
        $this->updateLastLogin($user->id);
        $this->setMessage("Berhasil masuk");
        return true;
      }
    }
    return false;
  }

  public function updateLastLogin(int $id): bool
	{
		$this->db->table('users')->update(['terahir_dilihat' => time()], ['id' => $id]);
		return $this->db->affectedRows() === 1;
	}

  public function setMessage(string $msg): string
	{
		$this->message[] = $msg;
		return $msg;
	}

  public function msg()
	{
		return $this->message;
	}

}
