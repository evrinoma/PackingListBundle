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
use Evrinoma\DtoCommon\ValueObject\Mutable\IdTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\InfoTrait;
use Symfony\Component\HttpFoundation\Request;

class GroupApiDto extends AbstractDto implements GroupApiDtoInterface
{
    use IdTrait;
    use InfoTrait;

    public function toDto(Request $request): DtoInterface
    {
        $class = $request->get(DtoInterface::DTO_CLASS);

        if ($class === $this->getClass()) {
            $id = $request->get(GroupApiDtoInterface::ID);
            $info = $request->get(GroupApiDtoInterface::INFO);

            if ($id) {
                $this->setId($id);
            }

            if ($info) {
                $this->setInfo($info);
            }
        }

        return $this;
    }
}
