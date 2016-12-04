<?php

namespace Fogio\View;

interface TemplateResolverAwareInterface
{
    public function setTemaplateResolver(TemplateResolverInterface $resolver);
}
