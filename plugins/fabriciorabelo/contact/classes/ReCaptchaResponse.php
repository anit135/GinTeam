<?php namespace FabricioRabelo\Contact\Classes;

/**
 * A ReCaptchaResponse is returned from checkAnswer().
 */
class ReCaptchaResponse {
    public $success;
    public $errorCodes;
    public $urlString;
}
