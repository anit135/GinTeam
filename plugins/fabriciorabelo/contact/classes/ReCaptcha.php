<?php namespace FabricioRabelo\Contact\Classes;
/**
 * This is a PHP library that handles calling reCAPTCHA.
 * - Documentation and latest version
 * https://developers.google.com/recaptcha/docs/php
 * - Get a reCAPTCHA API Key
 * https://www.google.com/recaptcha/admin/create
 * - Discussion group
 * http://groups.google.com/group/recaptcha
 *
 * @copyright Copyright (c) 2014, Google Inc.
 * @link http://www.google.com/recaptcha
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

use FabricioRabelo\Contact\Classes\ReCaptchaResponse;

class ReCaptcha {
    private static $_signupUrl = "https://www.google.com/recaptcha/admin";
    private static $_siteVerifyUrl = "https://www.google.com/recaptcha/api/siteverify?";
    private static $_secret;
    private static $_version = "php_1.0";

    /**
     * Constructor.
     *
     * @param string $secret shared secret between site and ReCAPTCHA server.
     */
    public function __construct($secret) {
        if($secret)
            self::$_secret = trim($secret);
    }

    /**
     * Init.
     *
     * @param string $secret shared secret between site and ReCAPTCHA server.
     */
    public static function init($secret) {
        if($secret)
            self::$_secret = trim($secret);
    }

    /**
     * Encodes the given data into a query string format.
     *
     * @param array $data array of string elements to be encoded.
     *
     * @return string - encoded request.
     */
    private static function _encodeQS($data) {
        $req = "";

        foreach ($data as $key => $value) {
            $req .= $key . '=' . urlencode(stripslashes($value)) . '&';
        }

        // Cut the last '&'
        $req = substr($req, 0, strlen($req) - 1);

        return $req;
    }

    /**
     * Submits an HTTP GET to a reCAPTCHA server.
     *
     * @param string $path url path to recaptcha server.
     * @param array $data array of parameters to be sent.
     *
     * @return array response
     */
    private static function _submitHTTPGet($path, $data) {
        $req = self::_encodeQS($data);

        $response = file_get_contents($path . $req);

        return $response;
    }

    /**
     * Calls the reCAPTCHA siteverify API to verify whether the user passes
     * CAPTCHA test.
     *
     * @param string $remoteIp IP address of end user.
     * @param string $response response string from recaptcha verification.
     *
     * @return ReCaptchaResponse
     */
    public static function verifyResponse($remoteIp, $response) {
        // Discard empty solution submissions
        if (null == $response || strlen($response) == 0) {
            $recaptchaResponse = new ReCaptchaResponse();
            $recaptchaResponse->success = false;
            $recaptchaResponse->errorCodes = 'missing-input';

            return $recaptchaResponse;
        }

        $data = [
            'secret' => self::$_secret,
            'remoteip' => $remoteIp,
            'v' => self::$_version,
            'response' => $response,
        ];

        $getResponse = self::_submitHttpGet(self::$_siteVerifyUrl, $data);

        $answers = json_decode($getResponse, true);
        $recaptchaResponse = new ReCaptchaResponse();

        if (trim($answers['success']) == true) {
            $recaptchaResponse->success = true;
            $recaptchaResponse->urlString = self::$_siteVerifyUrl . self::_encodeQS($data);
        } else {
            $recaptchaResponse->success = false;
            $recaptchaResponse->urlString = self::$_siteVerifyUrl . self::_encodeQS($data);
            $recaptchaResponse->errorCodes = isset($answers['error-codes']) ? $answers['error-codes'] : '';
        }

        return $recaptchaResponse;
    }
}
