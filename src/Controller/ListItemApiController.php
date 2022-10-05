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

namespace Evrinoma\PackingListBundle\Controller;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Evrinoma\DtoBundle\Factory\FactoryDtoInterface;
use Evrinoma\PackingListBundle\Dto\ListItemApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\ListItem\ListItemCannotBeCreatedException;
use Evrinoma\PackingListBundle\Exception\ListItem\ListItemCannotBeRemovedException;
use Evrinoma\PackingListBundle\Exception\ListItem\ListItemCannotBeSavedException;
use Evrinoma\PackingListBundle\Exception\ListItem\ListItemInvalidException;
use Evrinoma\PackingListBundle\Exception\ListItem\ListItemNotFoundException;
use Evrinoma\PackingListBundle\Facade\ListItem\FacadeInterface;
use Evrinoma\PackingListBundle\Serializer\GroupInterface;
use Evrinoma\UtilsBundle\Controller\AbstractWrappedApiController;
use Evrinoma\UtilsBundle\Controller\ApiControllerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializerInterface;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

final class ListItemApiController extends AbstractWrappedApiController implements ApiControllerInterface
{
    private string $dtoClass;

    private ?Request $request;

    private FactoryDtoInterface $factoryDto;

    private FacadeInterface $facade;

    public function __construct(
        SerializerInterface $serializer,
        RequestStack $requestStack,
        FactoryDtoInterface $factoryDto,
        FacadeInterface $facade,
        string $dtoClass
    ) {
        parent::__construct($serializer);
        $this->request = $requestStack->getCurrentRequest();
        $this->factoryDto = $factoryDto;
        $this->dtoClass = $dtoClass;
        $this->facade = $facade;
    }

    /**
     * @Rest\Post("/api/packing_list/list_item/create", options={"expose": true}, name="api_packing_list_list_item_create")
     * @OA\Post(
     *     tags={"packing-list"},
     *     description="the method perform create list item",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={
     *                     "class": "Evrinoma\PackingListBundle\Dto\ListItemApiDto",
     *                 },
     *                 type="object",
     *                 @OA\Property(property="class", type="string", default="Evrinoma\PackingListBundle\Dto\ListItemApiDto"),
     *             )
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Create packing list")
     *
     * @return JsonResponse
     */
    public function postAction(): JsonResponse
    {
        $listItemApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $this->setStatusCreated();

        $json = [];
        $error = [];
        $group = GroupInterface::API_POST_LIST_ITEM;

        try {
            $this->facade->post($listItemApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Create list item', $json, $error);
    }

    /**
     * @Rest\Put("/api/packing_list/list_item/save", options={"expose": true}, name="api_packing_list_list_item_save")
     * @OA\Put(
     *     tags={"packing-list"},
     *     description="the method perform save list item for current entity",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={
     *                     "class": "Evrinoma\PackingListBundle\Dto\ListItemApiDto",
     *                 },
     *                 type="object",
     *                 @OA\Property(property="class", type="string", default="Evrinoma\PackingListBundle\Dto\ListItemApiDto"),
     *             )
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Save list item")
     *
     * @return JsonResponse
     */
    public function putAction(): JsonResponse
    {
        $listItemApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $json = [];
        $error = [];
        $group = GroupInterface::API_PUT_LIST_ITEM;

        try {
            $this->facade->put($listItemApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Save list item', $json, $error);
    }

    /**
     * @Rest\Delete("/api/packing_list/list_item/delete", options={"expose": true}, name="api_packing_list_list_item_delete")
     * @OA\Delete(
     *     tags={"packing-list"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\PackingListBundle\Dto\ListItemApiDto",
     *             readOnly=true
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="id Entity",
     *         in="query",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="3",
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Delete list item")
     *
     * @return JsonResponse
     */
    public function deleteAction(): JsonResponse
    {
        $listItemApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $this->setStatusAccepted();

        $json = [];
        $error = [];

        try {
            $this->facade->delete($listItemApiDto, '', $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->JsonResponse('Delete list item', $json, $error);
    }

    /**
     * @Rest\Get("/api/packing_list/list_item/criteria", options={"expose": true}, name="api_packing_list_list_item_criteria")
     * @OA\Get(
     *     tags={"packing-list"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\PackingListBundle\Dto\ListItemApiDto",
     *             readOnly=true
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="Id Entity Packing List",
     *         in="query",
     *         name="packing_list[id]",
     *         @OA\Schema(
     *             type="string",
     *             default="1021",
     *         )
     *     ),
     * )
     * @OA\Response(response=200, description="Return list items")
     *
     * @return JsonResponse
     */
    public function criteriaAction(): JsonResponse
    {
        /** @var ListItemApiDtoInterface $listItemApiDto */
        $listItemApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $json = [];
        $error = [];
        $group = GroupInterface::API_CRITERIA_LIST_ITEM;

        try {
            $this->facade->criteria($listItemApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Get list item', $json, $error);
    }

    /**
     * @Rest\Get("/api/packing_list/list_item", options={"expose": true}, name="api_packing_list_list_item")
     * @OA\Get(
     *     tags={"packing-list"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\PackingListBundle\Dto\ListItemApiDto",
     *             readOnly=true
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="id Entity",
     *         in="query",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="3807",
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Return list item")
     *
     * @return JsonResponse
     */
    public function getAction(): JsonResponse
    {
        /** @var ListItemApiDtoInterface $listItemApiDto */
        $listItemApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $json = [];
        $error = [];
        $group = GroupInterface::API_GET_LIST_ITEM;

        try {
            $this->facade->get($listItemApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Get list item', $json, $error);
    }

    /**
     * @param \Exception $e
     *
     * @return array
     */
    public function setRestStatus(\Exception $e): array
    {
        switch (true) {
            case $e instanceof ListItemCannotBeCreatedException:
            case $e instanceof ListItemCannotBeRemovedException:
            case $e instanceof ListItemCannotBeSavedException:
                $this->setStatusNotImplemented();
                break;
            case $e instanceof UniqueConstraintViolationException:
                $this->setStatusConflict();
                break;
            case $e instanceof ListItemNotFoundException:
                $this->setStatusNotFound();
                break;
            case $e instanceof ListItemInvalidException:
                $this->setStatusUnprocessableEntity();
                break;
            default:
                $this->setStatusBadRequest();
        }

        return [$e->getMessage()];
    }
}
