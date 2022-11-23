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

use Evrinoma\PackingListBundle\Dto\PackingListApiDtoInterface;
use Evrinoma\PackingListBundle\Dto\PackingListGroupApiDto;
use Evrinoma\PackingListBundle\Dto\PackingListGroupApiDtoInterface;
use Evrinoma\PackingListBundle\Tests\Functional\Helper\BasePackingListGroupTestTrait;
use Evrinoma\PackingListBundle\Tests\Functional\ValueObject\PackingList\Id as PackingListId;
use Evrinoma\PackingListBundle\Tests\Functional\ValueObject\PackingListGroup\Id;
use Evrinoma\TestUtilsBundle\Action\AbstractServiceTest;
use Evrinoma\TestUtilsBundle\Repository\Api\ApiRepositoryHelperTestInterface;
use Evrinoma\TestUtilsBundle\Repository\Api\ApiRepositoryHelperTestTrait;
use Evrinoma\UtilsBundle\Model\Rest\PayloadModel;
use PHPUnit\Framework\Assert;
use Symfony\Component\HttpFoundation\Response;

class BasePackingListGroup extends AbstractServiceTest implements BasePackingListGroupTestInterface
{
    use ApiRepositoryHelperTestTrait;
    use BasePackingListGroupTestTrait;

    public const API_GET = 'evrinoma/api/packing_list/group';
    public const API_CRITERIA = 'evrinoma/api/packing_list/group/criteria';
    public const API_DELETE = 'evrinoma/api/packing_list/group/delete';
    public const API_PUT = 'evrinoma/api/packing_list/group/save';
    public const API_POST = 'evrinoma/api/packing_list/group/create';

    protected static function getDtoClass(): string
    {
        return PackingListGroupApiDto::class;
    }

    protected static function defaultData(): array
    {
        return [
            PackingListGroupApiDtoInterface::DTO_CLASS => static::getDtoClass(),
            PackingListGroupApiDtoInterface::ID => Id::default(),
            PackingListGroupApiDtoInterface::PACKING_LIST => [PackingListApiDtoInterface::ID => PackingListId::default()],
        ];
    }

    public function actionPost(): void
    {
        $value = $this->createPackingListGroup();
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
        $this->contentActionGet();
        $find = $this->assertGet(\Evrinoma\PackingListBundle\Tests\Functional\ValueObject\PackingList\Id::value());
        Assert::assertCount(1, $find[PayloadModel::PAYLOAD]);
        foreach ($find[PayloadModel::PAYLOAD][0] as $value) {
            $this->checkPackingListGroup($value);
        }
    }

    public function actionGetNotFound(): void
    {
        $this->exceptionActionGetNotFound();
        $find = $this->assertGet(Id::wrong(), Response::HTTP_BAD_REQUEST);
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
        $updated = $this->put(static::getDefault([PackingListGroupApiDtoInterface::ID => Id::wrong()]));
        $this->testResponseStatusNotImplemented();
        $this->hasError($updated);
    }

    public function actionPutUnprocessable(): void
    {
        $updated = $this->put(static::getDefault([PackingListGroupApiDtoInterface::ID => Id::empty()]));
        $this->testResponseStatusNotImplemented();
        $this->hasError($updated);
    }

    public function actionPostUnprocessable(): void
    {
        $created = $this->post(static::getDefault([PackingListGroupApiDtoInterface::ID => Id::empty()]));
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
        $updated = $this->put(static::getDefault([PackingListGroupApiDtoInterface::ID => Id::value()]));
        $this->testResponseStatusNotImplemented();
        $this->hasError($updated);
    }

    public function actionPostDuplicate(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }
}
