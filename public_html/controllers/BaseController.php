<?php

namespace controllers;

class BaseController
{

    public function render_php($path, array $data)
    {
        ob_start();
        include($path);
        $var = ob_get_contents();
        ob_end_clean();
        return $var;
    }

    public function success($data, $code = 200)
    {
        header('Content-Type: application/json');
        http_response_code($code);
        return json_encode(['status' => 'success', 'message' => $data]);
    }

    public function error($data, $code = 500)
    {
        header('Content-Type: application/json');
        http_response_code($code);
        return json_encode(['status' => 'error', 'message' => $data]);
    }
}