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
use Fosvn\Bundle\FactoryBundle\Domain\Manager\Manager;

/**
 * ManagerFactory
 * 
 * @author Quang Tran <quang.tran@fosvn.com>
 * @package Fosvn
 * @access public
 */
class ManagerFactory {

    protected $_container;
    protected $_data;

    /**
     * Constructor
     * 
     * @param ContainerInterface $container
     * @param array $data
     */
    public function __construct(ContainerInterface $container, $data)
    {
        $this->_container = $container;   
        $this->_data = $data;
    }

    /**
     * create an manager by class name
     * 
     * @param string $name
     * @param array  $args
     * @return mixed
     */
    public function create($name)
    {
        $manager = null;
        if (isset($this->_data[$name])) {
            $conn = !is_null($this->_data[$name]['connection']) 
                    ? $this->_data[$name]['connection'] : 'doctrine';
            $doctrineMgr = $this->_container->get($conn)->getManager();
            if (isset($this->_data[$name]['manager_class'])) {
                $manager = new $this->_data[$name]['manager_class']($doctrineMgr, $this->_data[$name]);
            } else {
                $manager = new Manager($doctrineMgr, $this->_data[$name]);
            }
        } 
        
        return $manager;
    }
}
  
