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

namespace Evrinoma\PackingListBundle\Repository\PackingList;

use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Evrinoma\PackingListBundle\Dto\PackingListApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\PackingList\PackingListCannotBeSavedException;
use Evrinoma\PackingListBundle\Exception\PackingList\PackingListNotFoundException;
use Evrinoma\PackingListBundle\Exception\PackingList\PackingListProxyException;
use Evrinoma\PackingListBundle\Mediator\PackingList\QueryMediatorInterface;
use Evrinoma\PackingListBundle\Model\PackingList\PackingListInterface;
use Evrinoma\UtilsBundle\Repository\Api\RepositoryWrapper;
use Evrinoma\UtilsBundle\Repository\RepositoryWrapperInterface;

class PackingListRepository extends RepositoryWrapper implements PackingListRepositoryInterface, RepositoryWrapperInterface
{
    private QueryMediatorInterface $mediator;

    /**
     * @param string                 $entityClass
     * @param QueryMediatorInterface $mediator
     */
    public function __construct(string $entityClass, QueryMediatorInterface $mediator)
    {
        $this->mediator = $mediator;
        $this->entityClass = $entityClass;
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
        try {
            $this->persistWrapped($packingList);
        } catch (ORMInvalidArgumentException $e) {
            throw new PackingListCannotBeSavedException($e->getMessage());
        }

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
        $builder = $this->createQueryBuilderWrapped($this->mediator->alias());

        $this->mediator->createQuery($dto, $builder);

        $packingLists = $this->mediator->getResult($dto, $builder);

        if (0 === \count($packingLists)) {
            throw new PackingListNotFoundException('Cannot find packing list by findByCriteria');
        }

        return $packingLists;
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
        /** @var PackingListInterface $packingList */
        $packingList = $this->findWrapped($id);

        if (null === $packingList) {
            throw new PackingListNotFoundException("Cannot find packing list with id $id");
        }

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
        $packingList = $this->referenceWrapped($id);

        if (!$this->containsWrapped($packingList)) {
            throw new PackingListProxyException("Proxy doesn't exist with $id");
        }

        return $packingList;
    }
}
