<?php

namespace app\model;

class CommentsManager extends Manager
{
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

    public function getComment($commentId){
        try {
            $db = $this->dbconnect();
            $q = $db->prepare('
            SELECT comments.id AS commentId, comments.user_id, comments.cmt_content, users.nickname,
            DATE_FORMAT(cmt_date, \'%d/%m/%Y à %Hh%i\')
            AS cmt_date
            FROM comments 
            INNER JOIN users ON comments.user_id = users.id
            WHERE comments.id = ?');
            $q->execute(array($commentId));
            $comment = $q->fetch();
            $dataComment = [
                'commentId' => $comment['commentId'],
                'nickname' => $comment['nickname'],
                'date' => $comment['cmt_date'],
                'content' => $comment['cmt_content']
            ];
            $commentObj = new Comment($dataComment);
            return $commentObj;

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
            $lastCommentId = $db->lastInsertId();
            return $lastCommentId;

        } catch (\PDOException $pdoE) {
            throw new \Exception($pdoE->getMessage());
        }
    }

    public function getReportedComments()
    {
        try {
            $db = $this->dbConnect();
            $q = $db->query
            ('SELECT comments.id, comments.user_id, comments.cmt_date, comments.cmt_content, comments.recipe_id, comments.cmt_report, users.nickname, recipes.recipe_title
            FROM comments
            INNER JOIN users ON comments.user_id = users.id
            INNER JOIN recipes ON recipes.id = comments.recipe_id
            WHERE cmt_report > 0
            ORDER BY cmt_report DESC ');

            $listReportedCommentsObj = [];

            while ($reportedComment = $q->fetch()) {
                $dataReportedComments = [
                    'commentId' => $reportedComment['id'],
                    'userId' => $reportedComment['user_id'],
                    'recipeId' => $reportedComment['recipe_id'],
                    'recipeTitle' => $reportedComment['recipe_title'],
                    'nickname' => $reportedComment['nickname'],
                    'date' => $reportedComment['cmt_date'],
                    'content' => $reportedComment['cmt_content'],
                    'report' => $reportedComment['cmt_report']
                ];
                $listReportedCommentsObj[] = new Comment($dataReportedComments);
            }
            return $listReportedCommentsObj;

        } catch (\PDOException $pdoE) {
            throw new \Exception($pdoE->getMessage());
        }
    }

    public function deleteComments($recipeId)
    {
        try {
            $db = $this->dbConnect();
            $q = $db->prepare('DELETE FROM comments WHERE recipe_id = ?');
            $q->execute(array($recipeId));
        } catch (\PDOException $pdoE) {
            throw new \Exception($pdoE->getMessage());
        }
    }

    public function reportComment($commentId)
    {
        try {
            $db = $this->dbconnect();
            $q = $db->prepare('UPDATE comments SET cmt_report = cmt_report + 1 WHERE id = ?');
            $q->execute(array($commentId));
        } catch (\PDOException $pdoE) {
            throw new \Exception($pdoE->getMessage());
        }
    }

    public function deleteComment($commentId)
    {
        try {
            $db = $this->dbConnect();
            $q = $db->prepare('DELETE FROM comments WHERE id = ?');
            $q->execute(array($commentId));
        } catch (\PDOException $pdoE) {
            throw new \Exception($pdoE->getMessage());
        }
    }

    public function resetReportedComment($commentId)
    {
        try {
            $db = $this->dbConnect();
            $q = $db->prepare('UPDATE comments SET cmt_report = 0 WHERE id = ?');
            $q->execute(array($commentId));
        } catch (\PDOException $pdoE) {
            throw new \Exception($pdoE->getMessage());
        }
    }
}