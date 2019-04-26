<?php
namespace app\model;

class Recipe
{
    private $id;
    private $nickname;
    private $cat_label;
    private $cooking_time;
    private $persons;
    private $dif_id;
    private $recipe_date;
    private $recipe_title;
    private $recipe_content;

    // = (array $recipes)
    public function __construct(array $recipe){
        $this->hydrate($recipe);
    }
    public function hydrate($recipe) {
        foreach ($recipe as $key => $value) {
            $setter = 'set' . ucfirst($key);
            if (method_exists($this, $setter)) {
                $this->$setter($value);
            }
        }
    }
    /**
     * @return integer
     */
    public function getRecipeId()
    {
        return $this->id;
    }

    /**
     * @param integer $id
     */
    public function setRecipeId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * @param string $nickname
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->cat_label;
    }

    /**
     * @param string $cat_label
     */
    public function setCategory($cat_label)
    {
        $this->cat_label = $cat_label;
    }

    /**
     * @return integer
     */
    public function getCookingTime()
    {
        return $this->cooking_time;
    }

    /**
     * @param integer $cooking_time
     */
    public function setCookingTime($cooking_time)
    {
        $this->cooking_time = $cooking_time;
    }

    /**
     * @return integer
     */
    public function getPersons()
    {
        return $this->persons;
    }

    /**
     * @param integer $persons
     */
    public function setPersons($persons)
    {
        $this->persons = $persons;
    }

    /**
     * @return integer
     */
    public function getDifficulty()
    {
        return $this->dif_id;
    }

    /**
     * @param integer $dif_id
     */
    public function setDifficulty($dif_id)
    {
        $this->dif_id = $dif_id;
    }

    /**
     * @return integer
     */
    public function getRecipeDate()
    {
        return $this->recipe_date;
    }

    /**
     * @param integer $recipe_date
     */
    public function setRecipeDate($recipe_date)
    {
        $this->recipe_date = $recipe_date;
    }

    /**
     * @return string
     */
    public function getRecipeTitle()
    {
        return $this->recipe_title;
    }

    /**
     * @param string $recipe_title
     */
    public function setRecipeTitle($recipe_title)
    {
        $this->recipe_title = $recipe_title;
    }

    /**
     * @return string
     */
    public function getRecipeContent()
    {
        return $this->recipe_content;
    }

    /**
     * @param string $recipe_content
     */
    public function setRecipeContent($recipe_content)
    {
        $this->recipe_content = $recipe_content;
    }
}