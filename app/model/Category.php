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
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->_category_id;
    }

    /**
     * @param mixed $category_id
     */
    public function setCategoryId($category_id)
    {
        $this->_category_id = $category_id;
    }

    /**
     * @return mixed
     */
    public function getCategoryLabel()
    {
        return $this->_category_label;
    }

    /**
     * @param mixed $category_label
     */
    public function setCategoryLabel($category_label)
    {
        $this->_category_label = $category_label;
    }
}