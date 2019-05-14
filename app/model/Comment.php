<?php
namespace app\model;

class Comment
{
    private $_commentId;
    private $_nickname;
    private $_date;
    private $_content;
    private $_report;

    public function __construct(array $comment){
        $this->hydrate($comment);
    }
    public function hydrate($comment) {
        foreach ($comment as $key => $value) {
            $setter = 'set' . ucfirst($key);
            if (method_exists($this, $setter)) {
                $this->$setter($value);
            }
        }
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