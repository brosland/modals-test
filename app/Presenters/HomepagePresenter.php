<?php

namespace App\Presenters;

use App\Components\ExampleModal\ExampleModal;
use App\Components\ExampleModal\ExampleModalFactory;
use Brosland\Modals\UI\ModalManager;
use Brosland\Modals\UI\ModalManagerTrait;
use Nette\Application\UI\Presenter;

final class HomepagePresenter extends Presenter implements ModalManager
{
    use ModalManagerTrait;

    /**
     * @var ExampleModalFactory
     */
    private $exampleModalFactory;

    /**
     * HomepagePresenter constructor.
     * @param ExampleModalFactory $exampleModalFactory
     */
    public function __construct(ExampleModalFactory $exampleModalFactory)
    {
        parent::__construct();

        $this->exampleModalFactory = $exampleModalFactory;

        $this->onStartup[] = [$this, 'initModal'];
    }

    public function handleExampleModal(): void
    {
        /** @var ExampleModal $modal */
        $modal = $this['exampleModal'];
        $modal->open();

        if (!$this->isAjax()) {
            $this->redirect('this');
        }
    }

    public function handleDoNothing(): void
    {
        $this->flashMessage('I am doing nothing.');

        if ($this->isAjax()) {
            $this->redrawControl();
        } else {
            $this->redirect();
        }
    }

    protected function beforeRender(): void
    {
        parent::beforeRender();

        $this->updateModal();
    }

    // factories **************************************************************/

    protected function createComponentExampleModal(): ExampleModal
    {
        $modal = $this->exampleModalFactory->create();
        $modal->onClose[] = function () {
            $this->flashMessage('Modal closed.');
            $this->redrawControl();
        };

        return $modal;
    }
}
