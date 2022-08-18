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

namespace Evrinoma\PackingListBundle\PreValidator\Logistics;

use Evrinoma\PackingListBundle\Dto\LogisticsApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\Logistics\LogisticsInvalidException;

interface DtoPreValidatorInterface
{
    /**
     * @param LogisticsApiDtoInterface $dto
     *
     * @throws LogisticsInvalidException
     */
    public function onPost(LogisticsApiDtoInterface $dto): void;

    /**
     * @param LogisticsApiDtoInterface $dto
     *
     * @throws LogisticsInvalidException
     */
    public function onPut(LogisticsApiDtoInterface $dto): void;

    /**
     * @param LogisticsApiDtoInterface $dto
     *
     * @throws LogisticsInvalidException
     */
    public function onDelete(LogisticsApiDtoInterface $dto): void;
}
