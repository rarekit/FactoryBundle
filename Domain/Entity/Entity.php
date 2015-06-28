<?php
/**
 * This file is part of the Fosvn package.
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Fosvn\Bundle\FactoryBundle\Domain\Entity;
use Doctrine\ORM\EntityManager;
/**
 * Entity
 * 
 * @author Quang Tran <quang.tran@fosvn.com>
 * @package Fosvn
 * @access public
 */
class Entity implements EntityInterface 
{
    protected $_em;
    
    public function __construct(EntityManager $em = null)
    {
        $this->_em = $em;
    }
    
    protected function save()
    {
        if (!$this->_em instanceof EntityManager) {
            throw new Exception();
        }
        $this->_em->save($this);
    }
}
 
