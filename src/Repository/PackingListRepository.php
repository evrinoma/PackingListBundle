<?php

declare(strict_types=1);

/*
 * This file is part of the package.
 *
 * (c) Nikolay Nikolaev <evrinoma@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evrinoma\PackingListBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Doctrine\Persistence\ManagerRegistry;
use Evrinoma\PackingListBundle\Dto\PackingListApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\PackingListCannotBeSavedException;
use Evrinoma\PackingListBundle\Exception\PackingListNotFoundException;
use Evrinoma\PackingListBundle\Exception\PackingListProxyException;
use Evrinoma\PackingListBundle\Mediator\QueryMediatorInterface;
use Evrinoma\PackingListBundle\Model\PackingList\PackingListInterface;

class PackingListRepository implements ServiceEntityRepositoryInterface, PackingListRepositoryInterface
{
    private QueryMediatorInterface $mediator;

    /**
     * @param string                 $entityClass
     * @param QueryMediatorInterface $mediator
     */
    public function __construct(string $entityClass, QueryMediatorInterface $mediator)
    {
//        parent::__construct($registry, $entityClass);
        $this->mediator = $mediator;
    }

    /**
     * @param PackingListInterface $packingList
     *
     * @return bool
     *
     * @throws PackingListCannotBeSavedException
     * @throws ORMException
     */
    public function save(PackingListInterface $packingList): bool
    {
//        try {
//            $this->getEntityManager()->persist($packingList);
//        } catch (ORMInvalidArgumentException $e) {
//            throw new PackingListCannotBeSavedException($e->getMessage());
//        }

        return true;
    }

    /**
     * @param PackingListInterface $packingList
     *
     * @return bool
     */
    public function remove(PackingListInterface $packingList): bool
    {
        return true;
    }

    /**
     * @param PackingListApiDtoInterface $dto
     *
     * @return array
     *
     * @throws PackingListNotFoundException
     */
    public function findByCriteria(PackingListApiDtoInterface $dto): array
    {
//        $builder = $this->createQueryBuilder($this->mediator->alias());
//
//        $this->mediator->createQuery($dto, $builder);
//
//        $packingList = $this->mediator->getResult($dto, $builder);
//
//        if (0 === \count($packingList)) {
//            throw new PackingListNotFoundException('Cannot find packing list by findByCriteria');
//        }
        $packingList = [];

        return $packingList;
    }

    /**
     * @param      $id
     * @param null $lockMode
     * @param null $lockVersion
     *
     * @return mixed
     *
     * @throws PackingListNotFoundException
     */
    public function find($id, $lockMode = null, $lockVersion = null): PackingListInterface
    {
//        /** @var PackingListInterface $packingList */
//        $packingList = parent::find($id);
//
//        if (null === $packingList) {
//            throw new PackingListNotFoundException("Cannot find packing list with id $id");
//        }
        $packingList = [];

        return $packingList;
    }

    /**
     * @param string $id
     *
     * @return PackingListInterface
     *
     * @throws PackingListProxyException
     * @throws ORMException
     */
    public function proxy(string $id): PackingListInterface
    {
//        $em = $this->getEntityManager();
//
//        $packingList = $em->getReference($this->getEntityName(), $id);
//
//        if (!$em->contains($packingList)) {
//            throw new PackingListProxyException("Proxy doesn't exist with $id");
//        }
        $packingList = [];

        return $packingList;
    }
}
