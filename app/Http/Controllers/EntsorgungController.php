<?php

namespace App\Http\Controllers;

use App\Helper\MailHelper;
use App\Http\Requests\EntsorgungRequest;
use App\Models\Entsorgung;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class EntsorgungController extends Controller
{

    public function EntsorgungV2Request(EntsorgungRequest $request)
    {
        try {
            $valid = $request->validated();
            $valid['Zusatzarbeiten_deckenleuchten']  =   $request->input('Zusatzarbeiten_deckenleuchten_gardinen_leisten') == "true" ? 1 : 0;
            $valid['Zusatzarbeiten_dubellocher_v']  =   $request->input('Zusatzarbeiten_dubellocher_verschlieben') == "true" ? 1 : 0;
            $valid['Zusatzarbeiten_bisEndreinigung']  =   $request->input('Zusatzarbeiten_bisEndreinigung_25_meter') == "true" ? 1 : 0;
            $valid['Zusatzarbeiten_holzdecke_mit']  =   $request->input('Zusatzarbeiten_holzdecke_mit_unterkonstruktion_entfernen') == "true" ? 1 : 0; // bool
            $valid['Zusatzarbeiten_styroporplatten']  =   $request->input('Zusatzarbeiten_styroporplatten_entfernen') == "true" ? 1 : 0; // bool
            $newItem = new Entsorgung($valid);

            // $newItem['vorname'] =   $request->input('vorname');
            // $newItem['name']  =  $request->input('name');
            // $newItem['telefon']  =  $request->input('telefon');
            // $newItem['email']    =  $request->input('email');
            // $newItem['whatsapp']  =   $request->input('whatsapp');

            // $newItem['welche_bbjektart_soll_entrümpelt_werden']  =   $request->input('welche_bbjektart_soll_entrümpelt_werden') != "undefined" ? $request->input('welche_bbjektart_soll_entrümpelt_werden')  : "";

            // $newItem['postleitzahl_fur']  =   $request->input('postleitzahl_fur');
            // $newItem['grob_ist_ihre_zu']  =   $request->input('grob_ist_ihre_zu_raumende_flache');

            // $newItem['wie_schatzen_sie_den']  =   $request->input('wie_schatzen_sie_den_mobelierungsgrad_ein') != "undefined" ? $request->input('wie_schatzen_sie_den_mobelierungsgrad_ein')  : "";
            // $newItem['elevator']  =   $request->input('elevator')  != "undefined" ? $request->input('elevator')  : "";
            // $newItem['sollen_wir_eine']  =   $request->input('sollen_wir_eine_kuche_bei_ihnen_abbauen') != "undefined" ? $request->input('sollen_wir_eine_kuche_bei_ihnen_abbauen')  : "";
            // $newItem['laufwege']  =   $request->input('laufwege')  != "undefined" ? $request->input('laufwege')  : "";
            // $newItem['Zusatzarbeiten_deckenleuchten']  =   $request->input('Zusatzarbeiten_deckenleuchten_gardinen_leisten') == "true" ? 1 : 0;
            // $newItem['Zusatzarbeiten_dubellocher_v']  =   $request->input('Zusatzarbeiten_dubellocher_verschlieben') == "true" ? 1 : 0;
            // $newItem['Zusatzarbeiten_bisEndreinigung']  =   $request->input('Zusatzarbeiten_bisEndreinigung_25_meter') == "true" ? 1 : 0;
            // $newItem['Zusatzarbeiten_holzdecke_mit']  =   $request->input('Zusatzarbeiten_holzdecke_mit_unterkonstruktion_entfernen') == "true" ? 1 : 0; // bool
            // $newItem['Zusatzarbeiten_styroporplatten']  =   $request->input('Zusatzarbeiten_styroporplatten_entfernen') == "true" ? 1 : 0; // bool
            // $newItem['Zusatzarbeiten_holzdecke_number']  =   $request->input('Zusatzarbeiten_holzdecke_mit_unterkonstruktion_entfernen_number');
            // $newItem['Zusatzarbeiten_styroporplatten_number']  =   $request->input('Zusatzarbeiten_styroporplatten_entfernen_number');

            $newItem->save();

            //sendMail
            $debug = true;
            $folderName = 'entsorgung' . '(' . $newItem->name . ')';
            if($request->hasFile('files')){
                $mail = MailHelper::sendMail($folderName, 'entsorgung', $debug, $request->input('email'), $newItem,'Ihre Anfrage zum bevorstehende Umzug mit der Domain',$valid['files']);
            }else{
            $mail = MailHelper::sendMail($folderName, 'entsorgung', $debug, $request->input('email'), $newItem,'Ihre Anfrage zum bevorstehende Umzug mit der Domain',null);
            }
            return Response::json(200);

        } catch (Exception $e) {
            return Response::json(['error' => 'Message could not be processed. Error: ' . $e->getMessage()], 500);
        }
    }

    public function EntsorgungV2View(Request $request)
    {
        $id = $request->query('id'); // Alternatively, $request->get('id')

        $newItem = Entsorgung::find($id);

        $dataPdf = [
            'data'    => $newItem,
        ];
        // dd($dataPdf);
        return view('entsorgung/entsorgung', $dataPdf);
    }

    public function entsorgung()
    {
        $dataPdf = [
            'data'    => new Entsorgung,
        ];
        // dd($dataPdf);
        return view('entsorgung/entsorgung', $dataPdf);
    }
}
    // public function EntsorgungRequest(EntsorgungRequest $request)
    // {
    //     try {

    //         $newItem = new Entsorgung();

    //         $newItem['Kommentare']  =   $request->input('Kommentare');

    //         $newItem['vorname'] =   $request->input('vorname');
    //         $newItem['name']  =  $request->input('name');
    //         $newItem['telefon']  =  $request->input('telefon');
    //         $newItem['email']    =  $request->input('email');
    //         $newItem['whatsapp']  =   $request->input('whatsapp');

    //         $newItem->save();

    //         //sendMail
    //         $debug = true;
    //         try {

    //             // // create folder for request
    //             // $folderName = $newItem->id; // Change this to your desired folder name
    //             // $folderPath = public_path("Request/Entsorgung/$folderName");

    //             // if (!File::exists($folderPath))
    //             //     File::makeDirectory($folderPath, 0755, true);


    //             // // Create instance of PHPMailer class
    //             // $mail = new PHPMailer($debug);
    //             // if ($debug) {
    //             //     // issue a detailed log
    //             //     $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    //             // }
    //             // // Authentication with SMTP
    //             // $mail->isSMTP();
    //             // $mail->SMTPAuth = true;
    //             // // Login
    //             // $mail->Host = "smtp.de";
    //             // $mail->Port = 587;
    //             // $mail->Username = "Info@Domain.de";
    //             // $mail->Password = "";
    //             // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    //             // $mail->setFrom('Info@Domain.de', 'Transport');
    //             // // $mail->addAddress('@gmail.com');
    //             // $mail->addAddress($request->input('email'));

    //             // // CC
    //             // $mail->AddCC('Domain.@gmail.com');
    //             // // $mail-> addAttachment("/home/user/Desktop/sampleimage.png", "sampleimage.png");

    //             // // geneate pdf
    //             // $dataPdf = [
    //             //     'itemData'    => $newItem,
    //             // ];
    //             // //    return Response::json($dataPdf);

    //             // $pdf = Pdf::loadView('entsorgung/pdf/entsorgungPdf', $dataPdf);
    //             // // here the problem data bind


    //             // $pdf->save("{$folderPath}/$newItem->id.pdf");

    //             // $mail->addAttachment("{$folderPath}/$newItem->id.pdf", "Entsorgung");


    //             // $mail->CharSet = 'UTF-8';
    //             // $mail->Encoding = 'base64';
    //             // $mail->isHTML(true);
    //             // $mail->Subject = 'Ihre Anfrage zum bevorstehende Umzug mit der Domain';

    //             // $bodyView = view('entsorgung/email/entsorgung')->render();

    //             // $mail->Body = $bodyView;
    //             // // $mail->AltBody = 'The text as a simple text element';
    //             // $mail->send();
    //         } catch (Exception $e) {
    //         }


    //         return Response::json(200);

    //         // return redirect()->route('admin.index')->with(['success' => 'Post Successfully Created']);

    //     } catch (Exception $e) {
    //         return Response::json(['error' => 'Message could not be processed. Error: ' . $e->getMessage()], 500);
    //     }
    // }
