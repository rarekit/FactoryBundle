<?php
/**
 * This file is part of the Fosvn package.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fosvn\Bundle\FactoryBundle\Domain\Manager;

use Doctrine\ORM\EntityManager;
use Fosvn\Bundle\FactoryBundle\Domain\Entity\EntityInterface;

/**
 * Manager
 * 
 * @author Quang Tran <quang.tran@fosvn.com>
 * @package Fosvn
 * @access public
 */
class Manager implements ManagerInterface {

    protected $_entityManager;
    protected $_data;

    /**
     * @param \Doctrine\ORM\EntityManager $manager
     */
    public function __construct(EntityManager $manager, $data = array()) {
        $this->_entityManager = $manager;
        $this->_data = $data;
    }

    /* (non-PHPdoc)
     * @see \Fosvn\Bundle\FactoryBundle\Domain\Manager\ManagerInterface::getRepository()
     */
    public function getRepository() {
        if (empty($this->_data)) {
            return null;
        }
        return $this->_entityManager->getRepository($this->_data['entity_class']);
    }

    /**
     * @param object $object
     */
    public function save(EntityInterface $entity, $isFlush = true) {
        try {
            $this->_entityManager->persist($entity);
            if ($isFlush) {
                $this->_entityManager->flush();
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @param object $entity
     * @param string $isFlush
     */
    public function delete(EntityInterface $entity, $isFlush = true) {
        try {
            $this->_entityManager->remove($entity);
            if ($isFlush) {
                $this->_entityManager->flush();
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
    
    /**
     * get objects by criterias
     * 
     * @param array   $criteria
     * @param array   $order
     * @param integer $limit
     * @param integer $offset
     * @return null|array
     */
    public function findBy($criteria, $order, $limit = null, $offset = null)
    {
        return $this->getRepository()->findBy($criteria, $order, $limit, $offset);
    }

    /**
     * get total of records by criterias
     * 
     * @param type $criteria
     * @return integer
     */
    public function countBy($criteria = array())
    {
        return $this->getRepository()->countBy($this->_filter($criteria));
    }
    
    /**
     * filters
     * 
     * @param array $criteria
     * @return array
     */
    protected function _filter($criteria)
    {
        return $criteria;
    }

}
