<?php

namespace app\model;

class CategoriesManager extends Manager
{
    public function getCategories()
    {
        try {
            $db = $this->dbconnect();
            $q = $db->query('SELECT id, cat_label FROM categories');

            $listCategoriesObj = [];

            while ($category = $q->fetch()) {
                $dataCategories = [
                    'categoryId' => $category['id'],
                    'categoryLabel' => $category['cat_label']
                ];
                $listCategoriesObj[] = new Category($dataCategories);
            }
            return $listCategoriesObj;

        } catch (\PDOException $pdoE) {
            throw new \Exception($pdoE->getMessage());
        }
    }
}