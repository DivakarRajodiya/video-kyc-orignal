<?php

namespace App\Http\Controllers;

use App\DataTables\VisitorDataTable;
use App\Models\Visitor;
use App\Repositories\VisitorRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Laracasts\Flash\Flash;
use Yajra\DataTables\DataTables;

class VisitorController extends AppBaseController
{
    /** @var  VisitorRepository */
    private $visitorRepository;

    public function __construct(VisitorRepository $visitorRepository)
    {
        $this->visitorRepository = $visitorRepository;
    }

    /**
     * Display a listing of the Visitor.
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
            return DataTables::of((new VisitorDataTable())->get())->make(true);
        }

        return view('visitors.index');
    }

    /**
     * Show the form for creating a new Visitor.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('visitors.create');
    }

    /**
     * Store a newly created Visitor in storage.
     *
     * @param Request $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $visitor = $this->visitorRepository->create($input);

        Flash::success('Visitor saved successfully.');

        return redirect(route('visitors.index'));
    }


    /**
     * Display the specified Visitor.
     *
     * @param $id
     *
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function show($id)
    {
        $visitor = $this->visitorRepository->find($id);

        if (empty($visitor)) {
            Flash::error('Visitor not found');

            return redirect(route('visitors.index'));
        }

        return view('visitors.show')->with('visitor', $visitor);
    }


    /**
     * Show the form for editing the specified Visitor.
     *
     * @param $id
     *
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function edit($id)
    {
        $visitor = $this->visitorRepository->find($id);

        if (empty($visitor)) {
            Flash::error('Visitor not found');

            return redirect(route('visitors.index'));
        }

        return view('visitors.edit')->with('visitor', $visitor);
    }

    /**
     * Update the specified Visitor in storage.
     *
     * @param $id
     *
     * @param Request $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function update($id, Request $request)
    {
        $visitor = $this->visitorRepository->find($id);

        if (empty($visitor)) {
            Flash::error('Visitor not found');

            return redirect(route('visitors.index'));
        }

        $visitor = $this->visitorRepository->update($request->all(), $id);

        Flash::success('Visitor updated successfully.');

        return redirect(route('visitors.index'));
    }

    /**
     * Remove the specified Visitor from storage.
     *
     * @param $id
     *
     * @return JsonResponse
     */
    public function destroy($id)
    {
        /** @var Visitor $visitor */
        $visitor = Visitor::find($id);
        $visitor->delete();

        return $this->sendSuccess('Visitor deleted successfully.');
    }
}

