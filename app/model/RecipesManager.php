<?php

namespace app\model;

class RecipesManager extends Manager {
	public function getRecipes() {
		try {
			$db = $this->dbconnect();
			$q = $db->query('
        SELECT
        recipes.id, recipes.author_id, recipes.cat_id, recipes.dif_id,
        recipes.cooking_time, recipes.persons, recipe_title, recipe_content,
        users.nickname, categories.cat_label, difficulty.dif_label,
        DATE_FORMAT(recipe_date, \'%d/%m/%Y à %Hh%i\')
        AS recipe_date
        FROM recipes
        INNER JOIN users ON recipes.author_id = users.id
        INNER JOIN categories ON recipes.cat_id = categories.id
        INNER JOIN difficulty ON recipes.dif_id = difficulty.id
        ORDER BY recipe_date DESC
        ');
			$ListRecipesObj = [];
			// recipe > data pr chaque recette
			while ($recipe = $q->fetch()) {
				$dataRecipes = [
					'recipeId' => $recipe['id'],
					'nickname' => $recipe['nickname'],
					'category' => $recipe['cat_label'],
					'cookingTime' => $recipe['cooking_time'],
					'persons' => $recipe['persons'],
					'difficulty' => $recipe['dif_label'],
					'recipeDate' => $recipe['recipe_date'],
					'recipeTitle' => $recipe['recipe_title'],
					'recipeContent' => $recipe['recipe_content'],
				];
				// array dataRecipes envoyé à l'hydratation, qui renvoie les données à $ListRecipesObj
				$ListRecipesObj[] = new Recipe($dataRecipes);
			}
			return $ListRecipesObj;
		} catch (PDOException $pdoE) {
			echo 'Erreur PDO : ' . $pdoE->getMessage();
		}
	}

	public function getRecipe($id) {
		try {
			$db = $this->dbconnect();
			$q = $db->prepare
				('SELECT
        recipes.id, recipes.author_id, recipes.cat_id, recipes.dif_id,
        recipes.cooking_time, recipes.persons, recipe_title, recipe_content,
        users.nickname, categories.cat_label, difficulty.dif_label,
        DATE_FORMAT(recipe_date, \'%d/%m/%Y à %Hh%i\')
        AS recipe_date
        FROM recipes
        INNER JOIN users ON recipes.author_id = users.id
        INNER JOIN categories ON recipes.cat_id = categories.id
        INNER JOIN difficulty ON recipes.dif_id = difficulty.id
        WHERE recipes.id = ?');
			$q->execute(array($id));
			$recipe = $q->fetch();
			$dataRecipe = [
				'recipeId' => $recipe['id'],
				'nickname' => $recipe['nickname'],
				'category' => $recipe['cat_label'],
				'cookingTime' => $recipe['cooking_time'],
				'persons' => $recipe['persons'],
				'difficulty' => $recipe['dif_label'],
				'recipeDate' => $recipe['recipe_date'],
				'recipeTitle' => $recipe['recipe_title'],
				'recipeContent' => $recipe['recipe_content'],
			];
			$RecipeObj = new Recipe($dataRecipe);
			return $RecipeObj;

		} catch (PDOException $pdoE) {
			echo 'Erreur PDO : ' . $pdoE->getMessage();
		}
	}
}