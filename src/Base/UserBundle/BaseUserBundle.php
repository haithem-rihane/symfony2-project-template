<?php

namespace Base\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class BaseUserBundle.
 */
class BaseUserBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
