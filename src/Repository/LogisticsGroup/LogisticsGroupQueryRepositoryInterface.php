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

namespace Evrinoma\PackingListBundle\Repository\LogisticsGroup;

use Doctrine\ORM\Exception\ORMException;
use Evrinoma\PackingListBundle\Dto\LogisticsGroupApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\LogisticsGroup\LogisticsGroupNotFoundException;
use Evrinoma\PackingListBundle\Exception\LogisticsGroup\LogisticsGroupProxyException;
use Evrinoma\PackingListBundle\Model\LogisticsGroup\LogisticsGroupInterface;

interface LogisticsGroupQueryRepositoryInterface
{
    /**
     * @param LogisticsGroupApiDtoInterface $dto
     *
     * @return array
     *
     * @throws LogisticsGroupNotFoundException
     */
    public function findByCriteria(LogisticsGroupApiDtoInterface $dto): array;

    /**
     * @param string $id
     * @param null   $lockMode
     * @param null   $lockVersion
     *
     * @return LogisticsGroupInterface
     *
     * @throws LogisticsGroupNotFoundException
     */
    public function find(string $id, $lockMode = null, $lockVersion = null): LogisticsGroupInterface;

    /**
     * @param string $id
     *
     * @return LogisticsGroupInterface
     *
     * @throws LogisticsGroupProxyException
     * @throws ORMException
     */
    public function proxy(string $id): LogisticsGroupInterface;
}
