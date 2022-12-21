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

namespace Evrinoma\PackingListBundle\Manager\LogisticsGroup;

use Evrinoma\PackingListBundle\Dto\LogisticsGroupApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\LogisticsGroup\LogisticsGroupCannotBeCreatedException;
use Evrinoma\PackingListBundle\Exception\LogisticsGroup\LogisticsGroupCannotBeRemovedException;
use Evrinoma\PackingListBundle\Exception\LogisticsGroup\LogisticsGroupCannotBeSavedException;
use Evrinoma\PackingListBundle\Exception\LogisticsGroup\LogisticsGroupInvalidException;
use Evrinoma\PackingListBundle\Exception\LogisticsGroup\LogisticsGroupNotFoundException;
use Evrinoma\PackingListBundle\Factory\LogisticsGroup\FactoryInterface;
use Evrinoma\PackingListBundle\Manager\Depart\QueryManagerInterface as DepartQueryManagerInterface;
use Evrinoma\PackingListBundle\Manager\Group\QueryManagerInterface as GroupQueryManagerInterface;
use Evrinoma\PackingListBundle\Mediator\LogisticsGroup\CommandMediatorInterface;
use Evrinoma\PackingListBundle\Model\LogisticsGroup\LogisticsGroupInterface;
use Evrinoma\PackingListBundle\Repository\LogisticsGroup\LogisticsGroupRepositoryInterface;
use Evrinoma\UtilsBundle\Validator\ValidatorInterface;

final class CommandManager implements CommandManagerInterface
{
    private LogisticsGroupRepositoryInterface $repository;
    private ValidatorInterface $validator;
    private FactoryInterface $factory;
    private CommandMediatorInterface $mediator;

    private GroupQueryManagerInterface $groupQueryManager;
    private DepartQueryManagerInterface $departQueryManager;

    /**
     * @param ValidatorInterface                $validator
     * @param LogisticsGroupRepositoryInterface $repository
     * @param FactoryInterface                  $factory
     * @param CommandMediatorInterface          $mediator
     * @param GroupQueryManagerInterface        $groupQueryManager
     * @param DepartQueryManagerInterface       $departQueryManager
     */
    public function __construct(ValidatorInterface $validator, LogisticsGroupRepositoryInterface $repository, FactoryInterface $factory, CommandMediatorInterface $mediator, GroupQueryManagerInterface $groupQueryManager, DepartQueryManagerInterface $departQueryManager)
    {
        $this->validator = $validator;
        $this->repository = $repository;
        $this->factory = $factory;
        $this->mediator = $mediator;
        $this->groupQueryManager = $groupQueryManager;
        $this->departQueryManager = $departQueryManager;
    }

    /**
     * @param LogisticsGroupApiDtoInterface $dto
     *
     * @return LogisticsGroupInterface
     *
     * @throws LogisticsGroupInvalidException
     * @throws LogisticsGroupCannotBeCreatedException
     * @throws LogisticsGroupCannotBeSavedException
     */
    public function post(LogisticsGroupApiDtoInterface $dto): LogisticsGroupInterface
    {
        $logistics = $this->factory->create($dto);

        try {
            $logistics->setDepart($this->departQueryManager->proxy($dto->getDepartApiDto()));
        } catch (\Exception $e) {
            throw new LogisticsGroupCannotBeCreatedException($e->getMessage());
        }

        try {
            $logistics->setGroup($this->groupQueryManager->proxy($dto->getGroupApiDto()));
        } catch (\Exception $e) {
            throw new LogisticsGroupCannotBeCreatedException($e->getMessage());
        }

        $this->mediator->onCreate($dto, $logistics);

        $errors = $this->validator->validate($logistics);

        if (\count($errors) > 0) {
            $errorsString = (string) $errors;

            throw new LogisticsGroupInvalidException($errorsString);
        }

        $this->repository->save($logistics);

        return $logistics;
    }

    /**
     * @param LogisticsGroupApiDtoInterface $dto
     *
     * @return LogisticsGroupInterface
     *
     * @throws LogisticsGroupInvalidException
     * @throws LogisticsGroupNotFoundException
     * @throws LogisticsGroupCannotBeSavedException
     */
    public function put(LogisticsGroupApiDtoInterface $dto): LogisticsGroupInterface
    {
        try {
            $logistics = $this->repository->find($dto->getGroupApiDto()->idToString());
        } catch (LogisticsGroupNotFoundException $e) {
            throw $e;
        }

        try {
            $logistics->setGroup($this->groupQueryManager->proxy($dto->getGroupApiDto()));
        } catch (\Exception $e) {
            throw new LogisticsGroupCannotBeSavedException($e->getMessage());
        }

        $this->mediator->onUpdate($dto, $logistics);

        $errors = $this->validator->validate($logistics);

        if (\count($errors) > 0) {
            $errorsString = (string) $errors;

            throw new LogisticsGroupInvalidException($errorsString);
        }

        $this->repository->save($logistics);

        return $logistics;
    }

    /**
     * @param LogisticsGroupApiDtoInterface $dto
     *
     * @throws LogisticsGroupCannotBeRemovedException
     * @throws LogisticsGroupNotFoundException
     */
    public function delete(LogisticsGroupApiDtoInterface $dto): void
    {
        try {
            $logistics = $this->repository->find($dto->getGroupApiDto()->idToString());
        } catch (LogisticsGroupNotFoundException $e) {
            throw $e;
        }
        $this->mediator->onDelete($dto, $logistics);
        try {
            $this->repository->remove($logistics);
        } catch (LogisticsGroupCannotBeRemovedException $e) {
            throw $e;
        }
    }
}
