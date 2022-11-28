<?php

namespace muyomu\auth\utility;

use muyomu\auth\config\DefaultSecurityConfig;

class Jwt
{
    private DefaultSecurityConfig $defaultSecurityConfig;

    public function __construct()
    {
        $this->defaultSecurityConfig = new DefaultSecurityConfig();
    }

    /**
     * 获取jwt token
     * @param array $payload jwt载荷  格式如下非必须
     * [
     * 'iss'= 'jwt_admin', //该JWT的签发者
     * 'iat'= time(), //签发时间
     * 'exp'= time()+7200, //过期时间
     * 'nbf'= time()+60, //该时间之前不接收处理该Token
     * 'jti'= md5(uniqid('JWT').time()) //该Token唯一标识
     * ]
     * @return string
     */
    public function getToken(array $payload):string
    {
        $base64header=self::base64UrlEncode(json_encode($this->defaultSecurityConfig->getOptions("header"),JSON_UNESCAPED_UNICODE));

        $base64payload=self::base64UrlEncode(json_encode($payload,JSON_UNESCAPED_UNICODE));

        return $base64header.'.'.$base64payload.'.'.self::signature($base64header.'.'.$base64payload,$this->defaultSecurityConfig->getOptions("key"),$this->defaultSecurityConfig->getOptions("header.alg"));
    }

    /**
     * 验证token是否有效,默认验证exp,nbf,iat时间
     * @param string $Token 需要验证的token
     * @return bool
     */
    public function verifyToken(string $Token):bool
    {
        $tokens = explode('.', $Token);

        if (count($tokens) != 3)
            return false;

        list($base64header, $base64payload, $sign) = $tokens;

        //获取jwt算法
        $base64decodeheader = json_decode($this->base64UrlDecode($base64header), JSON_OBJECT_AS_ARRAY);
        if (empty($base64decodeheader['alg']))
            return false;

        //签名验证
        if ($this->signature($base64header . '.' . $base64payload, $this->defaultSecurityConfig->getOptions("key"), $base64decodeheader['alg']) !== $sign)
            return false;

        $payload = json_decode(self::base64UrlDecode($base64payload), JSON_OBJECT_AS_ARRAY);

        //签发时间大于当前服务器时间验证失败
        if (isset($payload['iat']) && $payload['iat'] > time())
            return false;

        //过期时间小宇当前服务器时间验证失败
        if (isset($payload['exp']) && $payload['exp'] < time())
            return false;

        //该nbf时间之前不接收处理该Token
        if (isset($payload['nbf']) && $payload['nbf'] < time())
            return false;

        return true;
    }

    /**
     * @param string $input
     * @return string
     */
    private function base64UrlEncode(string $input):string
    {
        return str_replace('=', '', strtr(base64_encode($input), '+/', '-_'));
    }

    /**
     * @param string $input
     * @return bool|string
     */
    private function base64UrlDecode(string $input):bool|string
    {
        $remainder = strlen($input) % 4;
        if ($remainder) {
            $addlen = 4 - $remainder;
            $input .= str_repeat('=', $addlen);
        }
        return base64_decode(strtr($input, '-_', '+/'));
    }

    /**
     * @param string $input
     * @param string $key
     * @param string $alg
     * @return string
     */
    private function signature(string $input, string $key, string $alg = 'HS256'): string
    {
        $alg_config=array(
            'HS256'=> 'sha256'
        );

        return $this->base64UrlEncode(hash_hmac($alg_config[$alg], $input, $key,true));
    }
}