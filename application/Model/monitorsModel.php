<?php

/**
 * Created by PhpStorm.
 * User: colorrabbit
 * Date: 2017/6/13
 * Time: 下午9:44
 */
class MonitorsModel extends Model
{
    public function setMonitors($monitors)
    {
        $array = array();
        $now = date('Y-m-d H:i:s');
        foreach ($monitors as $key => $value) {
            $array[$key]['monitors_id'] = $value['id'];
            $array[$key]['friendly_name'] = $value['friendly_name'];
            $array[$key]['url'] = $value['url'];
            $array[$key]['type'] = strval($value['type']);
            $array[$key]['sub_type'] = strval($value['sub_type']);
            $array[$key]['keyword_type'] = strval($value['keyword_type']);
            $array[$key]['keyword_value'] = $value['keyword_value'];
            $array[$key]['http_username'] = $value['http_username'];
            $array[$key]['http_password'] = $value['http_password'];
            $array[$key]['port'] = $value['port'];
            $array[$key]['interval'] = intval($value['interval']);
            $array[$key]['status'] = strval($value['status']);
            $array[$key]['create_datetime'] = $value['create_datetime'];
            $array[$key]['current_time'] = $now;
        }

        return $this->insertInfos($array);
    }

}
