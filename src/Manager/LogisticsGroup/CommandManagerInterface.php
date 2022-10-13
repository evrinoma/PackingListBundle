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
use Evrinoma\PackingListBundle\Exception\LogisticsGroup\LogisticsGroupCannotBeRemovedException;
use Evrinoma\PackingListBundle\Exception\LogisticsGroup\LogisticsGroupInvalidException;
use Evrinoma\PackingListBundle\Exception\LogisticsGroup\LogisticsGroupNotFoundException;
use Evrinoma\PackingListBundle\Model\LogisticsGroup\LogisticsGroupInterface;

interface CommandManagerInterface
{
    /**
     * @param LogisticsGroupApiDtoInterface $dto
     *
     * @return LogisticsGroupInterface
     *
     * @throws LogisticsGroupInvalidException
     */
    public function post(LogisticsGroupApiDtoInterface $dto): LogisticsGroupInterface;

    /**
     * @param LogisticsGroupApiDtoInterface $dto
     *
     * @return LogisticsGroupInterface
     *
     * @throws LogisticsGroupInvalidException
     * @throws LogisticsGroupNotFoundException
     */
    public function put(LogisticsGroupApiDtoInterface $dto): LogisticsGroupInterface;

    /**
     * @param LogisticsGroupApiDtoInterface $dto
     *
     * @throws LogisticsGroupCannotBeRemovedException
     * @throws LogisticsGroupNotFoundException
     */
    public function delete(LogisticsGroupApiDtoInterface $dto): void;
}
