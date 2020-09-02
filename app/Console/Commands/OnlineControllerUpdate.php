<?php

namespace App\Console\Commands;

use App\ATC;
use App\User;
use App\ControllerLog;
use App\ControllerLogUpdate;
use App\MemberLog;
use App\Loa;
use Carbon\Carbon;
use DB;
use Mail;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class OnlineControllerUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'OnlineControllers:GetControllers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieves all the online controllers and records them in the database.';

    protected $statusUrl = "http://status.vatsim.net/status.txt";

    protected $facilities = [
        /* CENTER */
        'DC_C', 'DC_0', 'DC_1', 'DC_2', 'DC_3', 'DC_5', 'DC_N', 'DC_S', 'DC_E', 'DC_W', 'DC_I',
        /* BRAVO */
        'DCA_', 'IAD_', 'BWI_', 'PCT_', 'ADW_',
        /* CHARLIE */
        'RIC_', 'ROA_', 'ORF_', 'ACY_', 'NGU_', 'NTU_', 'NHK_', 'RDU_',
        /* DELTA */
        'CHO_', 'HGR_', 'LYH_', 'EWN_', 'LWB_', 'ISO_', 'MTN_', 'HEF_', 'MRB_', 'PHF_', 'SBY_', 'NUI_',
        'FAY_', 'ILM_', 'NKT_', 'NCA_', 'NYG_', 'DAA_', 'DOV_', 'POB_', 'GSB_', 'WAL_', 'CVN_',
    ];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $statsData = $this->getStatsData();
        $last_update_log = ControllerLogUpdate::get()->first();
        $last_update = $last_update_log->created_at;
        $last_update_log->delete();
        $update_now = new ControllerLogUpdate;
        $update_now->save();

        DB::table('online_atc')->truncate();

        $client_section = false;
        foreach ($statsData as $line) {
            $line = trim($line);

            if (strpos($line, ";") === 0)
                continue;

            if (!$client_section && strpos($line, "UPDATE") === 0) {
                list($command, $time) = explode("=", $line);
                $time = trim($time);
                $time = preg_replace("/^(\d{4})(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})$/", "$1-$2-$3 $4:$5:$6", $time);
                $lastUpdated = strtotime($time);

            }

            if ($client_section && $line == "!SERVERS:")
                $client_section = false;

            if ($client_section) {
                list($position, $cid, $name, $clienttype, $frequency, $latitude, $longitude, $altitude, $groundspeed, $planned_aircraft, $planned_tascruise, $planned_depairport, $planned_altitude, $planned_destairport, $server, $protrevision, $rating, $transponder, $facilitytype, $visualrange, $planned_revision, $planned_flighttype, $planned_deptime, $planned_actdeptime, $planned_hrsenroute, $planned_minenroute, $planned_hrsfuel, $planned_minfuel, $planned_altairport, $planned_remarks, $planned_route, $planned_depairport_lat, $planned_depairport_lon, $planned_destairport_lat, $planned_destairport_lon, $atis_message, $time_last_atis_received, $time_logon, $heading) = explode(":", $line);

                $is_controller = $clienttype == "ATC" && strpos($position, "OBS") === false && $rating != '1' && $facilitytype != '0' && strpos($position, "SAVF") === false && strpos($position, "SAVC") === false;
                if (!$is_controller) continue;

                foreach ($this->facilities as $facility) {
                    $is_controller = substr($position, 0, 4) == $facility;
                    if ($is_controller) break;
                }


                if ($is_controller) {
                    // Found an ATC user
                    $time_logon = strtotime(preg_replace("/^(\d{4})(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})$/", "$1-$2-$3 $4:$5:$6", $time_logon));
                    $time_now = strtotime(Carbon::now());
                    $duration = $time_now - $time_logon;

                    ATC::create([
                        'position' => $position,
                        'freq' => $frequency,
                        'name' => $name,
                        'cid' => $cid,
                        'time_logon' => $time_logon,
                    ]);


                    // Is this neccessary? It detects if the streamupdate of the last record for the user matches this one
                    // Shouldn't bog anything down unless we are running this too often
                    $MostRecentLog = ControllerLog::where('cid', $cid)->where('time_logon', $time_logon)->where('name', $name)->
                    where('position', $position)->orderBy('time_logon', 'DESC')->first();

                    if (!$MostRecentLog || $MostRecentLog->time_logon != $time_logon) {
                        ControllerLog::create([
                            'cid' => $cid,
                            'name' => $name,
                            'position' => $position,
                            'duration' => $duration,
                            'date' => date('n/j/y'),
                            'time_logon' => $time_logon,
                            'streamupdate' => strtotime($update_now->created_at),
                        ]);
                    } else {
                        $MostRecentLog->duration = $duration;
                        $MostRecentLog->streamupdate = strtotime($update_now->created_at);
                        $MostRecentLog->save();
                    }

                    // Check for loa
                    $loa = Loa::where('controller_id', $cid)->where('status', 1)->first();
                    if ($loa != null) {
                        $user = User::find($cid);
                        $user->status = 1;
                        $loa->status = 5;

                        $user->save();
                        $loa->save();

                        Mail::send(['html' => 'emails.loas.controlled'], ['loa' => $loa, 'user' => $user], function ($m) use ($loa) {
                            $m->from('notams@vzdc.org', 'vZDC LOA Center');
                            $m->subject($loa->controller_name . ": vZDC LOA Expired Due To Controlling");
                            $m->to($loa->controller_email)->bcc('staff@vzdc.org');
                        });

                        $dossier = new MemberLog();
                        $dossier->user_submitter = 0;
                        $dossier->user_target = $loa->controller_id;
                        $dossier->content = "LOA Ended Due To Controlling";
                        $dossier->confidential = 0;
                        $dossier->save();
                    }
                }
            }

            if ($line != "!CLIENTS:")
                continue;
            else
                $client_section = true;
        }
        $time = Carbon::now('Etc/UTC')->format('H:i') . 'Z';
    }

    public function getStatsData()
    {
        $statusData = file_get_contents($this->statusUrl);
        $n = preg_match_all("/^url0=(.*)$/m", $statusData, $matches);
        $urls = $matches[1];
        shuffle($urls);
        $data = false;

        foreach ($urls as $url) {
            $data_file = file(trim($url));

            foreach ($data_file as $record) {
                if (substr($record, 0, 9) == 'UPDATE = ') {
                    $streamupdate = rtrim(substr($record, 9));
                    $update_time = gmmktime(
                        substr($streamupdate, 8, 2),
                        substr($streamupdate, 10, 2),
                        substr($streamupdate, 12, 2),
                        substr($streamupdate, 4, 2),
                        substr($streamupdate, 6, 2),
                        substr($streamupdate, 0, 4)
                    );
                    break;
                }
            }

            $age = time() - $update_time;
            if ($age < 600) {
                $data = $data_file;
                break;
            }
        }

        if (!$data) {
            throw \Exception("No data source found that is younger than 10 minutes old.");
        }

        return $data;
    }
}