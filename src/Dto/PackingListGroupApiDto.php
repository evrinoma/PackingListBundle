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
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\CommentTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\ConsigneeTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\ContractDescriptionTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\ContractorNameTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\ContractTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\CurrentDeptTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\DateTTNTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\DimensionsTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\FormFactorTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\LabelTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\LinkFileTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\PackingListTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\ProjectNameTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\SubContractTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\WeightTrait;
use Symfony\Component\HttpFoundation\Request;

class PackingListGroupApiDto extends AbstractDto implements PackingListGroupApiDtoInterface
{
    use IdTrait;
    use PackingListTrait;

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
            $id = $request->get(PackingListApiDtoInterface::ID);

            if ($id) {
                $this->setId($id);
            }
        }

        return $this;
    }
}
