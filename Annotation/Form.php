<?php

/**
 * This file is part of the Fosvn package.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fosvn\Bundle\FactoryBundle\Annotation;

/**
 * @Annotation
 */
class Form
{
    protected $_fields = array();

    public function __construct(array $data)
    {
        $this->_fields = $data;
    }
}
