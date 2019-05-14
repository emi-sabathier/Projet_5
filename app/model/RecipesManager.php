<?php

namespace app\model;

class RecipesManager extends Manager
{
    /**
     * @return array
     * @throws \Exception
     */
    public function getRecipes()
    {
        try {
            $db = $this->dbconnect();
            $q = $db->query('
        SELECT
        recipes.id AS recipeId, recipes.author_id, recipes.cat_id, recipes.dif_id,
        recipes.cooking_time, recipes.persons, recipe_title, recipe_content,
        users.nickname, categories.id AS categoryId, categories.cat_label, difficulty.id AS difficultyId, difficulty.dif_label, users.id AS userId,
        DATE_FORMAT(recipe_date, \'%d/%m/%Y à %Hh%i\')
        AS recipe_date
        FROM recipes
        INNER JOIN users ON recipes.author_id = users.id
        INNER JOIN categories ON recipes.cat_id = categories.id
        INNER JOIN difficulty ON recipes.dif_id = difficulty.id
        ORDER BY recipe_date DESC
        ');
            $listRecipesObj = [];

            while ($recipe = $q->fetch()) {
                $dataRecipes = [
                    'recipeId' => $recipe['recipeId'],
                    'nickname' => $recipe['nickname'],
                    'categoryId' => $recipe['cat_id'],
                    'categoryLabel' => $recipe['cat_label'],
                    'cookingTime' => $recipe['cooking_time'],
                    'persons' => $recipe['persons'],
                    'difficultyId' => $recipe['dif_id'],
                    'difficultyLabel' => $recipe['dif_label'],
                    'recipeDate' => $recipe['recipe_date'],
                    'recipeTitle' => $recipe['recipe_title'],
                    'recipeContent' => $recipe['recipe_content']
                ];
                // array dataRecipes envoyé à l'hydratation, qui renvoie les données à $listRecipesObj
                $listRecipesObj[] = new Recipe($dataRecipes);
            }
            return $listRecipesObj;
        } catch (\PDOException $pdoE) {
            throw new \Exception($pdoE->getMessage());
        }
    }

    /**
     * @param $id
     * @return Recipe
     * @throws \Exception
     */
    public function getRecipe($recipeId)
    {
        try {
            $db = $this->dbconnect();
            $q = $db->prepare
            ('SELECT
        recipes.id AS recipeId, recipes.author_id, recipes.cat_id, recipes.dif_id,
        recipes.cooking_time, recipes.persons, recipe_title, recipe_content,
        users.nickname, categories.id AS categoryId, categories.cat_label, difficulty.id AS difficultyId, difficulty.dif_label, users.id AS userId,
        DATE_FORMAT(recipe_date, \'%d/%m/%Y à %Hh%i\')
        AS recipe_date
        FROM recipes
        INNER JOIN users ON recipes.author_id = users.id
        INNER JOIN categories ON recipes.cat_id = categories.id
        INNER JOIN difficulty ON recipes.dif_id = difficulty.id
        WHERE recipes.id = ?');
            $q->execute(array($recipeId));
            $recipe = $q->fetch();
            // Soit renvoie false, ou renvoie les données recettes
            if ($recipe != false) {
                $dataRecipe = [
                    'recipeId' => $recipe['recipeId'],
                    'nickname' => $recipe['nickname'],
                    'categoryId' => $recipe['categoryId'],
                    'categoryLabel' => $recipe['cat_label'],
                    'cookingTime' => $recipe['cooking_time'],
                    'persons' => $recipe['persons'],
                    'difficultyId' => $recipe['difficultyId'],
                    'difficultyLabel' => $recipe['dif_label'],
                    'recipeDate' => $recipe['recipe_date'],
                    'recipeTitle' => $recipe['recipe_title'],
                    'recipeContent' => $recipe['recipe_content']
                ];
                $RecipeObj = new Recipe($dataRecipe);
                return $RecipeObj;
            } else {
                return false;
            }
        } catch (\PDOException $pdoE) {
            throw new \Exception($pdoE->getMessage());
        }
    }

    /**
     * @param $catId
     * @return Recipe[]
     * @throws \Exception
     */
    public function getRecipesByCat($catId)
    {
        try {
            $db = $this->dbconnect();
            $q = $db->prepare
            ('SELECT
        recipes.id AS recipeId, recipes.author_id, recipes.cat_id, recipes.dif_id,
        recipes.cooking_time, recipes.persons, recipe_title, recipe_content,
        users.nickname, categories.id AS categoryId, categories.cat_label, difficulty.id AS difficultId, difficulty.dif_label, users.id AS userId,
        DATE_FORMAT(recipe_date, \'%d/%m/%Y à %Hh%i\')
        AS recipe_dateMENT
        FROM recipes
        INNER JOIN users ON recipes.author_id = users.id
        INNER JOIN categories ON recipes.cat_id = categories.id
        INNER JOIN difficulty ON recipes.dif_id = difficulty.id
        WHERE recipes.cat_id = ?');
            $q->execute(array($catId));
            while ($recipe = $q->fetch()) {
                $dataRecipe = [
                    'recipeId' => $recipe['recipeId'],
                    'nickname' => $recipe['nickname'],
                    'categoryId' => $recipe['categoryId'],
                    'categoryLabel' => $recipe['cat_label'],
                    'cookingTime' => $recipe['cooking_time'],
                    'persons' => $recipe['persons'],
                    'difficultyId' => $recipe['difficultyId'],
                    'difficultyLabel' => $recipe['dif_label'],
                    'recipeDate' => $recipe['recipe_date'],
                    'recipeTitle' => $recipe['recipe_title'],
                    'recipeContent' => $recipe['recipe_content']
                ];
                $recipes[] = new Recipe($dataRecipe);
            }
            return $recipes;

        } catch (\PDOException $pdoE) {
            throw new \Exception($pdoE->getMessage());
        }
    }

    public function deleteRecipe($recipeId)
    {
        try {
            $db = $this->dbConnect();
            $q = $db->prepare('DELETE FROM recipes WHERE id = ?');
            $q->execute(array($recipeId));
        } catch (\PDOException $pdoE) {
            throw new \Exception($pdoE->getMessage());
        }
    }
}