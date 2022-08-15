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
use Evrinoma\PackingListBundle\Exception\ListItem\ListItemCannotBeRemovedException;
use Evrinoma\PackingListBundle\Exception\ListItem\ListItemInvalidException;
use Evrinoma\PackingListBundle\Exception\ListItem\ListItemNotFoundException;
use Evrinoma\PackingListBundle\Model\ListItem\ListItemInterface;

interface CommandManagerInterface
{
    /**
     * @param ListItemApiDtoInterface $dto
     *
     * @return ListItemInterface
     *
     * @throws ListItemInvalidException
     */
    public function post(ListItemApiDtoInterface $dto): ListItemInterface;

    /**
     * @param ListItemApiDtoInterface $dto
     *
     * @return ListItemInterface
     *
     * @throws ListItemInvalidException
     * @throws ListItemNotFoundException
     */
    public function put(ListItemApiDtoInterface $dto): ListItemInterface;

    /**
     * @param ListItemApiDtoInterface $dto
     *
     * @throws ListItemCannotBeRemovedException
     * @throws ListItemNotFoundException
     */
    public function delete(ListItemApiDtoInterface $dto): void;
}
