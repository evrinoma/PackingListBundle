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

namespace Evrinoma\PackingListBundle\Repository\PackingList;

use Doctrine\ORM\Exception\ORMException;
use Evrinoma\PackingListBundle\Dto\PackingListApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\PackingList\PackingListNotFoundException;
use Evrinoma\PackingListBundle\Exception\PackingList\PackingListProxyException;
use Evrinoma\PackingListBundle\Model\PackingList\PackingListInterface;

interface PackingListQueryRepositoryInterface
{
    /**
     * @param PackingListApiDtoInterface $dto
     *
     * @return array
     *
     * @throws PackingListNotFoundException
     */
    public function findByCriteria(PackingListApiDtoInterface $dto): array;

    /**
     * @param string $id
     * @param null   $lockMode
     * @param null   $lockVersion
     *
     * @return PackingListInterface
     *
     * @throws PackingListNotFoundException
     */
    public function find(string $id, $lockMode = null, $lockVersion = null): PackingListInterface;

    /**
     * @param string $id
     *
     * @return PackingListInterface
     *
     * @throws PackingListProxyException
     * @throws ORMException
     */
    public function proxy(string $id): PackingListInterface;
}
