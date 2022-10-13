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

namespace Evrinoma\PackingListBundle\Facade\LogisticsGroup;

use Doctrine\Persistence\ManagerRegistry;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\PackingListBundle\Exception\LogisticsGroup\LogisticsGroupCannotBeRemovedException;
use Evrinoma\PackingListBundle\Exception\LogisticsGroup\LogisticsGroupCannotBeSavedException;
use Evrinoma\PackingListBundle\Exception\LogisticsGroup\LogisticsGroupNotFoundException;
use Evrinoma\PackingListBundle\Manager\LogisticsGroup\CommandManagerInterface;
use Evrinoma\PackingListBundle\Manager\LogisticsGroup\QueryManagerInterface;
use Evrinoma\PackingListBundle\PreValidator\LogisticsGroup\DtoPreValidatorInterface;
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

    public function put(DtoInterface $dto, string $group, array &$data): void
    {
        throw new LogisticsGroupCannotBeSavedException();
    }

    public function delete(DtoInterface $dto, string $group, array &$data): void
    {
        throw new LogisticsGroupCannotBeRemovedException();
    }

    public function criteria(DtoInterface $dto, string $group, array &$data): void
    {
        throw new LogisticsGroupNotFoundException();
    }

    public function get(DtoInterface $dto, string $group, array &$data): void
    {
        throw new LogisticsGroupNotFoundException();
    }
}
