<?php

namespace Jd\Auth;

use Psr\Http\Message\RequestInterface;
use SDK\Kernel\AccessToken as BaseAccessToken;

class AccessToken extends BaseAccessToken
{
    protected function appendQuery($query, RequestInterface $request): array
    {
        try {
            parse_str($request->getBody()->getContents(), $data);
        } catch (\Exception $e) {
            $data = [];
        }

        $appendQuery = [
            'app_key' => $this->app->config->get('appkey'),
            'v' => $this->app->config->get('version'),
            'format' => $this->app->config->get('format'),
            'sign_method' => $this->app->config->get('sign_method'),
            'timestamp' => date('Y-m-d H:i:s'),
            'param_json' => json_encode($data)
        ];

        return array_merge($appendQuery, [
            'sign' => $this->generateSign(
                $query + $appendQuery,
                $this->app->config->get('appsecret')
            ),
        ]);
    }

    protected function generateSign($data, $secretKey)
    {
        ksort($data);
        $stringToBeSigned = $secretKey;
        foreach ($data as $k => $v) {
            if ($v === null || $v === '') {
                continue;
            }
            $stringToBeSigned .= "{$k}{$v}";
        }
        unset($k, $v);
        $stringToBeSigned .= $secretKey;
        return strtoupper(md5($stringToBeSigned));
    }
}