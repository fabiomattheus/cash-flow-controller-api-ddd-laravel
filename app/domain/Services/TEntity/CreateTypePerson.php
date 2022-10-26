<?php

namespace Domain\Services\TEntity;

use Domain\Repositories\PhysicalPersonRepositoryInterface as PhysicalPersonRepository;
use Domain\Repositories\LegalPersonRepositoryInterface as LegalPersonRepository;
use Domain\Entities\Contracts\LegalPersonEntityInterface as LegalPersonEntity;
use Domain\Entities\Contracts\PhysicalPersonEntityInterface as PhysicalPersonEntity;
use Domain\Dto\Contracts\DtoInterface as DTO;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class CreateTypePerson
{
    protected $physicalPersonEntity;
    protected $legalPersonEntity;
    protected $legalPersonRepository;
    protected $physicalPersonRepository;
    protected $dto;

    public function __construct(
        LegalPersonEntity $legalPersonEntity,
        PhysicalPersonEntity $physicalPersonEntity,
        PhysicalPersonRepository $physicalPersonRepository,
        LegalPersonRepository $legalPersonRepository,
        DTO $dto

    ) {
        $this->physicalPersonEntity = $physicalPersonEntity;
        $this->legalPersonEntity = $legalPersonEntity;
        $this->physicalPersonRepository = $physicalPersonRepository;
        $this->legalPersonRepository = $legalPersonRepository;
        $this->dto = $dto;
    }

    public function execute()
    {
        $request = App::make(Request::class);
        if ($request->has('cpf')) {
            $request->merge(['personable_type' => 'PhysicalPerson']);
            return $this->physicalPersonRepository->create($this->dto::fromRequest($this->physicalPersonEntity));
        } elseif ($request->has('cnpj')) {
            $request->merge(['personable_type' => 'LegalPerson']);
            return $this->legalPersonRepository->create($this->dto::fromRequest($this->legalPersonEntity));
        } else {
          return  abort(response()->json(['errors' => trans('messages.error_type_person_not_found')], 404));
        }
    }
}
