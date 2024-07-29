<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class DMSHelper
{
    protected $baseUrlApiDMS;

    public function __construct()
    {
        $this->baseUrlApiDMS = config('baseurl.dms');
    }

    public function login($credentials)
    {
        return Http::baseUrl($this->baseUrlApiDMS)
            ->post('/authentication/login', $credentials)
            ->object();
    }

    public function get(
        $access_token = null,
        string $path = '',
        array $params = [],
        bool $object = true,
        array $headers = [],
    ) {
        $req = Http::withToken($access_token);

        if (isset($headers)) {
            $req = $req->withHeaders($headers);
        }

        if ($params) {
            $req = $req->withQueryParameters($params);
        }

        $response = $req->baseUrl($this->baseUrlApiDMS)->get($path);

        return ($object) ?
            $response->object() :
            $response;
    }
}
