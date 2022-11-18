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

namespace Evrinoma\PackingListBundle\Repository\Group;

use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Evrinoma\PackingListBundle\Dto\GroupApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\Group\GroupCannotBeSavedException;
use Evrinoma\PackingListBundle\Exception\Group\GroupNotFoundException;
use Evrinoma\PackingListBundle\Exception\Group\GroupProxyException;
use Evrinoma\PackingListBundle\Mediator\Group\QueryMediatorInterface;
use Evrinoma\PackingListBundle\Model\Group\GroupInterface;

trait GroupRepositoryTrait
{
    private QueryMediatorInterface $mediator;

    /**
     * @param GroupInterface $group
     *
     * @return bool
     *
     * @throws GroupCannotBeSavedException
     * @throws ORMException
     */
    public function save(GroupInterface $group): bool
    {
        try {
            $this->persistWrapped($group);
        } catch (ORMInvalidArgumentException $e) {
            throw new GroupCannotBeSavedException($e->getMessage());
        }

        return true;
    }

    /**
     * @param GroupInterface $group
     *
     * @return bool
     */
    public function remove(GroupInterface $group): bool
    {
        return true;
    }

    /**
     * @param GroupApiDtoInterface $dto
     *
     * @return array
     *
     * @throws GroupNotFoundException
     */
    public function findByCriteria(GroupApiDtoInterface $dto): array
    {
        $builder = $this->createQueryBuilderWrapped($this->mediator->alias());

        $this->mediator->createQuery($dto, $builder);

        $groups = $this->mediator->getResult($dto, $builder);

        if (0 === \count($groups)) {
            throw new GroupNotFoundException('Cannot find group by findByCriteria');
        }

        return $groups;
    }

    /**
     * @param      $id
     * @param null $lockMode
     * @param null $lockVersion
     *
     * @return mixed
     *
     * @throws GroupNotFoundException
     */
    public function find($id, $lockMode = null, $lockVersion = null): GroupInterface
    {
        /** @var GroupInterface $group */
        $group = $this->findWrapped($id);

        if (null === $group) {
            throw new GroupNotFoundException("Cannot find group with id $id");
        }

        return $group;
    }

    /**
     * @param string $id
     *
     * @return GroupInterface
     *
     * @throws GroupProxyException
     * @throws ORMException
     */
    public function proxy(string $id): GroupInterface
    {
        $group = $this->referenceWrapped($id);

        if (!$this->containsWrapped($group)) {
            throw new GroupProxyException("Proxy doesn't exist with $id");
        }

        return $group;
    }
}
