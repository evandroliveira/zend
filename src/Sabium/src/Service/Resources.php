<?php

namespace Sabium\Service;

use Zend\Permissions\Acl;

class Resources
{
    public function __construct(Acl $acl)
    {
        $acl->addResource(new GenericResource(PostController::class));
    }
}
