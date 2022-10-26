<?php

namespace Presentation\Controllers\Api;

use App\Http\Controllers\Controller;
use Presentation\Contracts\Help\DeleteHelpInterface  as DeleteHelp;
use Presentation\Contracts\Help\GetAllHelpsInterface as GetAllHelps;
use Presentation\Contracts\Help\GetHelpByIdInterface as GetHelpById;
use Presentation\Contracts\Help\GetHelpsByTypeInterface as GetHelpsByType;
use Presentation\Contracts\Help\UpdateHelpInterface as UpdateHelp;
use Presentation\Contracts\Help\CreateHelpInterface as CreateHelp;

class HelpApiController extends Controller
{
    protected $getAllHelps;
    protected $getHelpById;
    protected $getHelpsByType;
    protected $updateHelp;
    protected $createHelp;
    protected $deleteHelp;

    public function __construct(
        DeleteHelp $deleteHelp,
        GetAllHelps $getAllHelps,
        GetHelpById $getHelpById,
        GetHelpsByType $getHelpsByType,
        UpdateHelp  $updateHelp,
        CreateHelp $createHelp
    ) {
        $this->deleteHelp = $deleteHelp;
        $this->getAllHelps = $getAllHelps;
        $this->getHelpById = $getHelpById;
        $this->getHelpsByType = $getHelpsByType;
        $this->updateHelp = $updateHelp;
        $this->createHelp = $createHelp;
    }

    public function getAll()
    {
        return $this->getAllHelps->execute();
    }

    public function create()
    {
        return $this->createHelp->execute();
    }

    public function getById()
    {
        return $this->getHelpById->execute();
    }

    public function getByType()
    {
        return $this->getHelpsByType->execute();
    }

    public function update()
    {
        return $this->updateHelp->execute();
    }

    public function destroy()
    {
        return $this->deleteHelp->execute();
    }
}
