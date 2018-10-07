<?php
declare(strict_types=1);

namespace App\Components\ExampleModal;

use Nette\Application\UI\Form;

final class TitleForm extends Form
{
    public function __construct()
    {
        parent::__construct();

        $this->addText('title', 'Title')
            ->setRequired();

        $this->addSubmit('cancel', 'Cancel')
            ->setValidationScope([]);

        $this->addSubmit('change', 'Change');
    }
}