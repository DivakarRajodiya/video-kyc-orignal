<?php

namespace App\Http\Controllers;

use App\DataTables\AgentDataTable;
use App\Http\Requests\CreateAgentRequest;
use App\Http\Requests\UpdateAgentRequest;
use App\Models\User;
use App\Repositories\AgentRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Laracasts\Flash\Flash;
use Yajra\DataTables\DataTables;

class AgentController extends AppBaseController
{
    /** @var  AgentRepository */
    private $agentRepository;

    public function __construct(AgentRepository $agentRepo)
    {
        $this->agentRepository = $agentRepo;
    }

    /**
     * Display a listing of the Agent.
     *
     * @param Request $request
     *
     * @return Application|Factory|View
     *
     * @throws \Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of((new AgentDataTable())->get())->make(true);
        }

        return view('agents.index');
    }

    /**
     * Show the form for creating a new Agent.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('agents.create');
    }

    /**
     * Store a newly created Agent in storage.
     *
     * @param CreateAgentRequest $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateAgentRequest $request)
    {
        $input = $request->all();

        $agent = $this->agentRepository->create($input);

        Flash::success('Agent saved successfully.');

        return redirect(route('agents.index'));
    }


    /**
     * Display the specified Agent.
     *
     * @param $id
     *
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function show($id)
    {
        $agent = $this->agentRepository->find($id);

        if (empty($agent)) {
            Flash::error('Agent not found');

            return redirect(route('agents.index'));
        }

        return view('agents.show')->with('agent', $agent);
    }


    /**
     * Show the form for editing the specified Agent.
     *
     * @param $id
     *
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function edit($id)
    {
        $agent = $this->agentRepository->find($id);

        if (empty($agent)) {
            Flash::error('Agent not found');

            return redirect(route('agents.index'));
        }

        return view('agents.edit')->with('agent', $agent);
    }

    /**
     * Update the specified Agent in storage.
     *
     * @param $id
     *
     * @param UpdateAgentRequest $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function update($id, UpdateAgentRequest $request)
    {
        $agent = $this->agentRepository->find($id);

        if (empty($agent)) {
            Flash::error('Agent not found');

            return redirect(route('agents.index'));
        }

        $agent = $this->agentRepository->update($request->all(), $id);

        Flash::success('Agent updated successfully.');

        return redirect(route('agents.index'));
    }

    /**
     * Remove the specified Agent from storage.
     *
     * @param $id
     *
     * @return JsonResponse
     */
    public function destroy($id)
    {
        /** @var User $user */
        $user = User::find($id);
        $user->delete();

        return $this->sendSuccess('Agent deleted successfully.');
    }
}
