<?php

class View
{
    public function renderView($filename, $opt) {
        $path = __DIR__ . '/../app/' . $filename . '.php.html';
        extract($opt);
        ob_start();
        require $path;
        $text = ob_get_clean();
        return $text;
    }

}