<?php

namespace app\model;

class CommentsManager extends Manager
{
    /**
     * Get the comments list of a recipe
     * @param $recipeId integer
     * @return array
     */
    public function getComments($recipeId)
    {
        try {
            $db = $this->dbconnect();
            $q = $db->prepare('
            SELECT comments.id AS commentId, comments.user_id, comments.cmt_content, comments.recipe_id, recipes.recipe_title, users.nickname,
            DATE_FORMAT(cmt_date, \'%d/%m/%Y à %Hh%i\')
            AS cmt_date
            FROM comments
            INNER JOIN recipes ON comments.recipe_id = recipes.id
            INNER JOIN users ON comments.user_id = users.id WHERE recipe_id = ?
            ORDER BY cmt_date DESC');
            $q->execute(array($recipeId));
            $listComments = [];
            // récupère chaque commentaire, et les stocke dans l'objet
            while ($comment = $q->fetch()) {
                $dataComments = [
                    'commentId' => $comment['commentId'],
                    'nickname' => $comment['nickname'],
                    'date' => $comment['cmt_date'],
                    'content' => $comment['cmt_content']
                ];
                $listComments[] = new Comment($dataComments);
            }
            return $listComments;
        } catch (\PDOException $pdoE) {
            throw new \Exception($pdoE->getMessage());
        }
    }

    public function addComment($recipeId, $authorId, $comment)
    {
        try {
            $db = $this->dbconnect();
            $q = $db->prepare('INSERT INTO comments (recipe_id, user_id, cmt_content, cmt_date) VALUES (?, ?, ?, NOW())');
            $q->execute(array($recipeId, $authorId, $comment));
        } catch (\PDOException $pdoE) {
            throw new \Exception($pdoE->getMessage());
        }
    }

    public function getReportedComments()
    {
        try{
            $db = $this->dbConnect();
            $q = $db->query
            ('SELECT comments.id, comments.user_id, comments.cmt_date, comments.cmt_content, comments.recipe_id, comments.cmt_report, users.nickname, recipes.recipe_title
            FROM comments
            INNER JOIN users ON comments.user_id = users.id
            INNER JOIN recipes ON recipes.id = comments.recipe_id
            WHERE cmt_report > 0
            ORDER BY cmt_report DESC ');

            $listReportedCommentsObj = [];

            while($reportedComment = $q->fetch()){
                $dataReportedComments = [
                    'id' => $reportedComment['id'],
                    'nickname' => $reportedComment['nickname'],
                    'date' => $reportedComment['cmt_date'],
                    'content' => $reportedComment['cmt_content'],
                    'report' => $reportedComment['cmt_report'],
                    'recipeTitle' => $reportedComment['recipe_title']
                ];
                $listReportedCommentsObj[] = new Comment($dataReportedComments);
            }
            return $listReportedCommentsObj;

        } catch(\PDOException $pdoE) {
            throw new \Exception($pdoE->getMessage());
        }
    }
    public function deleteComments($recipeId){
        $db = $this->dbConnect();
        $q = $db->prepare('DELETE FROM comments WHERE recipe_id = ?');
        $q->execute(array($recipeId));
    }
    public function reportComment($commentId){
        $db = $this->dbconnect();
        $q = $db->prepare('UPDATE comments SET cmt_report = cmt_report + 1 WHERE id = ?');
        $q->execute(array($commentId));
    }
}