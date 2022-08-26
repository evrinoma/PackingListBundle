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
use Evrinoma\DtoBundle\Dto\AbstractDto;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\DepartTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\PackingListTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\UserTrait;
use Symfony\Component\HttpFoundation\Request;

class LogisticsApiDto extends AbstractDto implements LogisticsApiDtoInterface
{
    use DepartTrait;
    use PackingListTrait;
    use UserTrait;

    /**
     * @Dto(class="Evrinoma\PackingListBundle\Dto\PackingListApiDto", generator="genRequestPackingListApiDto")
     *
     * @var PackingListApiDtoInterface|null
     */
    protected ?PackingListApiDtoInterface $packingListApiDto = null;

    /**
     * @Dto(class="Evrinoma\PackingListBundle\Dto\DepartApiDto", generator="genRequestDepartApiDto")
     *
     * @var DepartApiDtoInterface|null
     */
    protected ?DepartApiDtoInterface $departApiDto = null;

    /**
     * @Dto(class="Evrinoma\PackingListBundle\Dto\UserApiDto", generator="genRequestUserApiDto")
     *
     * @var UserApiDtoInterface|null
     */
    protected ?UserApiDtoInterface $userApiDto = null;

    public function toDto(Request $request): DtoInterface
    {
        $class = $request->get(DtoInterface::DTO_CLASS);

        if ($class === $this->getClass()) {
        }

        return $this;
    }
}
