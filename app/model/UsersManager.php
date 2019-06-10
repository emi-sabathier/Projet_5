<?php

namespace app\model;

class UsersManager extends Manager
{
    /**
     * Get the user infos with the email
     *
     * @param string $email
     * @return User|bool
     * If true, return object $userEmailObj
     * @throws \Exception
     */
    public function getUserByEmail($email)
    {
        try {
            $db = $this->dbConnect();
            $q = $db->prepare('SELECT id, role, nickname, email, password FROM users WHERE email = ?');
            $q->execute(array($email));
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

    /**
     * Get if a nickname exists
     *
     * @param $nickname
     * @return User|bool
     * @throws \Exception
     */
    public function getNickname($nickname)
    {
        try {
            $db = $this->dbConnect();
            $q = $db->prepare('SELECT id, role, nickname, email, password FROM users WHERE nickname = ?');
            $q->execute(array($nickname));
            $user = $q->fetch();

            if ($user == false) {
                return false;
            } else {
                return true;
            }
        } catch (PDOException $pdoE) {
            throw new \Exception($pdoE->getMessage());
        }
    }

    /**
     * Create an user
     *
     * @param string $registerEmail
     * @param string $registerNickname
     * @param string $hash
     * @throws \Exception
     */
    public function createUser($registerEmail, $registerNickname, $hash)
    {
        try {
            $db = $this->dbConnect();
            $q = $db->prepare('INSERT INTO users(email, nickname, password, role) VALUES(?, ?, ?, 0)');
            $q->execute(array($registerEmail, $registerNickname, $hash));
        } catch (PDOException $pdoE) {
            throw new \Exception($pdoE->getMessage());
        }
    }

    /**
     * Get all users
     *
     * @return User object
     * @throws \Exception
     */
    public function getUsersList()
    {
        try {
            $db = $this->dbConnect();
            $q = $db->query('SELECT id, nickname, email, role, password FROM users');

            $listUsersObj = [];
            while ($user = $q->fetch()) {
                $dataUser = [
                    'id' => $user['id'],
                    'role' => $user['role'],
                    'nickname' => $user['nickname'],
                    'email' => $user['email'],
                    'password' => $user['password']
                ];
                $listUsersObj[] = new User($dataUser);
            }
            return $listUsersObj;

        } catch (PDOException $pdoE) {
            throw new \Exception($pdoE->getMessage());
        }
    }

    /**
     * Delete an user
     *
     * @param int $userId
     */
    public function deleteUser($userId){
        $db = $this->dbConnect();
        $q = $db->prepare('DELETE FROM users WHERE id = ?');
        $q->execute(array($userId));
    }

    /**
     * Delete an user's comments
     * 
     * @param int $userId
     */
    public function deleteUserComments($userId){
        $db = $this->dbConnect();
        $q = $db->prepare('DELETE FROM comments WHERE user_id = ?');
        $q->execute(array($userId));
    }
}