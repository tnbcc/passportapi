<?php

namespace App\Http\Controllers\Admin;

use App\Services\ActionLogsService;

class ActionLogsController extends BaseController
{
    protected $actionLogsService;

    /**
     * ActionLogsController constructor.
     * @param $actionLogsService
     */
    public function __construct(ActionLogsService $actionLogsService)
    {
        $this->actionLogsService = $actionLogsService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $actions = $this->actionLogsService->getActionLogs();

        return $this->view(null,compact('actions'));
    }
}
