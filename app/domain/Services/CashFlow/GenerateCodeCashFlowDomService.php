<?php

namespace Domain\Services\CashFlow;

use Application\Services\Contracts\CashFlow\GenerateCodeCashFlowDomServiceInterface;
use Domain\Repositories\Eloquent\CashFlowEloquentRepositoryInterface as Repository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class GenerateCodeCashFlowDomService implements GenerateCodeCashFlowDomServiceInterface
{
    protected $repository;

    public function __construct(
    Repository $repository,
    ) 
    {
        $this->repository = $repository;
    }

    public function execute(): void
    {
        $request = App::make(Request::class);
        $identifier = $this->getIdentifier();
        $request->merge(['identifier' => $identifier]);
        unset($identifier);
    }

    private function getIdentifier(int $amountCharacters = 8)
    {
        $smallLetters = str_shuffle('abcdefghijklmnopqrstuvwxyz');
        $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
        $numbers .= 1234567890;
        $specialCharacters = str_shuffle('!@#$%*-');
        $characters = $smallLetters . $numbers . $specialCharacters;
        $identifier = substr(str_shuffle($characters), 0, $amountCharacters);
        $callback =  $this->repository->getByIdentifier($identifier);
        if (isset($callback)) {
            $this->getIdentifier($amountCharacters  + 1);
        }
        return $identifier;
        unset(
            $smallLetters,
            $numbers,
            $specialCharacters,
            $characters,
            $identifier,
            $callback
        );
    }
}
