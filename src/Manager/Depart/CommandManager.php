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

namespace Evrinoma\PackingListBundle\Manager\Depart;

use Evrinoma\PackingListBundle\Dto\DepartApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\Depart\DepartCannotBeCreatedException;
use Evrinoma\PackingListBundle\Exception\Depart\DepartCannotBeRemovedException;
use Evrinoma\PackingListBundle\Exception\Depart\DepartCannotBeSavedException;
use Evrinoma\PackingListBundle\Exception\Depart\DepartInvalidException;
use Evrinoma\PackingListBundle\Exception\Depart\DepartNotFoundException;
use Evrinoma\PackingListBundle\Factory\DepartFactoryInterface;
use Evrinoma\PackingListBundle\Mediator\Depart\CommandMediatorInterface;
use Evrinoma\PackingListBundle\Model\Depart\DepartInterface;
use Evrinoma\PackingListBundle\Repository\Depart\DepartRepositoryInterface;
use Evrinoma\UtilsBundle\Validator\ValidatorInterface;

final class CommandManager implements CommandManagerInterface
{
    private DepartRepositoryInterface $repository;
    private ValidatorInterface            $validator;
    private DepartFactoryInterface           $factory;
    private CommandMediatorInterface      $mediator;

    /**
     * @param ValidatorInterface               $validator
     * @param DepartRepositoryInterface $repository
     * @param DepartFactoryInterface           $factory
     * @param CommandMediatorInterface         $mediator
     */
    public function __construct(ValidatorInterface $validator, DepartRepositoryInterface $repository, DepartFactoryInterface $factory, CommandMediatorInterface $mediator)
    {
        $this->validator = $validator;
        $this->repository = $repository;
        $this->factory = $factory;
        $this->mediator = $mediator;
    }

    /**
     * @param DepartApiDtoInterface $dto
     *
     * @return DepartInterface
     *
     * @throws DepartInvalidException
     * @throws DepartCannotBeCreatedException
     * @throws DepartCannotBeSavedException
     */
    public function post(DepartApiDtoInterface $dto): DepartInterface
    {
        $depart = $this->factory->create($dto);

        $this->mediator->onCreate($dto, $depart);

        $errors = $this->validator->validate($depart);

        if (\count($errors) > 0) {
            $errorsString = (string) $errors;

            throw new DepartInvalidException($errorsString);
        }

        $this->repository->save($depart);

        return $depart;
    }

    /**
     * @param DepartApiDtoInterface $dto
     *
     * @return DepartInterface
     *
     * @throws DepartInvalidException
     * @throws DepartNotFoundException
     * @throws DepartCannotBeSavedException
     */
    public function put(DepartApiDtoInterface $dto): DepartInterface
    {
        try {
            $depart = $this->repository->find($dto->getId());
        } catch (DepartNotFoundException $e) {
            throw $e;
        }

        $this->mediator->onUpdate($dto, $depart);

        $errors = $this->validator->validate($depart);

        if (\count($errors) > 0) {
            $errorsString = (string) $errors;

            throw new DepartInvalidException($errorsString);
        }

        $this->repository->save($depart);

        return $depart;
    }

    /**
     * @param DepartApiDtoInterface $dto
     *
     * @throws DepartCannotBeRemovedException
     * @throws DepartNotFoundException
     */
    public function delete(DepartApiDtoInterface $dto): void
    {
        try {
            $depart = $this->repository->find($dto->getId());
        } catch (DepartNotFoundException $e) {
            throw $e;
        }
        $this->mediator->onDelete($dto, $depart);
        try {
            $this->repository->remove($depart);
        } catch (DepartCannotBeRemovedException $e) {
            throw $e;
        }
    }
}
