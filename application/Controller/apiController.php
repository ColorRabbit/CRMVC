<?php

class ApiController extends Controller
{
    public function getAccountDetailsAction()
    {
        $setMsg = '测试';
        /*$array = array(
            'api_key' => '###',
            'format' => 'json',
            // 'logs' => 1,
        );

        // $uptimeRobot = SingleSign::getInterface('v2/getAccountDetails');
        // $uptimeRobot = SingleSign::getInterface('v2/getAlertContacts');
        // $uptimeRobot = SingleSign::getInterface('v2/getMWindows');
        // $uptimeRobot = SingleSign::getInterface('getAccountDetails');
        $response = SingleSign::getInterface('v2/getMonitors', $array, 'POST');
        $data = json_decode($response, true);
        dump($data);exit;

        // $accountDetailsModel = getModel('account_details');
        // $setMsg = $accountDetailsModel->setAccountDetails($data['account']);
        // dump($accountDetailsModel->getInfo(array('id', 'email'), 1));

        // $alertContactModel = getModel('alert_contact');
        // $setMsg = $alertContactModel->setAlertDetails($data['alert_contacts']);
        // $info = $alertContactModel->getInfo();
        // dump($info);

        $monitorsTotal = $data['pagination']['total'];

        $monitorsModel = WorkShop::Model('monitors');
        dump($monitorsModel->setMonitors($data['monitors']));*/

        // $this->display('showlist.php');
        $this->render('showlist.html.twig', array('show' => $setMsg));
    }

}

