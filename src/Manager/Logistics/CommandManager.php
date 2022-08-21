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
use Evrinoma\PackingListBundle\Mediator\Logistics\CommandMediatorInterface;
use Evrinoma\PackingListBundle\Model\Logistics\LogisticsInterface;
use Evrinoma\PackingListBundle\Repository\Logistics\LogisticsCommandRepositoryInterface;
use Evrinoma\UtilsBundle\Validator\ValidatorInterface;

final class CommandManager implements CommandManagerInterface
{
    private LogisticsCommandRepositoryInterface $repository;
    private ValidatorInterface            $validator;
    private LogisticsFactoryInterface           $factory;
    private CommandMediatorInterface      $mediator;

    /**
     * @param ValidatorInterface                  $validator
     * @param LogisticsCommandRepositoryInterface $repository
     * @param LogisticsFactoryInterface           $factory
     * @param CommandMediatorInterface            $mediator
     */
    public function __construct(ValidatorInterface $validator, LogisticsCommandRepositoryInterface $repository, LogisticsFactoryInterface $factory, CommandMediatorInterface $mediator)
    {
        $this->validator = $validator;
        $this->repository = $repository;
        $this->factory = $factory;
        $this->mediator = $mediator;
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
            $logistics = $this->repository->find($dto->getPackingListId());
        } catch (LogisticsNotFoundException $e) {
            throw $e;
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
            $logistics = $this->repository->find($dto->getPackingListId());
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
