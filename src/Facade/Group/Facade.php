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

namespace Evrinoma\PackingListBundle\Facade\Group;

use Doctrine\Persistence\ManagerRegistry;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\PackingListBundle\Exception\Group\GroupCannotBeCreatedException;
use Evrinoma\PackingListBundle\Exception\Group\GroupCannotBeRemovedException;
use Evrinoma\PackingListBundle\Exception\Group\GroupCannotBeSavedException;
use Evrinoma\PackingListBundle\Exception\Group\GroupNotFoundException;
use Evrinoma\PackingListBundle\Manager\Group\CommandManagerInterface;
use Evrinoma\PackingListBundle\Manager\Group\QueryManagerInterface;
use Evrinoma\PackingListBundle\PreValidator\Group\DtoPreValidatorInterface;
use Evrinoma\UtilsBundle\Facade\FacadeTrait;
use Evrinoma\UtilsBundle\Handler\HandlerInterface;

final class Facade implements FacadeInterface
{
    use FacadeTrait;

    protected CommandManagerInterface $commandManager;

    protected QueryManagerInterface $queryManager;

    protected DtoPreValidatorInterface $preValidator;

    protected ManagerRegistry $managerRegistry;

    public function __construct(
        ManagerRegistry $managerRegistry,
        CommandManagerInterface $commandManager,
        QueryManagerInterface $queryManager,
        DtoPreValidatorInterface $preValidator,
        HandlerInterface $handler
    ) {
        $this->managerRegistry = $managerRegistry;
        $this->commandManager = $commandManager;
        $this->queryManager = $queryManager;
        $this->preValidator = $preValidator;
        $this->handler = $handler;
    }

    public function post(DtoInterface $dto, string $group, array &$data): void
    {
        throw new GroupCannotBeCreatedException();
    }

    public function put(DtoInterface $dto, string $group, array &$data): void
    {
        throw new GroupCannotBeSavedException();
    }

    public function delete(DtoInterface $dto, string $group, array &$data): void
    {
        throw new GroupCannotBeRemovedException();
    }

    public function get(DtoInterface $dto, string $group, array &$data): void
    {
        throw new GroupNotFoundException();
    }
}
