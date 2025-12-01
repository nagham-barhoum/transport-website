<?php

namespace App\Http\Controllers;

use App\Helper\MailHelper;
use App\Http\Requests\TransportRequest;
use App\Models\CarType;
use App\Models\Transport;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Http\Response;
class TransportsController extends Controller
{
    public function index(){
        $car_types= CarType::all();
        return view('transport.transport',compact('car_types'));
    }

    public function TransportRequest(TransportRequest $request)
    {
        try {
            $newItem = new Transport($request->validated());
            $newItem->save();
            //sendMail
            $debug = true;
            try {
                // create folder for request
                $folderName = 'Transport'.'('. $newItem->Firma.')';
                $mail = MailHelper::sendMail($folderName, 'transport', $debug, $request->input('email'), $newItem,'Ihre Anfrage zum bevorstehende Umzug mit der Domain');
            } catch (Exception $e) {
                return Response::json(['error' => 'Message could not be processed. Error: ' . $e->getMessage()], 500);
            }
            return Response::json(200);
        } catch (Exception $e) {
            return Response::json(['error' => 'Message could not be processed. Error: ' . $e->getMessage()], 500);
        }
    }
}
