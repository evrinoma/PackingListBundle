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

namespace Evrinoma\PackingListBundle\Repository\Logistics;

use Doctrine\ORM\Exception\ORMException;
use Evrinoma\PackingListBundle\Dto\LogisticsApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\Logistics\LogisticsNotFoundException;
use Evrinoma\PackingListBundle\Exception\Logistics\LogisticsProxyException;
use Evrinoma\PackingListBundle\Model\Logistics\LogisticsInterface;

interface LogisticsQueryRepositoryInterface
{
    /**
     * @param LogisticsApiDtoInterface $dto
     *
     * @return array
     *
     * @throws LogisticsNotFoundException
     */
    public function findByCriteria(LogisticsApiDtoInterface $dto): array;

    /**
     * @param string $id
     * @param null   $lockMode
     * @param null   $lockVersion
     *
     * @return LogisticsInterface
     *
     * @throws LogisticsNotFoundException
     */
    public function find(string $id, $lockMode = null, $lockVersion = null): LogisticsInterface;

    /**
     * @param string $id
     *
     * @return LogisticsInterface
     *
     * @throws LogisticsProxyException
     * @throws ORMException
     */
    public function proxy(string $id): LogisticsInterface;
}
