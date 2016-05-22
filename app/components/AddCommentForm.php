<?php

namespace Discussion\Components;

use Discussion\Services\CommentsService;
use Nette\Application\UI\Control;
use Nette\Application\UI\Form;

class AddCommentForm extends Control {

  /** @var callable[] function ($commentId); Occurs when the user wants delete the comment */
  public $onAddComment = [];

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
      ->setRequired();
    $form->addTextArea('text', 'Text:')
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
    $values = (object)$form->values;

    $this->commentsService->add($values->author, $values->text);

    $this->onAddComment($values);
  }

}