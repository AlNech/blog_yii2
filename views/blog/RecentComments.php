<?php

class RecentComments extends Widget
{
    public $comments;

    public function init()
    {
        parent::init();
        $this->comments = Comment::findRecentComments();
    }

    public function run()
    {
        return $this->render('recent-comments');
    }

}