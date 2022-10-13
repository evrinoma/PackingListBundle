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

namespace Evrinoma\PackingListBundle\Manager\Logistics;

use Evrinoma\PackingListBundle\Dto\LogisticsApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\Logistics\LogisticsCannotBeCreatedException;
use Evrinoma\PackingListBundle\Exception\Logistics\LogisticsCannotBeRemovedException;
use Evrinoma\PackingListBundle\Exception\Logistics\LogisticsCannotBeSavedException;
use Evrinoma\PackingListBundle\Exception\Logistics\LogisticsInvalidException;
use Evrinoma\PackingListBundle\Exception\Logistics\LogisticsNotFoundException;
use Evrinoma\PackingListBundle\Factory\LogisticsFactoryInterface;
use Evrinoma\PackingListBundle\Manager\Depart\QueryManagerInterface as DepartQueryManagerInterface;
use Evrinoma\PackingListBundle\Manager\PackingList\QueryManagerInterface as PackingListQueryManagerInterface;
use Evrinoma\PackingListBundle\Mediator\Logistics\CommandMediatorInterface;
use Evrinoma\PackingListBundle\Model\Logistics\LogisticsInterface;
use Evrinoma\PackingListBundle\Repository\Logistics\LogisticsRepositoryInterface;
use Evrinoma\UtilsBundle\Validator\ValidatorInterface;

final class CommandManager implements CommandManagerInterface
{
    private LogisticsRepositoryInterface $repository;
    private ValidatorInterface $validator;
    private LogisticsFactoryInterface $factory;
    private CommandMediatorInterface $mediator;

    private PackingListQueryManagerInterface $packingListQueryManager;
    private DepartQueryManagerInterface $departQueryManager;

    /**
     * @param ValidatorInterface               $validator
     * @param LogisticsRepositoryInterface     $repository
     * @param LogisticsFactoryInterface        $factory
     * @param CommandMediatorInterface         $mediator
     * @param PackingListQueryManagerInterface $packingListQueryManager
     * @param DepartQueryManagerInterface      $departQueryManager
     */
    public function __construct(ValidatorInterface $validator, LogisticsRepositoryInterface $repository, LogisticsFactoryInterface $factory, CommandMediatorInterface $mediator, PackingListQueryManagerInterface $packingListQueryManager, DepartQueryManagerInterface $departQueryManager)
    {
        $this->validator = $validator;
        $this->repository = $repository;
        $this->factory = $factory;
        $this->mediator = $mediator;
        $this->packingListQueryManager = $packingListQueryManager;
        $this->departQueryManager = $departQueryManager;
    }

    /**
     * @param LogisticsApiDtoInterface $dto
     *
     * @return LogisticsInterface
     *
     * @throws LogisticsInvalidException
     * @throws LogisticsCannotBeCreatedException
     * @throws LogisticsCannotBeSavedException
     */
    public function post(LogisticsApiDtoInterface $dto): LogisticsInterface
    {
        $logistics = $this->factory->create($dto);

        try {
            $logistics->setDepart($this->departQueryManager->proxy($dto->getDepartApiDto()));
        } catch (\Exception $e) {
            throw new LogisticsCannotBeCreatedException($e->getMessage());
        }

        try {
            $logistics->setPackingList($this->packingListQueryManager->proxy($dto->getPackingListApiDto()));
        } catch (\Exception $e) {
            throw new LogisticsCannotBeCreatedException($e->getMessage());
        }

        $this->mediator->onCreate($dto, $logistics);

        $errors = $this->validator->validate($logistics);

        if (\count($errors) > 0) {
            $errorsString = (string) $errors;

            throw new LogisticsInvalidException($errorsString);
        }

        $this->repository->save($logistics);

        return $logistics;
    }

    /**
     * @param LogisticsApiDtoInterface $dto
     *
     * @return LogisticsInterface
     *
     * @throws LogisticsInvalidException
     * @throws LogisticsNotFoundException
     * @throws LogisticsCannotBeSavedException
     */
    public function put(LogisticsApiDtoInterface $dto): LogisticsInterface
    {
        try {
            $logistics = $this->repository->find($dto->getPackingListApiDto()->idToString());
        } catch (LogisticsNotFoundException $e) {
            throw $e;
        }

        try {
            $logistics->setDepart($this->departQueryManager->proxy($dto->getDepartApiDto()));
        } catch (\Exception $e) {
            throw new LogisticsCannotBeSavedException($e->getMessage());
        }

        try {
            $logistics->setPackingList($this->packingListQueryManager->proxy($dto->getPackingListApiDto()));
        } catch (\Exception $e) {
            throw new LogisticsCannotBeSavedException($e->getMessage());
        }

        $this->mediator->onUpdate($dto, $logistics);

        $errors = $this->validator->validate($logistics);

        if (\count($errors) > 0) {
            $errorsString = (string) $errors;

            throw new LogisticsInvalidException($errorsString);
        }

        $this->repository->save($logistics);

        return $logistics;
    }

    /**
     * @param LogisticsApiDtoInterface $dto
     *
     * @throws LogisticsCannotBeRemovedException
     * @throws LogisticsNotFoundException
     */
    public function delete(LogisticsApiDtoInterface $dto): void
    {
        try {
            $logistics = $this->repository->find($dto->getPackingListApiDto()->idToString());
        } catch (LogisticsNotFoundException $e) {
            throw $e;
        }
        $this->mediator->onDelete($dto, $logistics);
        try {
            $this->repository->remove($logistics);
        } catch (LogisticsCannotBeRemovedException $e) {
            throw $e;
        }
    }
}
