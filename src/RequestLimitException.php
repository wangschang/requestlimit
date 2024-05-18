<?php
namespace wangschang\RateLimiter;

use Exception;
use Throwable;

class RequestLimitException extends Exception{

    const ERROR_FILE_NOT_DIR = 1001;//file is not a dir 
    const ERROR_FILE_NOT_WRITE = 1002;
    const ERROR_ID_IS_NULL = 1003;
    /**
     * maps for message
     *
     * @param [type] $code
     * @return void
     */
    public static function MessageMaps($code){
        $maps = [
            1001=>"file is not a dir",
            1002=>"file can not writeable",
            1003=>"the unique key can not be null",
        ];
        return $maps[$code]??'';
    }
    /**
     * construct
     *
     * @param string $message
     * @param integer $code
     * @param Throwable|null $previous
     */
    public function __construct($code = 0, Throwable $previous = null) {
        $message = RequestLimitException::MessageMaps($code);
        parent::__construct($message, $code, $previous);
    }
    public function getRequestLimitMessage(){
        return ["msg"=>$this->message,"code"=>$this->code];
    }

}