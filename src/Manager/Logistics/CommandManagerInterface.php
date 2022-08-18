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
use Evrinoma\PackingListBundle\Exception\Logistics\LogisticsCannotBeRemovedException;
use Evrinoma\PackingListBundle\Exception\Logistics\LogisticsInvalidException;
use Evrinoma\PackingListBundle\Exception\Logistics\LogisticsNotFoundException;
use Evrinoma\PackingListBundle\Model\Logistics\LogisticsInterface;

interface CommandManagerInterface
{
    /**
     * @param LogisticsApiDtoInterface $dto
     *
     * @return LogisticsInterface
     *
     * @throws LogisticsInvalidException
     */
    public function post(LogisticsApiDtoInterface $dto): LogisticsInterface;

    /**
     * @param LogisticsApiDtoInterface $dto
     *
     * @return LogisticsInterface
     *
     * @throws LogisticsInvalidException
     * @throws LogisticsNotFoundException
     */
    public function put(LogisticsApiDtoInterface $dto): LogisticsInterface;

    /**
     * @param LogisticsApiDtoInterface $dto
     *
     * @throws LogisticsCannotBeRemovedException
     * @throws LogisticsNotFoundException
     */
    public function delete(LogisticsApiDtoInterface $dto): void;
}
