<?php

class ApiController extends Controller
{
    public function getAccountDetailsAction()
    {
        $setMsg = '测试';

        $this->render('showlist.html.twig', array('show' => $setMsg));
    }

}

