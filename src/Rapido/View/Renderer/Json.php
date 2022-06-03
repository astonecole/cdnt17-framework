<?php

namespace Rapido\View\Renderer;

class Json extends AbstractRenderer
{
    public function render($data, array $options = [])
    {    
        if (!empty($options)) {
            $this->setOptions($options);
        }

        $contentType = sprintf('%s; %s', $this->getOption('content-type'), $this->getOption('charset'));

        $this->getResponse()->getHeader()->set('Content-Type', $contentType);
        $this->getResponse()->send(json_encode($data, $this->getOption('flags'), $this->getOption('depth')));
    }
}
