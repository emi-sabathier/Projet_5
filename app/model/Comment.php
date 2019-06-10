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

    //Returns data which can be used by json_encode()
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
     * @return int
     */
    public function getCommentId() : int
    {
        return $this->_commentId;
    }

    /**
     * @param int $id
     */
    public function setCommentId(int $id)
    {
        $this->_commentId = $id;
    }

    /**
     * @return string
     */
    public function getNickname() :string
    {
        return $this->_nickname;
    }

    /**
     * @param string $_nickname
     */
    public function setNickname(string $_nickname)
    {
        $this->_nickname = $_nickname;
    }

    /**
     * @return string
     */
    public function getDate() :string
    {
        return $this->_date;
    }

    /**
     * @param string $_date
     */
    public function setDate(string $_date)
    {
        $this->_date = $_date;
    }

    /**
     * @return string
     */
    public function getContent() :string
    {
        return $this->_content;
    }

    /**
     * @param string $_content
     */
    public function setContent(string $_content)
    {
        $this->_content = $_content;
    }

    /**
     * @return string
     */
    public function getRecipeTitle() :string
    {
        return $this->_recipe_title;
    }

    /**
     * @param string $recipe_title
     */
    public function setRecipeTitle(string $recipe_title)
    {
        $this->_recipe_title = $recipe_title;
    }

    /**
     * @return int
     */
    public function getRecipeId() :int
    {
        return $this->_recipe_id;
    }

    /**
     * @param int $recipe_id
     */
    public function setRecipeId(int $recipe_id)
    {
        $this->_recipe_id = $recipe_id;
    }

    /**
     * @return int
     */
    public function getUserId() :sint
    {
        return $this->_user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id)
    {
        $this->_user_id = $user_id;
    }

    /**
     * @return int
     */
    public function getReport() :int
    {
        return $this->_report;
    }

    /**
     * @param int $_report
     */
    public function setReport(int $_report)
    {
        $this->_report = $_report;
    }

}