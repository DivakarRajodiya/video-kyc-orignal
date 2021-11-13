<?php

namespace App\Http\Controllers;

use App\DataTables\QuestionAnswerDataTable;
use App\Models\QuestionAnswer;
use App\Repositories\QuestionAnswerRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class QuestionAnswerController extends AppBaseController
{
    /** @var  QuestionAnswerRepository */
    private $questionAnswerRepository;

    public function __construct(QuestionAnswerRepository $questionAnswerRepository)
    {
        $this->questionAnswerRepository = $questionAnswerRepository;
    }

    /**
     * @param Request $request
     *
     * @return Application|Factory|View
     *
     * @throws \Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of((new QuestionAnswerDataTable())->get())->make(true);
        }

        return view('question-answer.index');
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $this->questionAnswerRepository->create($input);

        return $this->sendSuccess('QuestionAnswer saved successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  QuestionAnswer  $questionAnswer
     *
     * @return mixed
     */
    public function edit(QuestionAnswer $questionAnswer)
    {
        return  $this->sendResponse($questionAnswer, 'QuestionAnswer Retired Successfully');
    }

    /**
     * @param Request $request
     *
     * @param QuestionAnswer $questionAnswer
     *
     * @return mixed
     */
    public function update(Request $request, QuestionAnswer $questionAnswer)
    {
        $input = $request->all();
        $this->questionAnswerRepository->update($questionAnswer, $input);

        return  $this->sendSuccess('QuestionAnswer updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  QuestionAnswer  $questionAnswer
     *
     * @throws Exception
     *
     * @return mixed
     */
    public function destroy(QuestionAnswer $questionAnswer)
    {
        $questionAnswer->delete();

        return $this->sendSuccess('QuestionAnswer deleted successfully.');
    }
}
