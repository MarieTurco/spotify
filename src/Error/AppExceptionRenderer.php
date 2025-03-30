<?php

namespace App\Error;

use Cake\Error\Renderer\WebExceptionRenderer;
use Authorization\Exception\ForbiddenException;
use Psr\Http\Message\ResponseInterface;


class AppExceptionRenderer extends WebExceptionRenderer
{
    public function render(): ResponseInterface
    {
        $exception = $this->error;
        if ($exception instanceof ForbiddenException) {
            $pagesController = new \App\Controller\PagesController($this->controller->getRequest(), $this->controller->getResponse());
            return $pagesController->redirect(['controller' => 'Pages', 'action' => 'display', 'error']);
        }
        return parent::render();
    }
}
