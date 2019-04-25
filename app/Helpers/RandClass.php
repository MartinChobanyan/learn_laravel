<?php

namespace App\Helpers;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use function GuzzleHttp\json_decode;
use Guzzle\Http\Exception\ClientErrorResponseException;

class RandClass{
    private $client;
    private $link;
    private $data;

    function __construct()
    {
        $this->init();
    }
    function __toString(){
        return json_encode($this->data);
    }
    private function init(){
        $this->client = new Client;
        $this->link = 'https://uinames.com/api/?';
    }
    public function get($gender = null, $region = null, $minlen = null, $maxlen = null){
        $parameters = [
            'gender' => $gender,
            'region' => $region,
            'minlen' => $minlen,
            'maxlen' => $maxlen
        ];
        try{
            $this->data = json_decode($this->client->get($this->link.http_build_query(array_filter($parameters)))->getBody(true), true);
        }catch(ClientErrorResponseException $e){
            $this->data = [
                'name' => 'Vasya', 
                'surname' => 'Pumpkin'
            ];
        }
        return $this;
    }
    public function name(){
        return $this->data['name'];
    }
    public function surname(){
        return $this->data['surname'];
    }
}