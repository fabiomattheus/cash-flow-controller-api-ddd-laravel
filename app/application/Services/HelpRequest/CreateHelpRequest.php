<?php

namespace Application\Services\HelpRequest;

use Illuminate\Http\Request;
use Domain\Repositories\HelpRequestRepositoryInterface as HelpRequestRepository;
use Domain\Entities\Contracts\HelpRequestEntityInterface as HelpRequestEntity;
use Domain\Entities\Contracts\PurchaseItemEntityInterface as PurchaseItemEntity;
use Application\Services\Contracts\TEntity\StoreFilesInterface as StoreImages;
use Application\Services\Contracts\HelpRequest\GenerateCodeInterface as GenerateCode;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Presentation\Contracts\HelpRequest\CreateHelpRequestInterface;
use Application\Services\Contracts\ChatFile\CreateChatFilePathsInterface as CreateChatFilePaths;
use Domain\Aggregates\Contracts\ChatAggregateInterface as ChatAggregate;
use Domain\Dto\Contracts\DtoInterface;
use Illuminate\Http\Response;

class CreateHelpRequest implements CreateHelpRequestInterface
{
    protected $helpRequestRepository;
    protected $helpRequestEntity;
    protected $chatAggregate;
    protected $storeImages;
    protected $generateCode;
    protected $createChatFilePaths;
    protected $dto;
    protected $purchaseItemEntity;

    public function __construct(
        HelpRequestEntity $helpRequestEntity,
        PurchaseItemEntity $purchaseItemEntity,
        HelpRequestRepository $helpRequestRepository,
        StoreImages $storeImages,
        GenerateCode $generateCode,
        ChatAggregate $chatAggregate,
        CreateChatFilePaths $createChatFilePath
    ) {
        $this->helpRequestEntity = $helpRequestEntity;
        $this->helpRequestRepository = $helpRequestRepository;
        $this->storeImages = $storeImages;
        $this->generateCode = $generateCode;
        $this->chatAggregate = $chatAggregate;
        $this->createChatFilePath = $createChatFilePath;
        $this->purchaseItemEntity = $purchaseItemEntity;
    }

    public function execute()
    {


        DB::beginTransaction();
        $request = App::make(Request::class);
        $dto = App::makeWith(DtoInterface::class);
        $callBack = $this->helpRequestRepository->createPurchaseItem($dto::fromRequest($this->purchaseItemEntity, true));
        $request->merge(['purchase_item_id' => $callBack->id]);
        $this->generateCode->execute();        
        $callBack = $this->helpRequestRepository->create($dto::fromRequest($this->helpRequestEntity));
        $request->merge(['Chat'=> array_merge($request->Chat, ['help_request_id' => $callBack->id])]);
        $callBack = $this->helpRequestRepository->createChat($dto::fromRequest($this->chatAggregate, true));
        $request->merge([
            'chat_id' => $callBack->id,
            'url' => $callBack->url,
            'entity' => 'chat',
        ]);
        $this->createChatFilePath->execute($this->storeImages->execute());
        DB::commit();
        return $dto::toJson(Response::HTTP_CREATED, 'messages.success_create_help_request');
        unset($request, $dto, $callBack);
    }
}
