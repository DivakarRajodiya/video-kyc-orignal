<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class LocaleController extends AppBaseController
{
    /**
     * Display a listing of the Locales.
     *
     * @param Request $request
     *
     * @return Application|Factory|View
     *
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $fileName = !is_null($request->query('file')) ? $request->query('file') : 'en_US.json';

        return view('locales.index', compact('fileName'));
    }

    /**
     * @param Request $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $input = $request->all();
            $jsonString = file_get_contents(public_path('locales\en_US.json'));
            file_put_contents(public_path('locales/') . $input['fileName'] . '.json', $jsonString);

            DB::commit();

            return redirect(route('locale.index'));
        } catch (\Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param Request $request
     *
     * @return false|Application|RedirectResponse|Redirector
     */
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();

            $input = $request->all();
            $jsonString = file_get_contents(public_path('locales/'.$input['fileName']));
            $data = json_decode($jsonString, true);

            foreach ($input['data'] as $key => $item) {
                $val = explode('.', $key);
                if (isset($val[1]) && $item == 'true') {
                    $data[$val[0]][$val[1]] = true;
                } else if (isset($val[1]) && $item == 'false') {
                    $data[$val[0]][$val[1]] = false;
                } else if (isset($val[1]) && $item) {
                    $data[$val[0]][$val[1]] = $item;
                } else if (isset($val[1])) {
                    unset($data[$val[0]][$val[1]]);
                } else {
                    $data[$key] = $item;
                }
            }

            $newJsonString = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            file_put_contents(public_path('locales/'.$input['fileName']), $newJsonString);

            $currentVersion = file_get_contents(public_path('\assets\files\pages\version.txt'));
            $curNumber = explode('.', $currentVersion);
            if (count($curNumber) == 3) {
                $currentVersion = $currentVersion . '.1';
            } else {
                $currentVersion = $curNumber[0] . '.' . $curNumber[1] . '.' . $curNumber[2] . '.' . ((int) $curNumber[3] + 1);
            }
            file_put_contents(public_path('\assets\files\pages\version.txt'), $currentVersion);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function destroy(Request $request)
    {
        try {
            DB::beginTransaction();

            $input = $request->all();
            unlink(public_path('locales/') . $input['fileName'] . '.json');

            DB::commit();

            return $this->sendSuccess('Locale deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
