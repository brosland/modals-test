<?php
declare(strict_types=1);

namespace App\Components\ExampleModal;

use Brosland\Modals\UI\Modal;

final class ExampleModal extends Modal
{
    private const DEFAULT_TITLE = 'Default title';
    /**
     * @var string
     */
    private $title = self::DEFAULT_TITLE;


    public function handleReset(): void
    {
        $this->title = self::DEFAULT_TITLE;

        if ($this->presenter->isAjax()) {
            $this->redrawControl();
        } else {
            $this->redirect('this');
        }
    }

    public function render(): void
    {
        parent::render();

        $this->template->title = $this->title;
        $this->template->setFile(__DIR__ . '/ExampleModal.latte');
        $this->template->render();
    }

    // factories **************************************************************/

    protected function createComponentForm(): TitleForm
    {
        $form = new TitleForm();
        $form['cancel']->onClick[] = function () {
            $this->close();
        };
        $form['change']->onClick[] = function () use ($form) {
            $this->title = $form->getValues()['title'];

            $this->redrawControl();
        };
        $form->setDefaults(['time' => $this->title]);

        return $form;
    }
}

interface ExampleModalFactory
{
    function create(): ExampleModal;
}