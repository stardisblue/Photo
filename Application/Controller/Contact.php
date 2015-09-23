<?php

namespace Rave\Application\Controller;

use Rave\Core\Controller;

use Rave\Config\Config;

use Rave\Application\Model\ContactModel;

use Rave\Library\Core\IO\In;
use Rave\Library\Core\IO\Out;
use Rave\Library\Core\Security\String;

class Contact extends Controller {

    public function __construct()
    {
        $this->setLayout('main');
        $this->setI18n('header');
    }

    public function index()
    {
        if (In::isSetPost(['name', 'email', 'subject', 'message'])) {
            if (ContactModel::exists(String::hash($_SERVER['REMOTE_ADDR']))) {
                echo '<h6>You already sent a message</h6>';
            } else {
                if (String::isEmail(In::post('email'))) {
                    Out::mail(
                        Config::getEmail('contact'),
                        In::post('subject'),
                        In::post('message'),
                        'From: ' . In::post('name') .
                        ' <' . In::post('email') . '>' . "\r\n" .
                        'Reply-To: ' . In::post('email') . "\r\n"
                    );

                    ContactModel::insert(['contact_ip' => String::hash($_SERVER['REMOTE_ADDR'])]);

                    echo '<h6>Your message has been sent</h6>';
                } else {
                    echo '<h6>Not a valid email address</h6>';
                }
            }
        } else {
            $this->loadView('contact_form');
        }
    }

}