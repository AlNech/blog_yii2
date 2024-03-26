<?php

namespace app\controllers;

use app\models\Post;
use app\models\Comment;
use app\models\PostSearch;
use app\models\TagSearch;
use app\models\User;
use app\models\RegistrationForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class BlogController extends Controller
{

    public function actionIndex()
    {
        $posts = Post::find()->andWhere(['status' => Post::STATUS_PUBLISHED])->all();

        return $this->render('all', ['posts' => $posts]);
    }

    public function actionTagSearch()
    {
        $posts = Post::find()->where(['tags' => $this->request->queryParams])->all();

        return $this->render('all', [
            'posts' => $posts,
        ]);
    }


    public function actionOne($id)
    {
        if ($post = Post::findOne($id)) {
            $comments = $post->getComments();
            $comment = new Comment();
            if ($comment->load($_POST) && $post->addComment($comment)) {
                if ($comment->status == Comment::STATUS_PENDING) {
                    Yii::$app->getSession()->setFlash('warning', 'Thank you for your comment. Your comment will be posted once it is approved.');
                }
                return $this->refresh();
            }
            return $this->render('one', ['post' => $post, 'comments' => $comments,
                'comment' => $comment]);
        }
        throw new NotFoundHttpException('Такой статьи не существует');
    }

}
