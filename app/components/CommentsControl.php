<?php

namespace Discussion\Components;

use Dibi\Row;
use Discussion\Services\CommentsService;
use Nette\Application\UI\Control;

interface CommentsControlFactory {

  /**
   * @param Row[] $comments
   *
   * @return CommentsControl
   */
  public function create($comments);

}

class CommentsControl extends Control {

  /** @var callable[] function ($commentId); Occurs when the user wants delete the comment */
  public $onDeleteComment = [];

  /** @var callable[] function ('text', 'author')); Occurs when the user wants insert new comment */
  public $onAddComment = [];

  /** @var Row[] */
  private $comments;

  /** @var CommentsService */
  private $commentsService;

  /**
   * @param Row[] $comments
   * @param CommentsService $commentsService
   */
  public function __construct($comments, CommentsService $commentsService) {
    parent::__construct();
    $this->comments = $comments;
    $this->commentsService = $commentsService;
  }

  /**
   * @see parent::render()
   */
  public function render() {
    $this->template->setFile(__DIR__ . '/CommentsControl.latte');
    $this->template->comments = $this->comments;
    $this->template->render();
  }

  /**
   * @param int $commentId
   *
   * @return void
   */
  public function handleDelete($commentId) {
    $this->commentsService->delete($commentId);

    $this->redirect('this');

    $this->onDeleteComment($commentId);
  }

  public function createComponentAddCommentForm() {
    $form = new AddCommentForm($this->commentsService);

    $form->onAddComment[] = function($values) {
      $this->redirect('this');

      $this->onAddComment($values);
    };

    return $form;
  }

}
