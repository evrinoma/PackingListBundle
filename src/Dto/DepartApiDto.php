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
use Evrinoma\DtoCommon\ValueObject\Mutable\NameTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\AddressTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\IdDepartTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\IsFinalTrait;
use Symfony\Component\HttpFoundation\Request;

class DepartApiDto extends AbstractDto implements DepartApiDtoInterface
{
    use AddressTrait;
    use IdDepartTrait;
    use IdTrait;
    use IsFinalTrait;
    use NameTrait;

    public function toDto(Request $request): DtoInterface
    {
        $class = $request->get(DtoInterface::DTO_CLASS);

        if ($class === $this->getClass()) {
            $id = $request->get(DepartApiDtoInterface::ID);

            $address = $request->get(DepartApiDtoInterface::ADDRESS);
            $idDepart = $request->get(DepartApiDtoInterface::ID_DEPART);
            $isFinal = $request->get(DepartApiDtoInterface::IS_FINAL);
            $name = $request->get(DepartApiDtoInterface::NAME);

            if ($address) {
                $this->setAddress($address);
            }

            if ($idDepart) {
                $this->setIdDepart($idDepart);
            }

            if ($name) {
                $this->setName($name);
            }

            if ($isFinal) {
                if ('true' === $isFinal) {
                    $this->setIsFinal();
                } else {
                    $this->resetIsFinal();
                }
            }

            if ($id) {
                $this->setId($id);
            }
        }

        return $this;
    }
}
