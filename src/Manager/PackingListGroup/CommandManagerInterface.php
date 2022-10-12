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

namespace Evrinoma\PackingListBundle\Manager\PackingListGroup;

use Evrinoma\PackingListBundle\Dto\PackingListGroupApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\PackingListGroup\PackingListGroupCannotBeRemovedException;
use Evrinoma\PackingListBundle\Exception\PackingListGroup\PackingListGroupInvalidException;
use Evrinoma\PackingListBundle\Exception\PackingListGroup\PackingListGroupNotFoundException;
use Evrinoma\PackingListBundle\Model\PackingListGroup\PackingListGroupInterface;

interface CommandManagerInterface
{
    /**
     * @param PackingListGroupApiDtoInterface $dto
     *
     * @return PackingListGroupInterface
     *
     * @throws PackingListGroupInvalidException
     */
    public function post(PackingListGroupApiDtoInterface $dto): PackingListGroupInterface;

    /**
     * @param PackingListGroupApiDtoInterface $dto
     *
     * @return PackingListGroupInterface
     *
     * @throws PackingListGroupInvalidException
     * @throws PackingListGroupNotFoundException
     */
    public function put(PackingListGroupApiDtoInterface $dto): PackingListGroupInterface;

    /**
     * @param PackingListGroupApiDtoInterface $dto
     *
     * @throws PackingListGroupCannotBeRemovedException
     * @throws PackingListGroupNotFoundException
     */
    public function delete(PackingListGroupApiDtoInterface $dto): void;
}
