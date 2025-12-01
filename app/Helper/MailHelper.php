<?php

namespace App\Helper;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

class MailHelper
{
    public static function sendMail($folderName, $type, $debug, $customerEmail, $item, $Subject, $files=null)
    {
        // Change this to your desired folder name
        $folderPath = public_path("Request/$type/$folderName");
        if (!File::exists($folderPath))
            File::makeDirectory($folderPath, 0755, true);


        $filesName = [];
        $fileNameCounter = 1;
        // check if files exist
        if ($files) {
            foreach ($files as $file) {
                $fileName = "{$fileNameCounter}.{$file->extension()}";
                // Move the file to the desired location
                $file->move($folderPath, $fileName);
                $fileNameCounter = $fileNameCounter + 1;

                array_push($filesName,  $fileName);
            }
        }
        // Create instance of PHPMailer class
        $mail = new PHPMailer($debug);
        if ($debug) {
            // issue a detailed log
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        }
        // Authentication with SMTP
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        // Login
        $mail->Host = "smtp.de";
        $mail->Port = 587;
        $mail->Username = "Info@Domain.de";
        $mail->Password = "";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->setFrom('Info@Domain.de', 'Transport');
        $mail->addAddress($customerEmail);
        // CC
        $mail->AddCC('Domain.admin@gmail.com');
        $mail->AddCC('Info@Domain.de');
        foreach ($filesName as $element) {
            $mail->addAttachment("{$folderPath}/$element", $element);
        }
        // geneate pdf
        $dataPdf = [
            "$type"   => $item,
        ];
        $typePdf = $type . 'Pdf';
        $pdf = Pdf::loadView("$type/pdf/$typePdf", $dataPdf);
        $pdf->save("{$folderPath}/$folderName.pdf");
        $mail->addAttachment("{$folderPath}/$folderName.pdf", $folderName);
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        $mail->isHTML(true);
        $mail->Subject = $Subject;

        $bodyView = view("$type/email/$type")->render();

        $mail->Body = $bodyView;
        $mail->send();
    }
}
