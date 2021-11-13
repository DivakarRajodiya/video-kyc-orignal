<?php

namespace App\Http\Controllers;

use App\DataTables\RecordingDataTable;
use App\Models\Recording;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Laracasts\Flash\Flash;
use Yajra\DataTables\DataTables;

class RecordingController extends AppBaseController
{
    /**
     * Display a listing of the Recording.
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
            return DataTables::of((new RecordingDataTable())->get())->make(true);
        }

        return view('recordings.index');
    }

    /**
     * Remove the specified Recording from storage.
     *
     * @param Recording $recording
     *
     * @return JsonResponse
     */
    public function destroy(Recording $recording)
    {
        $recording->delete();

        return $this->sendSuccess('Recording deleted successfully.');
    }
}
