<?php
declare(strict_types=1);

namespace App\Translation;

use Nette\Localization\ITranslator;

class SimpleTranslator implements ITranslator
{
    /**
     * @var array
     */
    private $dictionary = [];


    public function addTranslations(array $translations, string $domain = ''): void
    {
        foreach ($translations as $key => $value) {
            if (is_array($value)) {
                $this->addTranslations($value, $domain . ($domain === '' ? '' : '.') . $key);
            } else {
                $this->dictionary[$domain . '.' . $key] = $value;
            }
        }
    }

    /**
     * Translates the given string.
     *
     * @param  mixed    message
     * @param  int      plural count
     * @return string
     */
    public function translate($message, $count = null)
    {
        return isset($this->dictionary[$message]) ? $this->dictionary[$message] : $message;
    }
}