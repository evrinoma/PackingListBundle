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

namespace Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\PackingListBundle\Dto\UserApiDto;
use Evrinoma\PackingListBundle\Dto\UserApiDtoInterface;
use Symfony\Component\HttpFoundation\Request;

trait UserTrait
{
    /**
     * @var UserApiDtoInterface|null
     */
    protected ?UserApiDtoInterface $userApiDto = null;

    /**
     * @return \Generator
     */
    public function genRequestUserApiDto(?Request $request): ?\Generator
    {
        if ($request) {
            $user = $request->get(UserInterface::USER);
            if ($user) {
                $newRequest = $this->getCloneRequest();
                $user[DtoInterface::DTO_CLASS] = UserApiDto::class;
                $newRequest->request->add($user);

                yield $newRequest;
            }
        }
    }

    public function hasUserApiDto(): bool
    {
        return null !== $this->userApiDto;
    }

    public function getUserApiDto(): UserApiDtoInterface
    {
        return $this->userApiDto;
    }
}
