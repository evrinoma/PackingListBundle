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

namespace Evrinoma\PackingListBundle\Manager\Group;

use Evrinoma\PackingListBundle\Dto\GroupApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\Group\GroupCannotBeCreatedException;
use Evrinoma\PackingListBundle\Exception\Group\GroupCannotBeRemovedException;
use Evrinoma\PackingListBundle\Exception\Group\GroupCannotBeSavedException;
use Evrinoma\PackingListBundle\Exception\Group\GroupInvalidException;
use Evrinoma\PackingListBundle\Exception\Group\GroupNotFoundException;
use Evrinoma\PackingListBundle\Factory\GroupFactoryInterface;
use Evrinoma\PackingListBundle\Mediator\Group\CommandMediatorInterface;
use Evrinoma\PackingListBundle\Model\Group\GroupInterface;
use Evrinoma\PackingListBundle\Repository\Group\GroupRepositoryInterface;
use Evrinoma\UtilsBundle\Validator\ValidatorInterface;

final class CommandManager implements CommandManagerInterface
{
    private GroupRepositoryInterface $repository;
    private ValidatorInterface            $validator;
    private GroupFactoryInterface           $factory;
    private CommandMediatorInterface      $mediator;

    /**
     * @param ValidatorInterface               $validator
     * @param GroupRepositoryInterface $repository
     * @param GroupFactoryInterface           $factory
     * @param CommandMediatorInterface         $mediator
     */
    public function __construct(ValidatorInterface $validator, GroupRepositoryInterface $repository, GroupFactoryInterface $factory, CommandMediatorInterface $mediator)
    {
        $this->validator = $validator;
        $this->repository = $repository;
        $this->factory = $factory;
        $this->mediator = $mediator;
    }

    /**
     * @param GroupApiDtoInterface $dto
     *
     * @return GroupInterface
     *
     * @throws GroupInvalidException
     * @throws GroupCannotBeCreatedException
     * @throws GroupCannotBeSavedException
     */
    public function post(GroupApiDtoInterface $dto): GroupInterface
    {
        $group = $this->factory->create($dto);

        $this->mediator->onCreate($dto, $group);

        $errors = $this->validator->validate($group);

        if (\count($errors) > 0) {
            $errorsString = (string) $errors;

            throw new GroupInvalidException($errorsString);
        }

        $this->repository->save($group);

        return $group;
    }

    /**
     * @param GroupApiDtoInterface $dto
     *
     * @return GroupInterface
     *
     * @throws GroupInvalidException
     * @throws GroupNotFoundException
     * @throws GroupCannotBeSavedException
     */
    public function put(GroupApiDtoInterface $dto): GroupInterface
    {
        try {
            $group = $this->repository->find($dto->getId());
        } catch (GroupNotFoundException $e) {
            throw $e;
        }

        $this->mediator->onUpdate($dto, $group);

        $errors = $this->validator->validate($group);

        if (\count($errors) > 0) {
            $errorsString = (string) $errors;

            throw new GroupInvalidException($errorsString);
        }

        $this->repository->save($group);

        return $group;
    }

    /**
     * @param GroupApiDtoInterface $dto
     *
     * @throws GroupCannotBeRemovedException
     * @throws GroupNotFoundException
     */
    public function delete(GroupApiDtoInterface $dto): void
    {
        try {
            $group = $this->repository->find($dto->getId());
        } catch (GroupNotFoundException $e) {
            throw $e;
        }
        $this->mediator->onDelete($dto, $group);
        try {
            $this->repository->remove($group);
        } catch (GroupCannotBeRemovedException $e) {
            throw $e;
        }
    }
}
