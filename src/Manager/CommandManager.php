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

namespace Evrinoma\PackingListBundle\Manager;

use Evrinoma\PackingListBundle\Dto\PackingListApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\PackingListCannotBeCreatedException;
use Evrinoma\PackingListBundle\Exception\PackingListCannotBeRemovedException;
use Evrinoma\PackingListBundle\Exception\PackingListCannotBeSavedException;
use Evrinoma\PackingListBundle\Exception\PackingListInvalidException;
use Evrinoma\PackingListBundle\Exception\PackingListNotFoundException;
use Evrinoma\PackingListBundle\Factory\PackingListFactoryInterface;
use Evrinoma\PackingListBundle\Mediator\CommandMediatorInterface;
use Evrinoma\PackingListBundle\Model\PackingList\PackingListInterface;
use Evrinoma\PackingListBundle\Repository\PackingListCommandRepositoryInterface;
use Evrinoma\UtilsBundle\Validator\ValidatorInterface;

final class CommandManager implements CommandManagerInterface
{
    private PackingListCommandRepositoryInterface $repository;
    private ValidatorInterface            $validator;
    private PackingListFactoryInterface           $factory;
    private CommandMediatorInterface      $mediator;

    /**
     * @param ValidatorInterface                    $validator
     * @param PackingListCommandRepositoryInterface $repository
     * @param PackingListFactoryInterface           $factory
     * @param CommandMediatorInterface              $mediator
     */
    public function __construct(ValidatorInterface $validator, PackingListCommandRepositoryInterface $repository, PackingListFactoryInterface $factory, CommandMediatorInterface $mediator)
    {
        $this->validator = $validator;
        $this->repository = $repository;
        $this->factory = $factory;
        $this->mediator = $mediator;
    }

    /**
     * @param PackingListApiDtoInterface $dto
     *
     * @return PackingListInterface
     *
     * @throws PackingListInvalidException
     * @throws PackingListCannotBeCreatedException
     * @throws PackingListCannotBeSavedException
     */
    public function post(PackingListApiDtoInterface $dto): PackingListInterface
    {
        $packingList = $this->factory->create($dto);

        $this->mediator->onCreate($dto, $packingList);

        $errors = $this->validator->validate($packingList);

        if (\count($errors) > 0) {
            $errorsString = (string) $errors;

            throw new PackingListInvalidException($errorsString);
        }

        $this->repository->save($packingList);

        return $packingList;
    }

    /**
     * @param PackingListApiDtoInterface $dto
     *
     * @return PackingListInterface
     *
     * @throws PackingListInvalidException
     * @throws PackingListNotFoundException
     * @throws PackingListCannotBeSavedException
     */
    public function put(PackingListApiDtoInterface $dto): PackingListInterface
    {
        try {
            $packingList = $this->repository->find($dto->getId());
        } catch (PackingListNotFoundException $e) {
            throw $e;
        }

        $this->mediator->onUpdate($dto, $packingList);

        $errors = $this->validator->validate($packingList);

        if (\count($errors) > 0) {
            $errorsString = (string) $errors;

            throw new PackingListInvalidException($errorsString);
        }

        $this->repository->save($packingList);

        return $packingList;
    }

    /**
     * @param PackingListApiDtoInterface $dto
     *
     * @throws PackingListCannotBeRemovedException
     * @throws PackingListNotFoundException
     */
    public function delete(PackingListApiDtoInterface $dto): void
    {
        try {
            $packingList = $this->repository->find($dto->getId());
        } catch (PackingListNotFoundException $e) {
            throw $e;
        }
        $this->mediator->onDelete($dto, $packingList);
        try {
            $this->repository->remove($packingList);
        } catch (PackingListCannotBeRemovedException $e) {
            throw $e;
        }
    }
}
