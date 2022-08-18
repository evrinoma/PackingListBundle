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

namespace Evrinoma\PackingListBundle\Manager\Logistics;

use Evrinoma\PackingListBundle\Dto\LogisticsApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\Logistics\LogisticsNotFoundException;
use Evrinoma\PackingListBundle\Exception\Logistics\LogisticsProxyException;
use Evrinoma\PackingListBundle\Model\Logistics\LogisticsInterface;

interface QueryManagerInterface
{
    /**
     * @param LogisticsApiDtoInterface $dto
     *
     * @return array
     *
     * @throws LogisticsNotFoundException
     */
    public function criteria(LogisticsApiDtoInterface $dto): array;

    /**
     * @param LogisticsApiDtoInterface $dto
     *
     * @return LogisticsInterface
     *
     * @throws LogisticsNotFoundException
     */
    public function get(LogisticsApiDtoInterface $dto): LogisticsInterface;

    /**
     * @param LogisticsApiDtoInterface $dto
     *
     * @return LogisticsInterface
     *
     * @throws LogisticsProxyException
     */
    public function proxy(LogisticsApiDtoInterface $dto): LogisticsInterface;
}
