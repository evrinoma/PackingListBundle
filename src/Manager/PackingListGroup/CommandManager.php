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

namespace Evrinoma\PackingListBundle\Manager\PackingListGroup;

use Evrinoma\PackingListBundle\Dto\PackingListGroupApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\PackingListGroup\PackingListGroupCannotBeCreatedException;
use Evrinoma\PackingListBundle\Exception\PackingListGroup\PackingListGroupCannotBeRemovedException;
use Evrinoma\PackingListBundle\Exception\PackingListGroup\PackingListGroupCannotBeSavedException;
use Evrinoma\PackingListBundle\Exception\PackingListGroup\PackingListGroupInvalidException;
use Evrinoma\PackingListBundle\Exception\PackingListGroup\PackingListGroupNotFoundException;
use Evrinoma\PackingListBundle\Factory\PackingListGroupFactoryInterface;
use Evrinoma\PackingListBundle\Mediator\PackingListGroup\CommandMediatorInterface;
use Evrinoma\PackingListBundle\Model\PackingListGroup\PackingListGroupInterface;
use Evrinoma\PackingListBundle\Repository\PackingListGroup\PackingListGroupRepositoryInterface;
use Evrinoma\UtilsBundle\Validator\ValidatorInterface;

final class CommandManager implements CommandManagerInterface
{
    private PackingListGroupRepositoryInterface $repository;
    private ValidatorInterface            $validator;
    private PackingListGroupFactoryInterface           $factory;
    private CommandMediatorInterface      $mediator;

    /**
     * @param ValidatorInterface                    $validator
     * @param PackingListGroupRepositoryInterface $repository
     * @param PackingListGroupFactoryInterface           $factory
     * @param CommandMediatorInterface              $mediator
     */
    public function __construct(ValidatorInterface $validator, PackingListGroupRepositoryInterface $repository, PackingListGroupFactoryInterface $factory, CommandMediatorInterface $mediator)
    {
        $this->validator = $validator;
        $this->repository = $repository;
        $this->factory = $factory;
        $this->mediator = $mediator;
    }

    /**
     * @param PackingListGroupApiDtoInterface $dto
     *
     * @return PackingListGroupInterface
     *
     * @throws PackingListGroupInvalidException
     * @throws PackingListGroupCannotBeCreatedException
     * @throws PackingListGroupCannotBeSavedException
     */
    public function post(PackingListGroupApiDtoInterface $dto): PackingListGroupInterface
    {
        $packingList = $this->factory->create($dto);

        $this->mediator->onCreate($dto, $packingList);

        $errors = $this->validator->validate($packingList);

        if (\count($errors) > 0) {
            $errorsString = (string) $errors;

            throw new PackingListGroupInvalidException($errorsString);
        }

        $this->repository->save($packingList);

        return $packingList;
    }

    /**
     * @param PackingListGroupApiDtoInterface $dto
     *
     * @return PackingListGroupInterface
     *
     * @throws PackingListGroupInvalidException
     * @throws PackingListGroupNotFoundException
     * @throws PackingListGroupCannotBeSavedException
     */
    public function put(PackingListGroupApiDtoInterface $dto): PackingListGroupInterface
    {
        try {
            $packingList = $this->repository->find($dto->idToString());
        } catch (PackingListGroupNotFoundException $e) {
            throw $e;
        }

        $this->mediator->onUpdate($dto, $packingList);

        $errors = $this->validator->validate($packingList);

        if (\count($errors) > 0) {
            $errorsString = (string) $errors;

            throw new PackingListGroupInvalidException($errorsString);
        }

        $this->repository->save($packingList);

        return $packingList;
    }

    /**
     * @param PackingListGroupApiDtoInterface $dto
     *
     * @throws PackingListGroupCannotBeRemovedException
     * @throws PackingListGroupNotFoundException
     */
    public function delete(PackingListGroupApiDtoInterface $dto): void
    {
        try {
            $packingList = $this->repository->find($dto->idToString());
        } catch (PackingListGroupNotFoundException $e) {
            throw $e;
        }
        $this->mediator->onDelete($dto, $packingList);
        try {
            $this->repository->remove($packingList);
        } catch (PackingListGroupCannotBeRemovedException $e) {
            throw $e;
        }
    }
}
