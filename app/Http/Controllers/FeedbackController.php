<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedBackRequest;
use App\Mail\FeedBackMail;
use App\Mail\OrderMail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    public function feedbackEmail(FeedBackRequest $request)
    {
        // Enable or disable exceptions via variable

        // $mail = new PHPMailer($debug);
        // if ($debug) {
        //     // issue a detailed log
        //     $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        // }
        // // Authentication with SMTP
        // $mail->isSMTP();
        // $mail->SMTPAuth = true;
        // // Login
        // $mail->Host = "smtp.de";
        // $mail->Port = 587;
        // $mail->Username = "Info@Domain.de";
        // $mail->Password = "";
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        // $mail->setFrom('Info@Domain.de', 'Transport');
        // $mail->addAddress($request->input('email'));
        // // $mail-> addAttachment("/home/user/Desktop/sampleimage.png", "sampleimage.png");
        // $mail->CharSet = 'UTF-8';
        // $mail->Encoding = 'base64';
        // $mail->isHTML(true);
        // $mail->Subject = 'Domain Transport';

        // $mail->Body = '<p> Vielen Dank, dass Sie uns kontaktiert haben, Sir <b>' . $request->input('name') . '</b> </p>  <br> <br> ' . $request->input('nachricht') ;
        // // $mail->AltBody = 'The text as a simple text element';
        // $mail->send();

        try {
            $data = $request->validated();

            Mail::send(new FeedBackMail($data));
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "error sanding message" . $e,
            ], 500);
        }
    }
  
}
