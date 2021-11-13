<?php

namespace App\Http\Controllers;

use App\DataTables\VideLogDataTable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class VideoLogController extends Controller
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
            return DataTables::of((new VideLogDataTable())->get())->make(true);
        }

        return view('video-logs.index');
    }
}
