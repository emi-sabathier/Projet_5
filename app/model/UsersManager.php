<?php
namespace app\model;

class UsersManager extends Manager {

	public function getEmail($registerEmail) {
		try {
			$db = $this->dbConnect();
			$q = $db->prepare('SELECT id, role, nickname, email, password FROM users WHERE email = ?');
			$q->execute(array($registerEmail));
			$user = $q->fetch();

			if ($user == false) {
			    return false;
            } else {
                $dataUser = [
                    'id' => $user['id'],
                    'role' => $user['role'],
                    'nickname' => $user['nickname'],
                    'email' => $user['email'],
                    'password' => $user['password']
                ];

                $userEmailObj = new User($dataUser);
                return $userEmailObj;
            }
		} catch (PDOException $pdoE) {
		    throw new \Exception($pdoE->getMessage());
		}
	}

    public function getNickname($registerNickname) {
        try {
            $db = $this->dbConnect();
            $q = $db->prepare('SELECT id, role, nickname, email, password FROM users WHERE nickname = ?');
            $q->execute(array($registerNickname));
            $user = $q->fetch();

            if ($user == false) {
                return false;
            } else {
                $dataUser = [
                    'id' => $user['id'],
                    'role' => $user['role'],
                    'nickname' => $user['nickname'],
                    'email' => $user['email'],
                    'password' => $user['password']
                ];

                $userNicknameObj = new User($dataUser);
                return $userNicknameObj;
            }
        } catch (PDOException $pdoE) {
            throw new \Exception($pdoE->getMessage());
        }
    }

	public function createUser($registerEmail, $registerNickname, $hash) {
		try {
			$db = $this->dbConnect();
			$q = $db->prepare('INSERT INTO users(email, nickname, password, role) VALUES(?, ?, ?, 0)');
			$q->execute(array($registerEmail, $registerNickname, $hash));
		} catch (PDOException $pdoE) {
			echo 'Erreur PDO : ' . $pdoE->getMessage();
		}
	}
}