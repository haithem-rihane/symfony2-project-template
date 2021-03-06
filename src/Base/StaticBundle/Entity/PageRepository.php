<?php

namespace Base\StaticBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * PageRepository.
 */
class PageRepository extends EntityRepository
{
    /**
     * Gets maximal position for text.
     *
     * @param string $group
     *
     * @return mixed
     */
    public function getMaxTextPosition($group)
    {
        $query = $this->createQueryBuilder('p')
            ->select('max(p.position) as max_position')
            ->andWhere('p.groupName = :groupName')
            ->setParameter('groupName', $group);

        return $query->getQuery()->getOneOrNullResult();
    }

    /**
     * Finds next possible position for specific text in a group, moving up.
     *
     * @param int    $newPosition
     * @param string $group
     *
     * @return mixed
     */
    public function getNextUpPosition($newPosition, $group)
    {
        $query = $this->createQueryBuilder('p')
            ->select('p')
            ->andWhere('p.position <= :new_position')
            ->andWhere('p.groupName = :groupName')
            ->orderBy('p.position', 'DESC')
            ->setParameter('new_position', $newPosition)
            ->setParameter('groupName', $group)
            ->setMaxResults(1);

        return $query->getQuery()->getOneOrNullResult();
    }

    /**
     * Finds next possible position for specific text in a group, moving down.
     *
     * @param int    $newPosition
     * @param string $group
     *
     * @return mixed
     */
    public function getNextDownPosition($newPosition, $group)
    {
        $query = $this->createQueryBuilder('p')
            ->select('p')
            ->andWhere('p.position >= :new_position')
            ->andWhere('p.groupName = :groupName')
            ->orderBy('p.position', 'ASC')
            ->setParameter('new_position', $newPosition)
            ->setParameter('groupName', $group)
            ->setMaxResults(1);

        return $query->getQuery()->getOneOrNullResult();
    }
}
