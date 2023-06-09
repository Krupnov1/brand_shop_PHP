<?php

namespace app\engine;

use app\interfaces\IRenderer;

class Render implements IRenderer {

    public function renderTemplate($template, $params = []) { 
        ob_start();
        if (!is_null($params)) {
            extract($params);
        }
        $templatePath = App::call()->config['template_dir'] . $template . ".php";
        if (file_exists($templatePath)) {
            include $templatePath;
        }
        return ob_get_clean(); 
    }
}