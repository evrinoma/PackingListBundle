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
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\GroupTrait;

class LogisticsGroupApiDto extends AbstractLogisticsApiDto implements LogisticsGroupApiDtoInterface
{
    use GroupTrait;

    /**
     * @Dto(class="Evrinoma\PackingListBundle\Dto\GroupApiDto", generator="genRequestGroupApiDto")
     *
     * @var GroupApiDtoInterface|null
     */
    protected ?GroupApiDtoInterface $groupApiDto = null;
}
