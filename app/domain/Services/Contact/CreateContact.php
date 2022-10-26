<?php
namespace Domain\Services\Contact;

use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\App;
use Domain\Repositories\ContactRepositoryInterface as Repository;
use Domain\Aggregates\Contracts\ContactAggregateInterface as ContactAggregate;
use Domain\Dto\Contracts\DtoInterface;
use Presentation\Contracts\Contact\CreateContactInterface;

class CreateContact implements CreateContactInterface
{
    protected $repository;
    protected $contactAggregate;

    public function __construct(
        Repository $repository,
        ContactAggregate $contactAggregate

    ) {
        $this->repository = $repository;
        $this->contactAggregate = $contactAggregate;
    }

    public function execute() : void
    {
        $dto = App::makeWith(DtoInterface::class);
        $request = App::make(Request::class);
        if ($request->filled('contacts')) {
            for ($i = 0; $i < count($request->contacts); $i++) {
               $this->repository->create($dto->fromRequest($this->contactAggregate,));
            }
        }
        $this->repository->create($dto::fromRequest($this->contactAggregate));
        unset($dto);
    }
}
