<?php
namespace app\model;

class Category
{
    private $id;
    private $cat_label;

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
    public function getCatLabel()
    {
        return $this->cat_label;
    }

    /**
     * @param mixed $cat_label
     */
    public function setCatLabel($cat_label)
    {
        $this->cat_label = $cat_label;
    }
}