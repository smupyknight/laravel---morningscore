<?php

namespace App\Support\Util;

use Carbon\Carbon;

class JWT
{
    public static function generate($comp_id, $exp_time)
    {
        // header
        $s1 = '{"alg":"HS256","typ":"JWT"}';
        
        // payload
        $j2 = [
            "exp"   => $exp_time,
            "iss"   => config('app.name'),
            "comp"  => $comp_id,
        ];
        $s2 = json_encode($j2);
        
        
        $b1 = self::url_friendly(base64_encode($s1));
        $b2 = self::url_friendly(base64_encode($s2));
        $b3 = self::signature($b1 . '.' . $b2);
        
        return implode('.', [$b1, $b2, $b3]);
    }

    protected static function signature($str)
    {
        $key = hash('sha256', config('app.key') . 'JWTSig', true);
        $str = hash_hmac('sha256', $str, $key, true);
        
        return self::url_friendly(base64_encode($str));
    }
    
    protected static function url_friendly($str)
    {
        $str = str_replace("+", "-", $str);
        $str = str_replace("/", "_", $str);
        $str = str_replace("=", "", $str);
        
        return $str;
    }
    
    protected static function url_unfriendly($str)
    {
        $str = str_replace("-", "+", $str);
        $str = str_replace("_", "/", $str);
        //$str = str_replace("=", "", $str);
        
        return $str;
    }
    
    public static function validate($token)
    {
        /* https://auth0.com/docs/api-auth/tutorials/verify-access-token */
        /* Step 1: Check That The JWT Is Well Formed */
        $parts = self::validateHeader($token);
        if($parts === null) {
            return null;
        }

        /* Step 2: Check The Signature */
        $sig = self::signature($parts[0] . '.' . $parts[1]);
        
        if($sig !== $parts[2]) { // signature doesn't match
            return null;
        }
        
        /* Step 3: Validate The Standard Claims */
        $claims = self::validateClaims($parts[1]);
        if($claims === null) {
            return null;
        }
        
        /* Step 4: Check The Client Permissions (scopes) */
        return $claims;
    }
    
    protected static function validateHeader($token)
    {
        /* https://tools.ietf.org/html/rfc7519#section-7.2 */
        // Verify that the JWT contains at least one period ('.') character.
        if ( ! is_string($token) || (strpos($token, '.') === false)) {
            return null;
        }
        
        // Determine whether the JWT is a JWS or a JWE using any of the
        // methods described in Section 9 of [JWE].
        //
        // JWSs have three segments separated by two period ('.') characters.
        // JWEs have five segments separated by four period ('.') characters.
        //
        // Verify that the JWT contains 3 parts
        $parts = explode('.', $token);
        if (count($parts) !== 3) {
            return null;
        }

        // Base64url decode the Encoded JOSE Header following the restriction
        // that no line breaks, whitespace, or other additional characters have been used.
        $JOSE_header = base64_decode(self::url_unfriendly($parts[0]));
        
        // Verify that the resulting octet sequence is a UTF-8-encoded
        // representation of a completely valid JSON object conforming to
        // RFC 7159 [RFC7159]; let the JOSE Header be this JSON object.
        if (mb_detect_encoding($JOSE_header, 'UTF-8', true) === false) {
            return null;
        }
        $JOSE_header = json_decode($JOSE_header);
        if ($JOSE_header === null) {
            return null;
        }

        // Verify that the resulting JOSE Header includes only parameters
        // and values whose syntax and semantics are both understood and
        // supported or that are specified as being ignored when not understood.
        if (!isset($JOSE_header->alg)
                || !isset($JOSE_header->typ)
                || $JOSE_header->alg !== "HS256"
                || $JOSE_header->typ !== "JWT"
            ) {
            return null;
        }
        
        return $parts;
    }
    
    protected static function validateClaims($payload)
    {
        $payload = json_decode(base64_decode(self::url_unfriendly($payload)));
        
        if (empty($payload) || $payload === null) {
            return null;
        }

        if (!isset($payload->exp)
                || !isset($payload->comp)
                || !isset($payload->iss)
                || $payload->iss !== config('app.name')
            ) {
            return null;
        }

        $payload->datetime = Carbon::createFromTimestamp($payload->exp);
        
        // Token expired
        if ($payload->datetime < Carbon::now()) {
            return null;
        }
        
        return $payload;
    }
}
