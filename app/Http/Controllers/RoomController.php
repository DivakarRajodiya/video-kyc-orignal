<?php

namespace App\Http\Controllers;

use App\DataTables\RoomDataTable;
use App\Http\Requests\CreateRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Room;
use App\Repositories\RoomRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laracasts\Flash\Flash;
use Response;
use Yajra\DataTables\DataTables;

class RoomController extends AppBaseController
{
    /** @var  RoomRepository */
    private $roomRepository;

    public function __construct(RoomRepository $roomRepo)
    {
        $this->roomRepository = $roomRepo;
    }

    /**
     * Display a listing of the Room.
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
            return DataTables::of((new RoomDataTable())->get())->make(true);
        }

        return view('rooms.index');
    }

    /**
     * Show the form for creating a new Room.
     *
     * @return Response
     */
    public function create()
    {
        return view('rooms.create');
    }

    /**
     * Store a newly created Room in storage.
     *
     * @param CreateRoomRequest $request
     *
     * @return Response
     */
    public function store(CreateRoomRequest $request)
    {
        $input = $request->all();

        $room = $this->roomRepository->create($input);

        Flash::success('Room saved successfully.');

        return redirect(route('rooms.index'));
    }

    /**
     * Display the specified Room.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $room = $this->roomRepository->find($id);

        if (empty($room)) {
            Flash::error('Room not found');

            return redirect(route('rooms.index'));
        }

        return view('rooms.show')->with('room', $room);
    }

    /**
     * Show the form for editing the specified Room.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $room = $this->roomRepository->find($id);

        if (empty($room)) {
            Flash::error('Room not found');

            return redirect(route('rooms.index'));
        }

        return view('rooms.edit')->with('room', $room);
    }

    /**
     * Update the specified Room in storage.
     *
     * @param int $id
     * @param UpdateRoomRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRoomRequest $request)
    {
        $room = $this->roomRepository->find($id);

        if (empty($room)) {
            Flash::error('Room not found');

            return redirect(route('rooms.index'));
        }
        $input = $request->all();
        $input['password'] = isset($input['password']) ? Hash::make($input['password']) : $room->password;
        $input['is_active'] = isset($input['is_active']) ? true : true;
        $room = $this->roomRepository->update($input, $id);

        Flash::success('Room updated successfully.');

        return redirect(route('rooms.index'));
    }

    /**
     * Remove the specified Room from storage.
     *
     * @param Room $room
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy(Room $room)
    {
        $room->delete();

        return $this->sendSuccess('Room deleted successfully.');
    }
}
