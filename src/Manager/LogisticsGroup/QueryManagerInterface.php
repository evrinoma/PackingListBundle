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

namespace Evrinoma\PackingListBundle\Manager\LogisticsGroup;

use Evrinoma\PackingListBundle\Dto\LogisticsGroupApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\LogisticsGroup\LogisticsGroupNotFoundException;
use Evrinoma\PackingListBundle\Exception\LogisticsGroup\LogisticsGroupProxyException;
use Evrinoma\PackingListBundle\Model\LogisticsGroup\LogisticsGroupInterface;

interface QueryManagerInterface
{
    /**
     * @param LogisticsGroupApiDtoInterface $dto
     *
     * @return array
     *
     * @throws LogisticsGroupNotFoundException
     */
    public function criteria(LogisticsGroupApiDtoInterface $dto): array;

    /**
     * @param LogisticsGroupApiDtoInterface $dto
     *
     * @return LogisticsGroupInterface
     *
     * @throws LogisticsGroupNotFoundException
     */
    public function get(LogisticsGroupApiDtoInterface $dto): LogisticsGroupInterface;

    /**
     * @param LogisticsGroupApiDtoInterface $dto
     *
     * @return LogisticsGroupInterface
     *
     * @throws LogisticsGroupProxyException
     */
    public function proxy(LogisticsGroupApiDtoInterface $dto): LogisticsGroupInterface;
}
