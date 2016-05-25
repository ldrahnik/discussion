<?php

namespace App\Presenters;

use Discussion\Components\CommentsControlFactory;
use Discussion\Services\CommentsService;

class CommentsPresenter extends BasePresenter {

  /** @var CommentsService @inject */
  public $commentsService;

  protected function createComponentComments(CommentsControlFactory $factory) {
    $comments = $this->commentsService->getAll();

    $control = $factory->create($comments);

    $control->onAddComment[] = function($values) {
      $this->flashMessage("Comment was added, author is $values->author");
    };

    $control->onAddCommentError[] = function() {
      $this->flashMessage("Comment was not added");
    };

    $control->onDeleteComment[] = function($commentId) {
      $this->flashMessage("Comment was removed!");
    };

    $control->onDeleteCommentError[] = function() {
      $this->flashMessage("Comment was not removed!");
    };

    return $control;
  }

}
