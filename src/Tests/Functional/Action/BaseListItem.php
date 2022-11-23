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

use Evrinoma\PackingListBundle\Dto\ListItemApiDto;
use Evrinoma\PackingListBundle\Dto\ListItemApiDtoInterface;
use Evrinoma\PackingListBundle\Dto\PackingListApiDtoInterface;
use Evrinoma\PackingListBundle\Tests\Functional\Helper\BaseListItemTestTrait;
use Evrinoma\PackingListBundle\Tests\Functional\ValueObject\ListItem\Id;
use Evrinoma\PackingListBundle\Tests\Functional\ValueObject\PackingList\Id as PackingListId;
use Evrinoma\TestUtilsBundle\Action\AbstractServiceTest;
use Evrinoma\TestUtilsBundle\Repository\Api\ApiRepositoryHelperTestInterface;
use Evrinoma\TestUtilsBundle\Repository\Api\ApiRepositoryHelperTestTrait;
use Evrinoma\UtilsBundle\Model\Rest\PayloadModel;
use PHPUnit\Framework\Assert;
use Symfony\Component\HttpFoundation\Response;

class BaseListItem extends AbstractServiceTest implements BaseListItemTestInterface
{
    use ApiRepositoryHelperTestTrait;
    use BaseListItemTestTrait;

    public const API_GET = 'evrinoma/api/packing_list/list_item';
    public const API_CRITERIA = 'evrinoma/api/packing_list/list_item/criteria';
    public const API_DELETE = 'evrinoma/api/packing_list/list_item/delete';
    public const API_PUT = 'evrinoma/api/packing_list/list_item/save';
    public const API_POST = 'evrinoma/api/packing_list/list_item/create';

    protected static function getDtoClass(): string
    {
        return ListItemApiDto::class;
    }

    protected static function defaultData(): array
    {
        return [
            ListItemApiDtoInterface::DTO_CLASS => static::getDtoClass(),
            ListItemApiDtoInterface::ID => Id::default(),
            ListItemApiDtoInterface::PACKING_LIST => [PackingListApiDtoInterface::ID => PackingListId::value()],
        ];
    }

    public function actionPost(): void
    {
        $value = $this->createListItem();
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
        $find = $this->assertGet(Id::value());
        Assert::assertCount(1, $find[PayloadModel::PAYLOAD]);
        $this->checkListItem($find[PayloadModel::PAYLOAD][0]);
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
        $updated = $this->put(static::getDefault([ListItemApiDtoInterface::ID => Id::wrong()]));
        $this->testResponseStatusNotImplemented();
        $this->hasError($updated);
    }

    public function actionPutUnprocessable(): void
    {
        $updated = $this->put(static::getDefault([ListItemApiDtoInterface::ID => Id::empty()]));
        $this->testResponseStatusNotImplemented();
        $this->hasError($updated);
    }

    public function actionPostUnprocessable(): void
    {
        $created = $this->post(static::getDefault([ListItemApiDtoInterface::ID => Id::empty()]));
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
        $updated = $this->put(static::getDefault([ListItemApiDtoInterface::ID => Id::value()]));
        $this->testResponseStatusNotImplemented();
        $this->hasError($updated);
    }

    public function actionPostDuplicate(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }
}
