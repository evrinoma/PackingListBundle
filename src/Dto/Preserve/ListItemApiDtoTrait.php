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

namespace Evrinoma\PackingListBundle\Dto\Preserve;

use Evrinoma\DtoCommon\ValueObject\Preserve\NumberTrait;
use Evrinoma\DtoCommon\ValueObject\Preserve\IdTrait;
use Evrinoma\DtoCommon\ValueObject\Preserve\NameTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Preserve\CommentTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Preserve\MeasureTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Preserve\PackingListTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Preserve\QuantityTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Preserve\StampTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Preserve\StateStandardTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Preserve\SubContractTrait;

trait ListItemApiDtoTrait
{
    use CommentTrait;
    use IdTrait;
    use NameTrait;
    use MeasureTrait;
    use NumberTrait;
    use QuantityTrait;
    use StampTrait;
    use StateStandardTrait;
    use SubContractTrait;
    use PackingListTrait;
}
