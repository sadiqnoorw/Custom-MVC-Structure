<?php

namespace App;

use App\Exception\ViewNotFoundException;
class View {
    public function __construct(
        protected string $view,
        protected array $params = [],
    ) {

    }

    public static function make(string $view, array $params = []): static 
    {
        return new static($view, $params);
    }

    public function render(): string
    {
        if(!empty($this->params)) {
            foreach($this->params as $key => $value) {
                $$key = $value;
            }
        }
        $filePath = VIEW_PATH . "/" . $this->view . '.php';
        if (! file_exists($filePath)) {
            throw new ViewNotFoundException();
        }

        ob_start();
            include $filePath;
        return (string) ob_get_clean();
    }

    public function __toString()
    {
        return $this->render();
    }

    public function __get(string $name)
    {
        return $this->params[$name] ?? null;
    }


}