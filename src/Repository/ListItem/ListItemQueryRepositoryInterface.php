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

namespace Evrinoma\PackingListBundle\Repository\ListItem;

use Doctrine\ORM\Exception\ORMException;
use Evrinoma\PackingListBundle\Dto\ListItemApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\ListItem\ListItemNotFoundException;
use Evrinoma\PackingListBundle\Exception\ListItem\ListItemProxyException;
use Evrinoma\PackingListBundle\Model\ListItem\ListItemInterface;

interface ListItemQueryRepositoryInterface
{
    /**
     * @param ListItemApiDtoInterface $dto
     *
     * @return array
     *
     * @throws ListItemNotFoundException
     */
    public function findByCriteria(ListItemApiDtoInterface $dto): array;

    /**
     * @param string $id
     * @param null   $lockMode
     * @param null   $lockVersion
     *
     * @return ListItemInterface
     *
     * @throws ListItemNotFoundException
     */
    public function find(string $id, $lockMode = null, $lockVersion = null): ListItemInterface;

    /**
     * @param string $id
     *
     * @return ListItemInterface
     *
     * @throws ListItemProxyException
     * @throws ORMException
     */
    public function proxy(string $id): ListItemInterface;
}
