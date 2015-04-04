<?php

namespace Base\LogBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Gedmo\Tool\Wrapper\EntityWrapper;

/**
 * EntityLogRepository.
 */
class EntityLogRepository extends EntityRepository
{
    /**
     * Gets log entries for specific entity.
     *
     * @param mixed $entity
     * @param mixed $action
     * @param int   $limit
     *
     * @return array
     */
    public function getLogEntriesLimit($entity, $action = null, $limit = 10)
    {
        $wrapped = new EntityWrapper($entity, $this->_em);
        $objectClass = $wrapped->getMetadata()->name;
        $objectId = $wrapped->getIdentifier();

        $query = $this->createQueryBuilder('b')
            ->andWhere('b.objectId = :objectId')
            ->andWhere('b.objectClass = :objectClass')
            ->setParameter('objectId', $objectId)
            ->setParameter('objectClass', $objectClass)
            ->addOrderBy('b.loggedAt', 'DESC')
            ->setMaxResults($limit);

        if ($action !== null) {
            if (!is_array($action)) {
                $action = [$action];
            }
            $query->andWhere('b.action in (:act)')
                ->setParameter('act', $action);
        }

        return $query->getQuery()->getResult();
    }
}
