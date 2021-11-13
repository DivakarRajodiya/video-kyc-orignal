<?php

namespace App\Http\Controllers;

use App\DataTables\ChatDataTable;
use App\Models\Chat;
use App\Repositories\ChatRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Laracasts\Flash\Flash;
use Yajra\DataTables\DataTables;

class ChatController extends AppBaseController
{
    /** @var  ChatRepository */
    private $chatRepository;

    public function __construct(ChatRepository $chatRepository)
    {
        $this->chatRepository = $chatRepository;
    }

    /**
     * Display a listing of the Chat.
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
            return DataTables::of((new ChatDataTable())->get())->make(true);
        }

        return view('chats.index');
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getMessages(Request $request)
    {
        $input = $request->all();
        $chats  = Chat::where('room_id', $input['roomId'])->get();

        return $this->sendResponse($chats, 'Messages Retried successfully');
    }
}
