<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Incoming\Answer;
use Illuminate\Support\Facades\Mail;
use PHPMailer\PHPMailer\PHPMailer;
use Illuminate\Support\Facades\Session;

class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */

    public function handle()
    {
        $botman = app('botman');

        $botman->hears('{message}', function ($botman, $message) {
            $botman->types();
            if (str_contains($message, '@')) {
                $botman->types();
                $mail = $message;
                $this->sayBye($botman, $message);
            } elseif ($message == 'hi' || $message == 'Hi' || $message == 'Hello' || $message == 'Hey') {
                $botman->types();
                $this->askName($botman);
            } elseif ($message == 'ok') {
                $botman->types();
                $this->sayBye($botman, $message);
            } else {
                $botman->types();
                if (!in_array(strtolower($message), ['hi', 'hello', 'hey'])) {
                    Session::put('question', $message);
                }
                $botman->reply('Give me your Gmail so I can contact you soon. ');
            }
        });

        $botman->listen();
    }
    public function askName($botman)
    {
        $botman->ask("What's your name?", function (Answer $answer) {
            $name = $answer->getText();
            Session::put('name', $name);
            $this->say('Who can i help you,' . $name . '?');
        });
    }

    public function sayBye($botman, $message)
    {
        $botman->types();
        $imagePath = public_path('assets/images/247 NEW Logo 1.png');





















        // user
        //     $data1 = [
        //         'newMessage' => 'Successfully Send Your Issue To 247Tutors Support Team',
        //         'email' => $message,
        //         'name' => Session::get('name'),
        //         'question' => Session::get('question'),

        //     ];
        //     $view = \view('pages.mails.chatbotemailUser', $data1);
        //     $view = $view->render();
        //     $mail = new PHPMailer();
        //     $mail->CharSet = "UTF-8";
        //     $mail->setfrom('support@247tutors.com', '247 Tutors');
        //     $mail->AddEmbeddedImage($imagePath, 'logo');
        //     $mail->isHTML(true);
        //     $mail->Subject = 'Successfully Send Your Issue To 247Tutors Support Team';
        //     $mail->Body = $view;
        //     $mail->AltBody = '';
        //     $mail->addaddress($message,Session::get('name'));
        //     $mail->isHTML(true);
        //     $mail->msgHTML($view);



        //     if (!$mail->send())
        //         throw new \Exception('Failed to send mail');

        //    $data = [
        //         'newMessage' => 'You have a new query from',
        //          'email' => $message,
        //         'name' => Session::get('name'),
        //         'question' => Session::get('question'),

        //     ];
        //     $view = \view('pages.mails.chatbotemailAdmin', $data);
        //     $view = $view->render();
        //     $mail = new PHPMailer();
        //     $mail->CharSet = "UTF-8";
        //     $mail->setfrom('support@247tutors.com', '247 Tutors');
        //     $mail->AddEmbeddedImage($imagePath, 'logo');
        //     $mail->isHTML(true);
        //     $mail->Subject = 'Support Query';
        //     $mail->Body = $view;
        //     $mail->AltBody = '';
        //     $mail->addaddress(optional(\App\Models\WebSetting::find(1))->field_value,'Admin');
        //     $mail->isHTML(true);
        //     $mail->msgHTML($view);
        //     if (!$mail->send())
        //         throw new \Exception('Failed to send mail');






















        Session::forget('name');
        Session::put('name');
        Session::put('question');
        $botman->types();
        $botman->ask("Okay, it's a pleasure to meet you. We've received your email details, so I'll be contacting you shortly. If you have any urgent questions, feel free to reach out." . optional(\App\Models\WebSetting::find(1))->field_value, function (Answer $answer) {
            $name = $answer->getText();
            $this->say('Bye ' . $name);
        });
    }
}
