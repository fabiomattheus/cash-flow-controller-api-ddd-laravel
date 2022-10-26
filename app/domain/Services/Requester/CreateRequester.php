<?php

namespace Domain\Services\Requester;

use Domain\Dto\Contracts\DtoInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Presentation\Contracts\Requester\CreateRequesterInterface;
use Presentation\Contracts\TypePerson\TypePersonInterface as TypePerson;
use Presentation\Contracts\Contact\CreateContactInterface as Contact;
use Domain\Repositories\RequesterRepositoryInterface as Repository;
use Domain\Entities\Contracts\RequesterEntityInterface as RequesterEntity;
use Domain\Services\Contracts\TEntity\GetRequesterByIdInterface as GetRequesterById;

class CreateRequester implements CreateRequesterInterface
{
    protected $contact;
    protected $typePerson;
    protected $repository;
    protected $requesterEntity;
    protected $getRequesterById;

    public function __construct(
        Contact $contact,
        TypePerson $typePerson,
        Repository $repository,
        RequesterEntity $requesterEntity,
        GetRequesterById $getRequesterById
    ) {
        $this->contact = $contact;
        $this->typePerson = $typePerson;
        $this->repository = $repository;
        $this->requesterEntity = $requesterEntity;
        $this->getRequesterById = $getRequesterById;
    }

    public function execute(): void
    {
        DB::beginTransaction();
        App::make(Request::class);
        $callback = $this->getRequesterById->execute();
        if (!isset($callback)) {
            $this->typePerson->execute();
            $this->repository->create(App::makeWith(DtoInterface::class)::fromRequest($this->requesterEntity));
            $this->contact->execute();
        }
        DB::commit();
    }
}
