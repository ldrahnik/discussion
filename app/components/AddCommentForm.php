<?php

namespace Discussion\Components;

use Discussion\Services\CommentsService;
use Nette\Application\UI\Control;
use Nette\Application\UI\Form;

class AddCommentForm extends Control {

  /** @var callable[] function ($commentId); Occurs when the user wants add the comment */
  public $onAddComment = [];

  /** @var callable[] function (); Occurs when the user wants add the comment but exception was thrown */
  public $onAddCommentError = [];

  /** @var CommentsService */
  private $commentsService;

  /**
   * @param CommentsService $commentsService
   */
  public function __construct(CommentsService $commentsService) {
    parent::__construct();
    $this->commentsService = $commentsService;
  }

  /**
   * @see parent::render()
   */
  public function render() {
    $this->template->setFile(__DIR__ . '/AddCommentForm.latte');
    $this->template->render();
  }

  /**
   * @return Form
   */
  protected function createComponentAddCommentForm() {
    $form = new Form();
    $form->addText('author', 'Jméno:')
      ->addRule(Form::MAX_LENGTH, null, 200)
      ->setRequired();
    $form->addTextArea('text', 'Text:')
      ->addRule(Form::MAX_LENGTH, null, 65535)
      ->setRequired();
    $form->addSubmit('send', 'Přidat komentář');
    $form->onSuccess[] = $this->processAddCommentForm;

    return $form;
  }

  /**
   * @param Form $form
   *
   * @return void
   */
  public function processAddCommentForm(Form $form) {
    $values = $form->getValues();

    try {
      $this->commentsService->add($values->author, $values->text);
      $this->onAddComment($values);
    } catch(\Exception $exception) {
      $this->onAddCommentError();
    }
  }

}
