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

namespace Evrinoma\PackingListBundle\Repository\PackingListGroup;

use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Evrinoma\PackingListBundle\Dto\PackingListGroupApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\PackingListGroup\PackingListGroupCannotBeSavedException;
use Evrinoma\PackingListBundle\Exception\PackingListGroup\PackingListGroupNotFoundException;
use Evrinoma\PackingListBundle\Exception\PackingListGroup\PackingListGroupProxyException;
use Evrinoma\PackingListBundle\Mediator\PackingListGroup\QueryMediatorInterface;
use Evrinoma\PackingListBundle\Model\PackingListGroup\PackingListGroupInterface;

trait PackingListGroupRepositoryTrait
{
    private QueryMediatorInterface $mediator;

    /**
     * @param PackingListGroupInterface $packingList
     *
     * @return bool
     *
     * @throws PackingListGroupCannotBeSavedException
     * @throws ORMException
     */
    public function save(PackingListGroupInterface $packingList): bool
    {
        try {
            $this->persistWrapped($packingList);
        } catch (ORMInvalidArgumentException $e) {
            throw new PackingListGroupCannotBeSavedException($e->getMessage());
        }

        return true;
    }

    /**
     * @param PackingListGroupInterface $packingList
     *
     * @return bool
     */
    public function remove(PackingListGroupInterface $packingList): bool
    {
        return true;
    }

    /**
     * @param PackingListGroupApiDtoInterface $dto
     *
     * @return array
     *
     * @throws PackingListGroupNotFoundException
     */
    public function findByCriteria(PackingListGroupApiDtoInterface $dto): array
    {
        $builder = $this->createQueryBuilderWrapped($this->mediator->alias());

        $this->mediator->createQuery($dto, $builder);

        $packingLists = $this->mediator->getResult($dto, $builder);

        if (0 === \count($packingLists)) {
            throw new PackingListGroupNotFoundException('Cannot find packing list group by findByCriteria');
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
     * @throws PackingListGroupNotFoundException
     */
    public function find($id, $lockMode = null, $lockVersion = null): array
    {
        /** @var PackingListGroupInterface $packingList */
        $packingList = $this->findWrapped($id);

        if (null === $packingList) {
            throw new PackingListGroupNotFoundException("Cannot find packing list group with id $id");
        }

        return $packingList;
    }

    /**
     * @param string $id
     *
     * @return PackingListGroupInterface
     *
     * @throws PackingListGroupProxyException
     * @throws ORMException
     */
    public function proxy(string $id): PackingListGroupInterface
    {
        $packingList = $this->referenceWrapped($id);

        if (!$this->containsWrapped($packingList)) {
            throw new PackingListGroupProxyException("Proxy doesn't exist with $id");
        }

        return $packingList;
    }
}
