<?php

namespace app\model;

class User {
    private $id;
    private $role;
    private $nickname;
    private $email;
    private $password;

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
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

	/**
	 * @return string
	 */
	public function getNickname() {
		return $this->nickname;
	}

    /**
     * @param string $nickname
     * @return User
     */
	public function setNickname($nickname) {
		$this->nickname = $nickname;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}

    /**
     * @param string $email
     * @return User
     */
	public function setEmail($email) {
		$this->email = $email;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getPassword() {
		return $this->password;
	}

    /**
     * @param string $password
     * @return User
     */
	public function setPassword($password) {
		$this->password = $password;

		return $this;
	}
}
