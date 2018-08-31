<?php

namespace MorningTrain\Foundation\Context\Plugins\Assets;

class StylesheetRegistrar extends Registrar
{

    protected function fileToString(array $entry)
    {
        $src = $entry['src'] ?? '';
        $entry = array_merge(['rel' => 'stylesheet', 'href' => $src], array_except($entry, 'src'));
        $attributes = $this->toAttributesString($entry);
        return "<link {$attributes} />";
    }

    protected function plainToString(array $entry)
    {
        $src = $entry['src'];
        $entry = array_except($entry, 'src');
        $attributes = $this->toAttributesString($entry);
        return "<style {$attributes}>{$src}</style>";
    }

}