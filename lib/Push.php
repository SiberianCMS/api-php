<?php

namespace Siberian;

class Push {

    /**
     * @return Response
     */
    public static function listApps() {
        $endpoint = "push/api_global/list";

        return Request::post($endpoint, []);
    }

    /**
     * @param $title
     * @param $message
     * @param array $checked // [42 => true, 43 => true]
     * @param bool $send_to_all
     * @param string $devices
     * @param bool $open_url
     * @param null $url
     * @return Response
     */
    public static function send($title, $message, $checked = [], $send_to_all = false, $devices = "all",
                                $open_url = false, $url = null) {
        $endpoint = "push/api_global/send";

        if(empty($title) || empty($message)) {
            throw new Exception("#400 Title & Message are required.");
        }

        if(empty($checked) && !$send_to_all) {
            throw new Exception("#401 Please select at least one application.");
        }

        if($open_url && empty($url)) {
            throw new Exception("#402 An URL is required when \$open_url is set to true.");
        }

        # Building data
        $data = array(
            "title" => $title,
            "message" => $message,
            "checked" => $checked,
            "send_to_all" => $send_to_all,
            "devices" => $devices,
            "open_url" => $open_url,
            "url" => $url,
        );

        return Request::post($endpoint, $data);
    }

}