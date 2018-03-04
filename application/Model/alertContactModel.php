<?php
/**
 * Created by PhpStorm.
 * User: colorrabbit
 * Date: 2017/6/12
 * Time: 下午2:27
 */

class AlertContactModel extends Model
{
    public function setAlertDetails($data)
    {
        $alertInfos = $alreadyExistsContact = array();
        // dump($this->getInfo(array('id' => 1)));exit;

        foreach ($data as $key => $value) {
            $contactExists = $this->getInfo(array('id'), array('contact_id' => $value['id']));
            if ($contactExists) {
                $alreadyExistsContact[] = $contactExists[0]['id'];
                continue;
            }
            $alertInfos[$key]['contact_id'] = $value['id'];
            $alertInfos[$key]['friendly_name'] = $value['friendly_name'];
            $alertInfos[$key]['type'] = $value['type'];
            $alertInfos[$key]['status'] = $value['status'];
            $alertInfos[$key]['value'] = $value['value'];
        }

        // dump(CR::init_config('time'));
        // $accountDetails = getModel('account_details');
        // dump($accountDetails->getInfo('*', 1));

        if ($alertInfos) {
            $this->insertInfo($alertInfos);
            return 'Add Info Success!';
        }
        if ($alreadyExistsContact) {
            return 'Contact `' . implode('`', $alreadyExistsContact) . '` Already Exists!';
        }

    }
}