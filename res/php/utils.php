<?php
        
    /**
     * guidv4
     * Genarate an uuid (36 chars long)
     * 
     * @param  mixed $data
     * @return void
     */
    function guidv4($data = null) {
        // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
        $data = $data ?? random_bytes(16);
        assert(strlen($data) == 16);
    
        // Set version to 0100
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        // Set bits 6-7 to 10
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
    
        // Output the 36 character UUID.
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }


    function checkRequestMethod(string $requestMethod, string $acceptedRequestMethod) {
        global $return;
        $accepted = false;
        $requestMethods = ['GET', 'HEAD', 'POST', 'PUT', 'DELETE', 'CONNECT', 'OPTIONS', 'TRACE', 'PATCH'];
        if (in_array($requestMethod, $requestMethods) && $requestMethod === strtoupper($acceptedRequestMethod)) {
            $accepted = true;
        } else {
            $return['message'] = 'Method not allowed';
        }
        return $accepted;
    }