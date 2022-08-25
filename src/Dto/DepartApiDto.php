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
use Evrinoma\DtoCommon\ValueObject\Mutable\IdTrait;
use Evrinoma\DtoCommon\ValueObject\Mutable\NameTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\AddressTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\DepartTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\FinalTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\PackingListTrait;
use Symfony\Component\HttpFoundation\Request;

class DepartApiDto extends AbstractDto implements DepartApiDtoInterface
{
    use AddressTrait;
    use DepartTrait;
    use IdTrait;
    use FinalTrait;
    use NameTrait;
    use PackingListTrait;

    /**
     * @Dto(class="Evrinoma\PackingListBundle\Dto\PackingListApiDto", generator="genRequestPackingListApiDto")
     * @var PackingListApiDtoInterface|null
     */
    protected ?PackingListApiDtoInterface $packingListApiDto= null;

    public function toDto(Request $request): DtoInterface
    {
        $class = $request->get(DtoInterface::DTO_CLASS);

        if ($class === $this->getClass()) {
            $id = $request->get(DepartApiDtoInterface::ID);

            $address = $request->get(DepartApiDtoInterface::ADDRESS);
            $depart = $request->get(DepartApiDtoInterface::DEPART);
            $final = $request->get(DepartApiDtoInterface::FINAL);
            $name = $request->get(DepartApiDtoInterface::NAME);

            if ($address) {
                $this->setAddress($address);
            }

            if ($depart) {
                $this->setDepart($depart);
            }

            if ($name) {
                $this->setName($name);
            }

            if ($final) {
                if ('true' === $final) {
                    $this->setFinal();
                } else {
                    $this->resetFinal();
                }
            }

            if ($id) {
                $this->setId($id);
            }
        }

        return $this;
    }
}
