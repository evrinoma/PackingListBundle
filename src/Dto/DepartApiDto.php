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
use Evrinoma\DtoCommon\ValueObject\Mutable\TypeTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\AddressTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\FinalTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\GroupTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\PackingListTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\PointTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\WarehouseTrait;
use Symfony\Component\HttpFoundation\Request;

class DepartApiDto extends AbstractDto implements DepartApiDtoInterface
{
    use AddressTrait;
    use FinalTrait;
    use GroupTrait;
    use IdTrait;
    use NameTrait;
    use PackingListTrait;
    use PointTrait;
    use TypeTrait;
    use WarehouseTrait;

    /**
     * @Dto(class="Evrinoma\PackingListBundle\Dto\GroupApiDto", generator="genRequestGroupApiDto")
     *
     * @var GroupApiDtoInterface|null
     */
    protected ?GroupApiDtoInterface $groupApiDto = null;

    /**
     * @Dto(class="Evrinoma\PackingListBundle\Dto\PackingListApiDto", generator="genRequestPackingListApiDto")
     *
     * @var PackingListApiDtoInterface|null
     */
    protected ?PackingListApiDtoInterface $packingListApiDto = null;

    public function toDto(Request $request): DtoInterface
    {
        $class = $request->get(DtoInterface::DTO_CLASS);

        if ($class === $this->getClass()) {
            $id = $request->get(DepartApiDtoInterface::ID);
            $warehouse = $request->get(DepartApiDtoInterface::WAREHOUSE);
            $point = $request->get(DepartApiDtoInterface::POINT);
            $address = $request->get(DepartApiDtoInterface::ADDRESS);
            $final = $request->get(DepartApiDtoInterface::FINAL);
            $name = $request->get(DepartApiDtoInterface::NAME);
            $type = $request->get(DepartApiDtoInterface::TYPE);

            if ($address) {
                $this->setAddress($address);
            }

            if ($name) {
                $this->setName($name);
            }

            if ($point) {
                $this->setPoint($point);
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

            if ($type) {
                $this->setType($type);
            }

            if ($warehouse) {
                $this->setWarehouse($warehouse);
            }
        }

        return $this;
    }
}
