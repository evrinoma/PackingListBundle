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

namespace Evrinoma\PackingListBundle\PreValidator\PackingList;

use Evrinoma\PackingListBundle\Dto\PackingListApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\PackingList\PackingListInvalidException;

interface DtoPreValidatorInterface
{
    /**
     * @param PackingListApiDtoInterface $dto
     *
     * @throws PackingListInvalidException
     */
    public function onPost(PackingListApiDtoInterface $dto): void;

    /**
     * @param PackingListApiDtoInterface $dto
     *
     * @throws PackingListInvalidException
     */
    public function onPut(PackingListApiDtoInterface $dto): void;

    /**
     * @param PackingListApiDtoInterface $dto
     *
     * @throws PackingListInvalidException
     */
    public function onDelete(PackingListApiDtoInterface $dto): void;
}
