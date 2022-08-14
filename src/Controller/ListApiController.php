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
use Evrinoma\PackingListBundle\Dto\PackingListApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\PackingListCannotBeSavedException;
use Evrinoma\PackingListBundle\Exception\PackingListInvalidException;
use Evrinoma\PackingListBundle\Exception\PackingListNotFoundException;
use Evrinoma\PackingListBundle\Manager\CommandManagerInterface;
use Evrinoma\PackingListBundle\Manager\QueryManagerInterface;
use Evrinoma\PackingListBundle\PreValidator\DtoPreValidatorInterface;
use Evrinoma\UtilsBundle\Controller\AbstractWrappedApiController;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializerInterface;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

final class ListApiController extends AbstractWrappedApiController
{
    private string $dtoClass;
    /**
     * @var ?Request
     */
    private ?Request $request;
    /**
     * @var QueryManagerInterface
     */
    private QueryManagerInterface $queryManager;
    /**
     * @var CommandManagerInterface
     */
    private CommandManagerInterface $commandManager;
    /**
     * @var FactoryDtoInterface
     */
    private FactoryDtoInterface $factoryDto;
    /**
     * @var DtoPreValidatorInterface
     */
    private DtoPreValidatorInterface $preValidator;

    public function __construct(SerializerInterface $serializer, RequestStack $requestStack, FactoryDtoInterface $factoryDto, CommandManagerInterface $commandManager, QueryManagerInterface $queryManager, DtoPreValidatorInterface $preValidator, string $dtoClass)
    {
        parent::__construct($serializer);
        $this->request = $requestStack->getCurrentRequest();
        $this->factoryDto = $factoryDto;
        $this->commandManager = $commandManager;
        $this->queryManager = $queryManager;
        $this->dtoClass = $dtoClass;
        $this->preValidator = $preValidator;
    }

    /**
     * @Rest\Post("/api/packing/list/create", options={"expose": true}, name="api_packing_list_create")
     * @OA\Post(
     *     tags={"packing-list"},
     *     description="the method perform create packing list",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={
     *                     "class": "Evrinoma\PackingListBundle\Dto\PackingListApiDto",
     *                     "id": "48",
     *                     "description": "Интертех",
     *                 },
     *                 type="object",
     *                 @OA\Property(property="class", type="string", default="Evrinoma\PackingListBundle\Dto\PackingListApiDto"),
     *                 @OA\Property(property="id", type="string"),
     *                 @OA\Property(property="description", type="string"),
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
        /** @var PackingListApiDtoInterface $packingListApiDto */
        $packingListApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);
        $commandManager = $this->commandManager;

        $this->setStatusCreated();

        $json = [];
        $error = [];

        try {
            $this->preValidator->onPost($packingListApiDto);

            $em = $this->getDoctrine()->getManager();

            $em->transactional(
                function () use ($packingListApiDto, $commandManager, &$json) {
                    $json[] = $commandManager->post($packingListApiDto);
                }
            );
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup('api_post_packing_list')->JsonResponse('Create packing list', $json, $error);
    }

    /**
     * @Rest\Put("/api/packing/list/save", options={"expose": true}, name="api_packing_list_save")
     * @OA\Put(
     *     tags={"packing-list"},
     *     description="the method perform save packing list for current entity",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={
     *                     "class": "Evrinoma\PackingListBundle\Dto\PackingListApiDto",
     *                     "active": "b",
     *                     "id": "48",
     *                     "description": "Интертех",
     *                 },
     *                 type="object",
     *                 @OA\Property(property="class", type="string", default="Evrinoma\PackingListBundle\Dto\PackingListApiDto"),
     *                 @OA\Property(property="id", type="string"),
     *                 @OA\Property(property="description", type="string"),
     *                 @OA\Property(property="active", type="string")
     *             )
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Save packing list")
     *
     * @return JsonResponse
     */
    public function putAction(): JsonResponse
    {
        /** @var PackingListApiDtoInterface $packingListApiDto */
        $packingListApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);
        $commandManager = $this->commandManager;

        $json = [];
        $error = [];

        try {
            $this->preValidator->onPut($packingListApiDto);

            $em = $this->getDoctrine()->getManager();

            $em->transactional(
                function () use ($packingListApiDto, $commandManager, &$json) {
                    $json[] = $commandManager->put($packingListApiDto);
                }
            );
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup('api_put_packing_list')->JsonResponse('Save packing list', $json, $error);
    }

    /**
     * @Rest\Delete("/api/packing/list/delete", options={"expose": true}, name="api_packing_list_delete")
     * @OA\Delete(
     *     tags={"packing-list"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\PackingListBundle\Dto\PackingListApiDto",
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
     * @OA\Response(response=200, description="Delete packing list")
     *
     * @return JsonResponse
     */
    public function deleteAction(): JsonResponse
    {
        /** @var PackingListApiDtoInterface $packingListApiDto */
        $packingListApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $commandManager = $this->commandManager;
        $this->setStatusAccepted();

        $json = [];
        $error = [];

        try {
            $this->preValidator->onDelete($packingListApiDto);
            $em = $this->getDoctrine()->getManager();

            $em->transactional(
                function () use ($packingListApiDto, $commandManager, &$json) {
                    $commandManager->delete($packingListApiDto);
                    $json = ['OK'];
                }
            );
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->JsonResponse('Delete packing list', $json, $error);
    }

    /**
     * @Rest\Get("/api/packing/list/criteria", options={"expose": true}, name="api_packing_list_criteria")
     * @OA\Get(
     *     tags={"packing-list"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\PackingListBundle\Dto\PackingListApiDto",
     *             readOnly=true
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="id Entity",
     *         in="query",
     *         name="id",
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="description",
     *         in="query",
     *         name="description",
     *         @OA\Schema(
     *             type="string",
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Return packing list")
     *
     * @return JsonResponse
     */
    public function criteriaAction(): JsonResponse
    {
        /** @var PackingListApiDtoInterface $packingListApiDto */
        $packingListApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $json = [];
        $error = [];

        try {
            $json = $this->queryManager->criteria($packingListApiDto);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup('api_get_packing_list')->JsonResponse('Get packing list', $json, $error);
    }

    /**
     * @Rest\Get("/api/packing/list", options={"expose": true}, name="api_packing_list")
     * @OA\Get(
     *     tags={"packing-list"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\PackingListBundle\Dto\PackingListApiDto",
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
     * @OA\Response(response=200, description="Return packing list")
     *
     * @return JsonResponse
     */
    public function getAction(): JsonResponse
    {
        /** @var PackingListApiDtoInterface $packingListApiDto */
        $packingListApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $json = [];
        $error = [];

        try {
            $json[] = $this->queryManager->get($packingListApiDto);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup('api_get_packing_list')->JsonResponse('Get packing list', $json, $error);
    }

    /**
     * @param \Exception $e
     *
     * @return array
     */
    public function setRestStatus(\Exception $e): array
    {
        switch (true) {
            case $e instanceof PackingListCannotBeSavedException:
                $this->setStatusNotImplemented();
                break;
            case $e instanceof UniqueConstraintViolationException:
                $this->setStatusConflict();
                break;
            case $e instanceof PackingListNotFoundException:
                $this->setStatusNotFound();
                break;
            case $e instanceof PackingListInvalidException:
                $this->setStatusUnprocessableEntity();
                break;
            default:
                $this->setStatusBadRequest();
        }

        return [$e->getMessage()];
    }
}
