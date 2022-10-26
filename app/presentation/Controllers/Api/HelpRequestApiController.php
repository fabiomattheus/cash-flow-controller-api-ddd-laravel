<?php

namespace Presentation\Controllers\Api;

use App\Http\Controllers\Controller;
use Presentation\Contracts\HelpRequest\GetHelpRequestByIdInterface as GetHelpRequestById;
use Presentation\Contracts\HelpRequest\CreateHelpRequestInterface as CreateHelpRequest;


class HelpRequestApiController extends Controller
{
    protected $deleteHelpRequest;
    protected $getHelpRequestById;
    protected $createHelpRequest;
    protected $getHelpRequestByCustomerId;


    public function __construct(
        GetHelpRequestById $getHelpRequestById,
        CreateHelpRequest $createHelpRequest,
    ) {
        $this->getHelpRequestById = $getHelpRequestById;
        $this->createHelpRequest = $createHelpRequest;
    }

    public function create()
    {
        return $this->createHelpRequest->execute();
    }

    public function getById()
    {
        return $this->getHelpRequestById->execute();
    }
}
