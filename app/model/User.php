<?php

namespace app\model;

class User {
    private $_id;
    private $_role;
    private $_nickname;
    private $_email;
    private $_password;

    public function __construct(array $user) {
        $this->hydrate($user);
    }

    public function hydrate($user) {
        foreach ($user as $key => $value) {
            $setter = 'set' . ucfirst($key);
            if (method_exists($this, $setter)) {
                $this->$setter($value);
            }
        }
    }

    /**
     * @return int
     */
    public function getId() :int
    {
        return $this->_id;
    }


    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->_id = $id;
    }


    /**
     * @return int
     */
    public function getRole() :int
    {
        return $this->_role;
    }

    /**
     * @param int $role
     */
    public function setRole(int $role)
    {
        $this->_role = $role;
    }

    /**
     * @return string
     */
    public function getNickname() :string
    {
        return $this->_nickname;
    }

    /**
     * @param string $nickname
     */
    public function setNickname(string $nickname)
    {
        $this->_nickname = $nickname;
    }

    /**
     * @return string
     */
    public function getEmail() :string
    {
        return $this->_email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->_email = $email;
    }

    /**
     * @return string
     */
    public function getPassword() :string
    {
        return $this->_password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->_password = $password;
    }
}
