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
use Evrinoma\DtoCommon\ValueObject\Mutable\NumberTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\CommentTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\MeasureTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\PackingListIdTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\QuantityTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\StampTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\StateStandardTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Mutable\SubContractTrait;
use Symfony\Component\HttpFoundation\Request;

class ListItemApiDto extends AbstractDto implements ListItemApiDtoInterface
{
    use CommentTrait;
    use IdTrait;
    use MeasureTrait;
    use NumberTrait;
    use QuantityTrait;
    use StampTrait;
    use StateStandardTrait;
    use SubContractTrait;
    use PackingListIdTrait;

    public function toDto(Request $request): DtoInterface
    {
        $class = $request->get(DtoInterface::DTO_CLASS);

        if ($class === $this->getClass()) {
            $id = $request->get(ListItemApiDtoInterface::ID);
            $number = $request->get(ListItemApiDtoInterface::NUMBER);
            $stateStandard = $request->get(ListItemApiDtoInterface::STATE_STANDARD);
            $quantity = $request->get(ListItemApiDtoInterface::QUANTITY);
            $measure = $request->get(ListItemApiDtoInterface::MEASURE);
            $comment = $request->get(ListItemApiDtoInterface::COMMENT);
            $subContract = $request->get(ListItemApiDtoInterface::SUB_CONTRACT);
            $stamp = $request->get(ListItemApiDtoInterface::STAMP);
            $packingListId = $request->get(ListItemApiDtoInterface::PACKING_LIST_ID);

            if ($id) {
                $this->setId($id);
            }

            if ($number) {
                $this->setNumber($number);
            }

            if ($stateStandard) {
                $this->setStateStandard($stateStandard);
            }

            if ($quantity) {
                $this->setQuantity($quantity);
            }

            if ($measure) {
                $this->setMeasure($measure);
            }

            if ($comment) {
                $this->setComment($comment);
            }

            if ($subContract) {
                $this->setSubContract($subContract);
            }

            if ($stamp) {
                $this->setStamp($stamp);
            }

            if ($packingListId) {
                $this->setPackingListId($packingListId);
            }
        }

        return $this;
    }
}
