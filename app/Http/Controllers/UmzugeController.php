<?php

namespace App\Http\Controllers;

use App\Helper\MailHelper;
use App\Http\Requests\TransportRequest;
use App\Http\Requests\UmzugeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\umzuge;
use App\Models\Transport;
use App\Models\Entsorgung;
use DateTime;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

class UmzugeController extends Controller
{
    public function UmzugeRequest1(UmzugeRequest $request)
    {
        try {
            $valid = $request->validated();
            if ($valid['umzugeType'] == "Ich möchte eine Video-Besichtigung buchen")
                $valid['umzugeDateTime'] = new DateTime($request->input('umzugeDateTime'));
            else
                $valid['umzugeDateTime'] = null;

            $newItem = new umzuge($valid);

            $newItem->save();

            //sendMail
            $debug = true;
            try {
                $folderName = 'umzuge'.'('. $newItem->name.')';
                if($request->hasFile('files')){
                $mail = MailHelper::sendMail($folderName, 'umzuge', $debug, $request->input('email'), $newItem,'Ihre Anfrage zum bevorstehende Umzug mit der Domain',$valid['files']);
                }else{
                $mail = MailHelper::sendMail($folderName, 'umzuge', $debug, $request->input('email'), $newItem,'Ihre Anfrage zum bevorstehende Umzug mit der Domain',null);
                }
            } catch (Exception $e) {
            }

            return Response::json(200);

        } catch (Exception $e) {
            return Response::json(['error' => 'Message could not be processed. Error: ' . $e->getMessage()], 500);
        }
    }





}
