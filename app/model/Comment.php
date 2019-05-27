<?php

namespace app\model;

class Comment implements \JsonSerializable
{
    private $_commentId;
    private $_nickname;
    private $_date;
    private $_content;
    private $_recipe_title;
    private $_recipe_id;
    private $_user_id;
    private $_report;

    public function __construct(array $comment)
    {
        $this->hydrate($comment);
    }

    public function hydrate($comment)
    {
        foreach ($comment as $key => $value) {
            $setter = 'set' . ucfirst($key);
            if (method_exists($this, $setter)) {
                $this->$setter($value);
            }
        }
    }

    // Méthode appelée quand on fait un json encode

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */

    public function jsonSerialize()
    {
        return [
            'commentId' => $this->_commentId,
            'nickname' => $this->_nickname,
            'date' => $this->_date,
            'content' => $this->_content
        ];
    }

    /**
     * @return mixed
     */
    public function getCommentId()
    {
        return $this->_commentId;
    }

    /**
     * @param mixed $id
     */
    public function setCommentId($id)
    {
        $this->_commentId = $id;
    }

    /**
     * @return mixed
     */
    public function getNickname()
    {
        return $this->_nickname;
    }

    /**
     * @param mixed $_nickname
     */
    public function setNickname($_nickname)
    {
        $this->_nickname = $_nickname;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->_date;
    }

    /**
     * @param mixed $_date
     */
    public function setDate($_date)
    {
        $this->_date = $_date;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->_content;
    }

    /**
     * @param mixed $_content
     */
    public function setContent($_content)
    {
        $this->_content = $_content;
    }

    /**
     * @return mixed
     */
    public function getRecipeTitle()
    {
        return $this->_recipe_title;
    }

    /**
     * @param mixed $recipe_title
     */
    public function setRecipeTitle($recipe_title)
    {
        $this->_recipe_title = $recipe_title;
    }

    /**
     * @return mixed
     */
    public function getRecipeId()
    {
        return $this->_recipe_id;
    }

    /**
     * @param mixed $recipe_id
     */
    public function setRecipeId($recipe_id)
    {
        $this->_recipe_id = $recipe_id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->_user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->_user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getReport()
    {
        return $this->_report;
    }

    /**
     * @param mixed $_report
     */
    public function setReport($_report)
    {
        $this->_report = $_report;
    }

}