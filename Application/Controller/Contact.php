<?php

namespace Rave\Application\Controller;

use Rave\Application\Model\ContactModel;
use Rave\Core\Controller;
use Rave\Library\Core\IO\In;
use Rave\Library\Core\Security\Text;

class Contact extends Controller
{
    const EMAIL = 'email@mail.com';

    public function __construct()
    {
        $this->setLayout('main');
        $this->setI18n(true);
    }

    public function index()
    {
        if (!In::isSetPost('name', 'email', 'subject', 'message')) {
            $this->loadView('contact_form');
            exit;
        }

        if (ContactModel::exists(Text::hash($_SERVER['REMOTE_ADDR']))) {
            echo '<h6>You already sent a message</h6>';
        } else {
            if (Text::isEmail(In::post('email'))) {
                mail(
                    self::EMAIL,
                    In::post('subject'),
                    In::post('message'),
                    'From: ' . In::post('name') .
                    ' <' . In::post('email') . '>' . "\r\n" .
                    'Reply-To: ' . In::post('email') . "\r\n"
                );

                ContactModel::insert(['contact_ip' => Text::hash($_SERVER['REMOTE_ADDR'])]);

                echo '<h6>Your message has been sent</h6>';
            } else {
                echo '<h6>Not a valid email address</h6>';
            }
        }
    }

}