<?php
class test{

    public function postData($url, $formData){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $formData);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    public function devicepartnerinfo(){
        $url = "http://127.0.0.1:8080/api/itf/devicepartnerinfo";
        $form = [
            "sn"=> "354243074362631",
        ];
        $output = $this->postData($url, $form);
        print_r($output);
        print_r(json_decode($output, true));
    }

}

$command = $argv[1];

switch ($command){
    case 'devicepartnerinfo':
        $request = new test();
        $request->devicepartnerinfo();
        break;
}
