<?php

class AccountDetailsModel extends Model
{
    public function setAccountDetails($data)
    {
        $accountExists = $this->getInfo(array('id'), array('email' => $data['email']));
        if (!$accountExists) {
            $account = array(
                'email' => $data['email'],
                'up_monitors' => $data['up_monitors'],
                'down_monitors' => $data['down_monitors'],
                'paused_monitors' => $data['paused_monitors'],
            );
            $this->insertInfo($account);
            return 'Add Info Success!';
        }
        return 'Info Already Exists!';
    }

}