<?php
namespace app\model;

class Category
{
    private $_category_id;
    private $_category_label;

    public function __construct(array $category){
        $this->hydrate($category);
    }

    public function hydrate($category) {
        foreach ($category as $key => $value) {
            $setter = 'set' . ucfirst($key);
            if (method_exists($this, $setter)) {
                $this->$setter($value);
            }
        }
    }

    /**
     * @return int
     */
    public function getCategoryId() : int
    {
        return $this->_category_id;
    }

    /**
     * @param int $category_id
     */
    public function setCategoryId(int $category_id)
    {
        $this->_category_id = $category_id;
    }

    /**
     * @return string
     */
    public function getCategoryLabel() : string
    {
        return $this->_category_label;
    }

    /**
     * @param string $category_label
     */
    public function setCategoryLabel(string $category_label)
    {
        $this->_category_label = $category_label;
    }
}