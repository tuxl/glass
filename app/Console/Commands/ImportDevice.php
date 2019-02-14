<?php

namespace App\Console\Commands;

use App\Device;
use Carbon\Carbon;
use function GuzzleHttp\Psr7\parse_header;
use Illuminate\Console\Command;

class ImportDevice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'throne:importdevice {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $file = $this->argument('file');
        $data = fread(fopen($file, 'r'),filesize($file));
        $parsedData = json_decode($data, true);
        foreach ($parsedData as $item){
            $dev = Device::where('sn', $item['sn'])->first();
            if ($dev != null){
                echo "-- skip ", $item['sn'], "\n";
                continue;
            }
            $tmp = new Device();
            $tmp->partner_id = 0;
            $tmp->sn = $item['sn'];
            $tmp->group_id = 0;
            $tmp->status = 0;
            $tmp->factory_batch =$item['factory_batch'];
            $tmp->hwId = $item['hwId'];
            $tmp->bootstrap_imei = $item['bootstrap_imei'];
            $tmp->data_imei = $item['data_imei'];
            $tmp->bootstrap_imsi = $item['bootstrap_imsi'];
            $tmp->bootstrap_meid = $item['bootstrap_meid'];
            $tmp->data_meid = $item['data_meid'];
            $tmp->remark = $item['remark'];
            $tmp->create_date = Carbon::now();
            $tmp->ssid_prefix = '';
            $tmp->ssid = $item['ssid'];
            $tmp->wifi_password = $item['wifi_password'];
            $tmp->flash_id = $item['flash_id'];
            $tmp->brand = $item['brand'];
            $tmp->model = $item['model'];
            $tmp->dev_type = $item['dev_type'];
            $tmp->channel_number = $item['channel_number'];
            $tmp->multi_slotconf = $item['multi_slotconf'];
            $tmp->datachannel_type = $item['datachannel_type'];
            $tmp->seedchannel_type = $item['seedchannel_type'];
            $tmp->wifi_relay = $item['wifi_relay'];
            $tmp->bootstrap_imei2 = $item['bootstrap_imei2'];
            $tmp->bootstrap_meid2 = $item['bootstrap_meid2'];
            $tmp->data_imei2 = $item['data_imei2'];
            $tmp->data_emid2 = $item['data_emid2'];
            $tmp->mac1 = $item['mac1'];
            $tmp->mac2 = $item['mac2'];
            $tmp->bt_mac = $item['bt_mac'];
            $tmp->dev_cnnpsw = $item['dev_cnnpsw'];
            $tmp->cert_1 = $item['cert_1'];
            $tmp->cert_2 = $item['cert_2'];
            $tmp->importtime = time();
            $tmp->data_imsi2 = $item['data_imsi2'];
            $tmp->save();
            echo "import ", $item['sn'], "\n";
        }
    }
}
