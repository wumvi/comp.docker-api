<?php
declare(strict_types=1);

namespace DockerApi;

use LightweightCurl\Curl;
use LightweightCurl\Request;

class Common
{
    public const UNIX_SOCKET_PATH = '/var/run/docker.sock';

    public const URL = 'http://localhost/';

    protected $curl;

    public function __construct()
    {
        $this->curl = new Curl();
    }

    public function makeGetRequest(): Request
    {
        $request = new Request();
        $request->setUnixSocket(self::UNIX_SOCKET_PATH);
        $request->setHeaders(['Content-Type' => 'application/json',]);

        return $request;
    }

    public function makePostRequest(): Request
    {
        $request = new Request();
        $request->setMethod(Request::METHOD_POST);
        $request->setUnixSocket(self::UNIX_SOCKET_PATH);
        $request->setHeaders(['Content-Type' => 'application/json',]);
        $request->setTimeout(30);

        return $request;
    }
    
    public function makeDeleteRequest(): Request
    {
        $request = new Request();
        $request->setMethod(Request::METHOD_DELETE);
        $request->setUnixSocket(self::UNIX_SOCKET_PATH);
        $request->setHeaders(['Content-Type' => 'application/json',]);
        $request->setTimeout(30);

        return $request;
    }
}
