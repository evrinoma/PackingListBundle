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

namespace Evrinoma\PackingListBundle\Facade\Depart;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\PackingListBundle\Exception\Depart\DepartCannotBeCreatedException;
use Evrinoma\PackingListBundle\Exception\Depart\DepartCannotBeRemovedException;
use Evrinoma\PackingListBundle\Exception\Depart\DepartCannotBeSavedException;
use Evrinoma\PackingListBundle\Manager\Depart\CommandManagerInterface;
use Evrinoma\PackingListBundle\Manager\Depart\QueryManagerInterface;
use Evrinoma\PackingListBundle\PreValidator\Depart\DtoPreValidatorInterface;
use Evrinoma\UtilsBundle\Adaptor\AdaptorRegistryInterface;
use Evrinoma\UtilsBundle\Facade\FacadeTrait;
use Evrinoma\UtilsBundle\Handler\HandlerInterface;

final class Facade implements FacadeInterface
{
    use FacadeTrait;

    protected CommandManagerInterface $commandManager;

    protected QueryManagerInterface $queryManager;

    protected DtoPreValidatorInterface $preValidator;

    public function __construct(
        CommandManagerInterface $commandManager,
        QueryManagerInterface $queryManager,
        AdaptorRegistryInterface $adaptorRegistry,
        DtoPreValidatorInterface $preValidator,
        HandlerInterface $handler
    ) {
        $this->adaptorRegistry = $adaptorRegistry;
        $this->commandManager = $commandManager;
        $this->queryManager = $queryManager;
        $this->preValidator = $preValidator;
        $this->handler = $handler;
    }

    public function post(DtoInterface $dto, string $group, array &$data): void
    {
        throw new DepartCannotBeCreatedException();
    }

    public function put(DtoInterface $dto, string $group, array &$data): void
    {
        throw new DepartCannotBeSavedException();
    }

    public function delete(DtoInterface $dto, string $group, array &$data): void
    {
        throw new DepartCannotBeRemovedException();
    }
}
