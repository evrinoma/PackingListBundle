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
use Evrinoma\PackingListBundle\Exception\ListItem\ListItemNotFoundException;
use Evrinoma\PackingListBundle\Exception\ListItem\ListItemProxyException;
use Evrinoma\PackingListBundle\Model\ListItem\ListItemInterface;

interface QueryManagerInterface
{
    /**
     * @param ListItemApiDtoInterface $dto
     *
     * @return array
     *
     * @throws ListItemNotFoundException
     */
    public function criteria(ListItemApiDtoInterface $dto): array;

    /**
     * @param ListItemApiDtoInterface $dto
     *
     * @return ListItemInterface
     *
     * @throws ListItemNotFoundException
     */
    public function get(ListItemApiDtoInterface $dto): ListItemInterface;

    /**
     * @param ListItemApiDtoInterface $dto
     *
     * @return ListItemInterface
     *
     * @throws ListItemProxyException
     */
    public function proxy(ListItemApiDtoInterface $dto): ListItemInterface;
}
