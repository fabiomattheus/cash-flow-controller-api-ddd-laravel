<?php

namespace Infrastructure\Repositories;

use Domain\Aggregates\Chat;
use Domain\Aggregates\ChatFile;
use Domain\Entities\HelpRequest;
use Domain\Entities\PurchaseItem;
use Domain\Repositories\HelpRequestRepositoryInterface;
use Infrastructure\Repositories\BaseRepository;
use Domain\VOs\Contracts\IdVoInterface as Id;

class HelpRequestRepository extends BaseRepository implements HelpRequestRepositoryInterface
{

    protected $modelClass = HelpRequest::class;


    public function createChat(Iterable $data)
    {
        $this->setModel(Chat::class);
        return $this->create($data);
    }

    public function getByIdentifier(String $identifier)
    {
        $query = $this->newQuery();

            $query->where('identifier', $identifier);

        return  $this->doQuery($query);
    }

    public function createChatFilePaths(Iterable $data)
    {
        $this->setModel(ChatFile::class);
        return $this->create($data);
    }

    public function createPurchaseItem(iterable $data)
    {
        $this->setModel(PurchaseItem::class);
        $callback = $this->create($data);
        $this->setModel(HelpRequest::class);
        return $callback;
        unset($callback);
    }

    public function getRequestsByRequesterId(int $limit, int $page, Id $id)
    {
        $query = $this->newQuery()->whereHas('requester', function ($query) use ($id) {
            $id = $id->toArray();

            $query->where('id', $id['id']);
        });

        return  $this->doQuery($query, $limit, $page, $paginate = true);
    }
}
