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

namespace Evrinoma\PackingListBundle\Tests\Functional\Action;

use Evrinoma\PackingListBundle\Dto\GroupApiDto;
use Evrinoma\PackingListBundle\Dto\GroupApiDtoInterface;
use Evrinoma\PackingListBundle\Tests\Functional\Helper\BaseGroupTestTrait;
use Evrinoma\PackingListBundle\Tests\Functional\ValueObject\Group\Id;
use Evrinoma\PackingListBundle\Tests\Functional\ValueObject\Group\Info;
use Evrinoma\TestUtilsBundle\Action\AbstractServiceTest;
use Evrinoma\TestUtilsBundle\Repository\Api\ApiRepositoryHelperTestInterface;
use Evrinoma\TestUtilsBundle\Repository\Api\ApiRepositoryHelperTestTrait;
use PHPUnit\Framework\Assert;
use Symfony\Component\HttpFoundation\Response;

class BaseGroup extends AbstractServiceTest implements BaseGroupTestInterface
{
    use ApiRepositoryHelperTestTrait;
    use BaseGroupTestTrait;

    public const API_GET = 'evrinoma/api/packing_list/group/info';
    public const API_CRITERIA = 'evrinoma/api/packing_list/group/info/criteria';
    public const API_DELETE = 'evrinoma/api/packing_list/group/info/delete';
    public const API_PUT = 'evrinoma/api/packing_list/group/info/save';
    public const API_POST = 'evrinoma/api/packing_list/group/info/create';

    protected static function getDtoClass(): string
    {
        return GroupApiDto::class;
    }

    protected static function defaultData(): array
    {
        return [
            GroupApiDtoInterface::DTO_CLASS => static::getDtoClass(),
            GroupApiDtoInterface::ID => Id::default(),
            GroupApiDtoInterface::INFO => Info::default(),
        ];
    }

    public function actionPost(): void
    {
        $value = $this->createGroup();
        $this->testResponseStatusNotImplemented();
        $this->hasError($value);
    }

    public function actionDelete(): void
    {
        $value = $this->delete(Id::value());
        $this->testResponseStatusNotImplemented();
        $this->hasError($value);
    }

    public function actionGet(): void
    {
        $find = $this->assertGet(Id::value(), Response::HTTP_NOT_FOUND);
        $this->hasError($find);
    }

    public function actionGetNotFound(): void
    {
        $find = $this->assertGet(Id::value(), Response::HTTP_NOT_FOUND);
        $this->hasError($find);
    }

    public function actionDeleteNotFound(): void
    {
        $value = $this->delete(Id::wrong());
        $this->testResponseStatusNotImplemented();
        $this->hasError($value);
    }

    public function actionDeleteUnprocessable(): void
    {
        $value = $this->delete(Id::empty());
        $this->testResponseStatusNotImplemented();
        $this->hasError($value);
    }

    public function actionPutNotFound(): void
    {
        $updated = $this->put(static::getDefault([GroupApiDtoInterface::ID => Id::wrong()]));
        $this->testResponseStatusNotImplemented();
        $this->hasError($updated);
    }

    public function actionPutUnprocessable(): void
    {
        $updated = $this->put(static::getDefault([GroupApiDtoInterface::ID => Id::empty()]));
        $this->testResponseStatusNotImplemented();
        $this->hasError($updated);
    }

    public function actionPostUnprocessable(): void
    {
        $created = $this->post(static::getDefault([GroupApiDtoInterface::ID => Id::empty()]));
        $this->testResponseStatusNotImplemented();
        $this->hasError($created);
    }

    public function actionCriteriaNotFound(): void
    {
        foreach ($this->contentActionCriteriaNotFound() as $value) {
            $value[ApiRepositoryHelperTestInterface::CALL]($this->criteria($value[ApiRepositoryHelperTestInterface::QUERY]));
        }
    }

    public function actionCriteria(): void
    {
        foreach ($this->contentActionCriteria() as $value) {
            $value[ApiRepositoryHelperTestInterface::CALL]($this->criteria($value[ApiRepositoryHelperTestInterface::QUERY]));
        }
    }

    public function actionPut(): void
    {
        $updated = $this->put(static::getDefault([GroupApiDtoInterface::ID => Id::value()]));
        $this->testResponseStatusNotImplemented();
        $this->hasError($updated);
    }

    public function actionPostDuplicate(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }
}
