<?php
/**
 * This file is part of the Fosvn package.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Fosvn\Bundle\FactoryBundle\Domain\Manager;

use Fosvn\Bundle\FactoryBundle\Domain\Entity\EntityInterface;

/**
 * ManagerInterface
 * 
 * @author Quang Tran <quang.tran@fosvn.com>
 * @package Fosvn
 * @access public
 */
interface ManagerInterface {
    
    public function save(EntityInterface $entity, $isFlush);
    
    public function delete(EntityInterface $entity, $isFlush);
    
    public function getRepository();
    
    public function findBy($criteria, $order, $limit = null, $offset = null);
    
    public function countBy($criteria);
}
  