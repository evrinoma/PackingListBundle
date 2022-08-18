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

use Evrinoma\DtoCommon\ValueObject\Preserve\IdTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Preserve\ContractDescriptionTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Preserve\ContractorNameTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Preserve\ContractTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Preserve\ItemsApiDtoTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Preserve\LabelTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Preserve\ProjectNameTrait;
use Evrinoma\PackingListBundle\DtoCommon\ValueObject\Preserve\SubContractTrait;

trait PackingListApiDtoTrait
{
    use ContractDescriptionTrait;
    use ContractorNameTrait;
    use ContractTrait;
    use IdTrait;
    use LabelTrait;
    use ProjectNameTrait;
    use SubContractTrait;
    use ItemsApiDtoTrait;
}
