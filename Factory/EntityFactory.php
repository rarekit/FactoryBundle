<?php

/**
 * This file is part of the Fosvn package.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fosvn\Bundle\FactoryBundle\Factory;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * EntityFactory
 * 
 * @author Quang Tran <quang.tran@fosvn.com>
 * @package Fosvn
 * @access public
 */
class EntityFactory
{

    protected $_container;
    protected $_data;

    /**
     * Constructor
     * 
     * @param ContainerInterface $container
     * @param array $data
     */
    public function __construct(ContainerInterface $container, $data = array())
    {
        $this->_container = $container;
        $this->_data = $data;
    }

    /**
     * create an object by class name
     * 
     * @param string $name
     * @param array  $args
     * @return mixed
     */
    public function create($name, $args = array())
    {
        $entity = null;
        if (isset($this->_data[$name])) {
            $entity = new $this->_data[$name]['entity_class']($args);
        }

        return $entity;
    }

    /**
     * get an object by id
     * 
     * @param string $name
     * @param array  $id
     * @return mixed
     */
    public function get($name, $id)
    {
        if (isset($this->_data[$name])) {
            $entityClass = $this->_data[$name]['entity_class'];
        } else {
            return null;
        }

        $conn = !is_null($this->_data[$name]['connection']) 
                ? $this->_data[$name]['connection'] : 'doctrine';
        return $this->_container->get($conn)
                        ->getManager()
                        ->getRepository($entityClass)
                        ->find($id);
    }

}
