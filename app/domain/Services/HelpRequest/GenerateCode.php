<?php

namespace Domain\Services\HelpRequest;

use Application\Services\Contracts\HelpRequest\GenerateCodeInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Infrastructure\Repositories\HelpRequestRepository;

class GenerateCode implements GenerateCodeInterface
{
    protected $helpRequestRepository;

    public function __construct(
        HelpRequestRepository $helpRequestRepository,
    ) {
        $this->helpRequestRepository = $helpRequestRepository;
    }

    public function execute(): void
    {
        $request = App::make(Request::class);
        $identifier = $this->GetIdentifier();
        $request->merge(['identifier' => $identifier]);
        unset($identifier);
    }

    private function GetIdentifier(int $amountCharacters = 8)
    {
        $smallLetters = str_shuffle('abcdefghijklmnopqrstuvwxyz');
        $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
        $numbers .= 1234567890;
        $specialCharacters = str_shuffle('!@#$%*-');
        $characters = $smallLetters . $numbers . $specialCharacters;
        $identifier = substr(str_shuffle($characters), 0, $amountCharacters);
        $callback =  $this->helpRequestRepository->getByIdentifier($identifier);
        if (isset($callback)) {
            $this->GetIdentifier($amountCharacters  + 1);
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
