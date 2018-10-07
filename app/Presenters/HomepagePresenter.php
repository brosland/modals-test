<?php

namespace App\Presenters;

use App\Components\ExampleModal\ExampleModal;
use App\Components\ExampleModal\ExampleModalFactory;
use Brosland\Modals\UI\ModalTrait;
use Nette\Application\AbortException;
use Nette\Application\UI\InvalidLinkException;
use Nette\Application\UI\Presenter;

final class HomepagePresenter extends Presenter
{
    use ModalTrait;

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
    }

    protected function beforeRender(): void
    {
        parent::beforeRender();

        $this->updateModal($this);
    }

    public function handleExampleModal(): void
    {
        /** @var ExampleModal $modal */
        $modal = $this['exampleModal'];
        $modal->open();
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
