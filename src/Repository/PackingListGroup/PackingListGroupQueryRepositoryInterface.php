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

namespace Evrinoma\PackingListBundle\Repository\PackingListGroup;

use Doctrine\ORM\Exception\ORMException;
use Evrinoma\PackingListBundle\Dto\PackingListGroupApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\PackingListGroup\PackingListGroupNotFoundException;
use Evrinoma\PackingListBundle\Exception\PackingListGroup\PackingListGroupProxyException;
use Evrinoma\PackingListBundle\Model\PackingListGroup\PackingListGroupInterface;

interface PackingListGroupQueryRepositoryInterface
{
    /**
     * @param PackingListGroupApiDtoInterface $dto
     *
     * @return array
     *
     * @throws PackingListGroupNotFoundException
     */
    public function findByCriteria(PackingListGroupApiDtoInterface $dto): array;

    /**
     * @param string $id
     * @param null   $lockMode
     * @param null   $lockVersion
     *
     * @return PackingListGroupInterface
     *
     * @throws PackingListGroupNotFoundException
     */
    public function find(string $id, $lockMode = null, $lockVersion = null): PackingListGroupInterface;

    /**
     * @param string $id
     *
     * @return PackingListGroupInterface
     *
     * @throws PackingListGroupProxyException
     * @throws ORMException
     */
    public function proxy(string $id): PackingListGroupInterface;
}
