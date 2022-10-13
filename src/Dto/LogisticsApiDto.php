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

namespace Evrinoma\PackingListBundle\Dto;

use Evrinoma\DtoBundle\Annotation\Dto;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\PackingListTrait;

class LogisticsApiDto extends AbstractLogisticsApiDto implements LogisticsApiDtoInterface
{
    use PackingListTrait;

    /**
     * @Dto(class="Evrinoma\PackingListBundle\Dto\PackingListApiDto", generator="genRequestPackingListApiDto")
     *
     * @var PackingListApiDtoInterface|null
     */
    protected ?PackingListApiDtoInterface $packingListApiDto = null;
}
