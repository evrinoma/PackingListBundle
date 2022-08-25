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

use Evrinoma\DtoBundle\Dto\AbstractDto;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\DepartTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\PackingListIdTrait;
use Symfony\Component\HttpFoundation\Request;

class LogisticsApiDto extends AbstractDto implements LogisticsApiDtoInterface
{
    use DepartTrait;
    use PackingListIdTrait;

    public function toDto(Request $request): DtoInterface
    {
        $class = $request->get(DtoInterface::DTO_CLASS);

        if ($class === $this->getClass()) {
            $packingListId = $request->get(LogisticsApiDtoInterface::PACKING_LIST_ID);
            $depart = $request->get(LogisticsApiDtoInterface::DEPART);

            if ($packingListId) {
                $this->setPackingListId($packingListId);
            }

            if ($depart) {
                $this->setDepart($depart);
            }
        }

        return $this;
    }
}
