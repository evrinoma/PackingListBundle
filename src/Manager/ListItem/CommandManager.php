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

namespace Evrinoma\PackingListBundle\Manager\ListItem;

use Evrinoma\PackingListBundle\Dto\ListItemApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\ListItem\ListItemCannotBeCreatedException;
use Evrinoma\PackingListBundle\Exception\ListItem\ListItemCannotBeRemovedException;
use Evrinoma\PackingListBundle\Exception\ListItem\ListItemCannotBeSavedException;
use Evrinoma\PackingListBundle\Exception\ListItem\ListItemInvalidException;
use Evrinoma\PackingListBundle\Exception\ListItem\ListItemNotFoundException;
use Evrinoma\PackingListBundle\Factory\ListItemFactoryInterface;
use Evrinoma\PackingListBundle\Mediator\ListItem\CommandMediatorInterface;
use Evrinoma\PackingListBundle\Model\ListItem\ListItemInterface;
use Evrinoma\PackingListBundle\Repository\ListItem\ListItemCommandRepositoryInterface;
use Evrinoma\UtilsBundle\Validator\ValidatorInterface;

final class CommandManager implements CommandManagerInterface
{
    private ListItemCommandRepositoryInterface $repository;
    private ValidatorInterface            $validator;
    private ListItemFactoryInterface           $factory;
    private CommandMediatorInterface      $mediator;

    /**
     * @param ValidatorInterface                 $validator
     * @param ListItemCommandRepositoryInterface $repository
     * @param ListItemFactoryInterface           $factory
     * @param CommandMediatorInterface           $mediator
     */
    public function __construct(ValidatorInterface $validator, ListItemCommandRepositoryInterface $repository, ListItemFactoryInterface $factory, CommandMediatorInterface $mediator)
    {
        $this->validator = $validator;
        $this->repository = $repository;
        $this->factory = $factory;
        $this->mediator = $mediator;
    }

    /**
     * @param ListItemApiDtoInterface $dto
     *
     * @return ListItemInterface
     *
     * @throws ListItemInvalidException
     * @throws ListItemCannotBeCreatedException
     * @throws ListItemCannotBeSavedException
     */
    public function post(ListItemApiDtoInterface $dto): ListItemInterface
    {
        $packingList = $this->factory->create($dto);

        $this->mediator->onCreate($dto, $packingList);

        $errors = $this->validator->validate($packingList);

        if (\count($errors) > 0) {
            $errorsString = (string) $errors;

            throw new ListItemInvalidException($errorsString);
        }

        $this->repository->save($packingList);

        return $packingList;
    }

    /**
     * @param ListItemApiDtoInterface $dto
     *
     * @return ListItemInterface
     *
     * @throws ListItemInvalidException
     * @throws ListItemNotFoundException
     * @throws ListItemCannotBeSavedException
     */
    public function put(ListItemApiDtoInterface $dto): ListItemInterface
    {
        try {
            $packingList = $this->repository->find($dto->getId());
        } catch (ListItemNotFoundException $e) {
            throw $e;
        }

        $this->mediator->onUpdate($dto, $packingList);

        $errors = $this->validator->validate($packingList);

        if (\count($errors) > 0) {
            $errorsString = (string) $errors;

            throw new ListItemInvalidException($errorsString);
        }

        $this->repository->save($packingList);

        return $packingList;
    }

    /**
     * @param ListItemApiDtoInterface $dto
     *
     * @throws ListItemCannotBeRemovedException
     * @throws ListItemNotFoundException
     */
    public function delete(ListItemApiDtoInterface $dto): void
    {
        try {
            $packingList = $this->repository->find($dto->getId());
        } catch (ListItemNotFoundException $e) {
            throw $e;
        }
        $this->mediator->onDelete($dto, $packingList);
        try {
            $this->repository->remove($packingList);
        } catch (ListItemCannotBeRemovedException $e) {
            throw $e;
        }
    }
}
