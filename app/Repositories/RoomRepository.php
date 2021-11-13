<?php

namespace App\Repositories;

use App\Models\Room;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class RoomRepository
 * @package App\Repositories
 * @version November 8, 2021, 6:00 am UTC
*/

class RoomRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'agent',
        'visitor',
        'agenturl',
        'visitorurl',
        'password',
        'roomId',
        'datetime',
        'duration',
        'shortagenturl',
        'shortvisitorurl',
        'agent_id',
        'is_active',
        'agenturl_broadcast',
        'visitorurl_broadcast',
        'shortagenturl_broadcast',
        'shortvisitorurl_broadcast',
        'title'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Room::class;
    }

    /**
     * @param $length
     *
     * @return string
     */
    public function generateRand($length): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    /**
     * @param array $input
     *
     * @return Model
     */
    public function create($input)
    {
        try {
            DB::beginTransaction();

            $lsRepUrl = null;

            $roomId = isset($input['roomId']) ? $input['roomId'] : $this->generateRand(10);
            $str = [];
            $str['lsRepUrl'] = $lsRepUrl;
            $agentName = isset($input['agent']) ? $input['agent'] : null;
            $visitorName = isset($input['visitor']) ? $input['visitor'] : null;
            $agentId = null;
            $agentShortUrl = isset($input['shortagenturl']) ? $input['shortagenturl'] : null;
            $visitorShortUrl =  isset($input['shortvisitorurl']) ? $input['shortvisitorurl'] : null;
            $password = isset($input['password']) ? Hash::make($input['password']) : null;
            $config = isset($input['config']) ? $input['config'] : 'config.json';
            $dateTime = isset($input['datetime']) ? $input['datetime'] : null;
            $duration = isset($input['duration']) ? $input['duration'] : null;
            $disableVideo = isset($input['disable_video']) ? true : false;
            $disableAudio = isset($input['disable_audio']) ? true : false;
            $disableScreenShare = isset($input['disable_screen_share']) ? true : false;
            $disableWhiteboard = isset($input['disable_white_board']) ? true : false;
            $disableTransfer = isset($input['disable_transfer']) ? true : false;
            $is_active = isset($input['is_active']) ? true : true;

            if ($agentName) {
                $str['names'] = $agentName;
            }
            if ($visitorName) {
                $str['visitorName'] = $visitorName;
            }
            if ($config) {
                $str['config'] = $config;
            }
            if ($agentId) {
                $str['agentId'] = $agentId;
            }

            if ($agentShortUrl) {
                $agentShortUrl = $agentShortUrl;
                $agentShortUrl_b = $agentShortUrl . '_b';
            } else {
                $agentShortUrl = $this->generateRand(6);
                $agentShortUrl_b = $this->generateRand(6);
            }
            if ($visitorShortUrl) {
                $visitorShortUrl = $visitorShortUrl;
                $visitorShortUrl_b = $visitorShortUrl . '_b';
            } else {
                $visitorShortUrl = $this->generateRand(6);
                $visitorShortUrl_b = $this->generateRand(6);
            }
            if ($dateTime) {
                $str['datetime'] = $dateTime;
            }
            if ($duration) {
                $str['duration'] = $duration;
            }
            if ($disableVideo) {
                $str['disableVideo'] = $disableVideo;
            }
            if ($disableAudio) {
                $str['disableAudio'] = $disableAudio;
            }
            if ($disableWhiteboard) {
                $str['disableWhiteboard'] = $disableWhiteboard;
            }
            if ($disableScreenShare) {
                $str['disableScreenShare'] = $disableScreenShare;
            }
            if ($disableTransfer) {
                $str['disableTransfer'] = $disableTransfer;
            }

            $encodedString = base64_encode(json_encode($str));

            $file = public_path('\assets\files\pages\r.html');

            $visitorUrl = $lsRepUrl . $file.'?room=' . $roomId . '&p=' . $encodedString;
            $viewerBroadcastLink = $lsRepUrl . $file.'?room=' . $roomId . '&p=' . $encodedString . '&broadcast=1';

            if ($password) {
                $str['pass'] = $password;
            }
            if (isset($str['vistorName'])) {
                unset($str['vistorName']);
            }
            $str['isAdmin'] = 1;
            $encodedString = base64_encode(json_encode($str));
            $agentUrl = $lsRepUrl . $file.'?room=' . $roomId . '&p=' . $encodedString . '&isAdmin=1';
            $agentBroadcastUrl = $lsRepUrl . $file.'?room=' . $roomId . '&p=' . $encodedString . '&isAdmin=1&broadcast=1';

            $room = Room::create([
                'agent' => $agentName,
                'visitor' => $visitorName,
                'agenturl' => $agentUrl,
                'visitorurl' => $visitorUrl,
                'password' => $password,
                'roomId' => $roomId,
                'datetime' => $dateTime,
                'duration' => $duration,
                'shortagenturl' => $agentShortUrl,
                'shortvisitorurl' => $visitorShortUrl,
                'agent_id' => $agentId,
                'is_active' => $is_active,
                'agenturl_broadcast' => $agentBroadcastUrl,
                'visitorurl_broadcast' => $viewerBroadcastLink,
                'shortagenturl_broadcast' => $agentShortUrl_b,
                'shortvisitorurl_broadcast' => $visitorShortUrl_b,
            ]);

            DB::commit();

            return $room;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
