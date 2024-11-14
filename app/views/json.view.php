<?php

class  JSONView {

    public function response($body, $status = 200) {
        header("Content-Type: application/json");
        $statusText = $this->_requestStatus($status);
        header("HTTP/1.1 $status $statusText");
        echo json_encode($body);
    }

    public function _requestStatus($code) {
        $status = array(
            200 => "ok",
            201 => "Created", 
            204 => "No content",
            400 => "Bad request",
            404 => "Not found", 
            500 => "Internal server error"
        );
        if(!isset($status[$code])) {
            $code = 500;
        }
        return $status[$code];
    }
}