<php use App\Models\Transport; ?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Invoice</title>
        <style type="text/css">
            /* CSS for styling the invoice */
            table {
                border-collapse: collapse;
                width: 100%;
            }

            th,
            td {
                border: 1px solid black;
                padding: 8px;
            }

            th {
                text-align: left;
            }

            /* added styles */
            .logo {
                display: block;
                width: 600px;
                height: 100px;
                margin: auto;
            }

            .Anfrage {
                border-style: ridge;
                height: 50px;
            }
            .Anfrage1 {
                padding-block: 20px !important;
                width: 100%;
                flex-direction: row;
                flex-wrap: wrap;
                display: flex !important;
                justify-content: space-between;
                align-items: center;
                height: 350px;
            }
            .Anfrage1 .box {
                padding: 20px;
                flex-flow: row;
                border: 1px solid rgb(228, 229, 230);
                background-color: rgb(245, 248, 249);
                width: 40%;
                display: block;
            }
            .carType{
                display: block;
                margin: auto;
                position: relative;
                width: 50%;
                border: 1px solid rgb(228, 229, 230);
                background-color: rgb(245, 248, 249);
                padding: 10px
            }
            .carType .price{
                position: absolute;
                top:10px;
                right:10px;
            }
        </style>
    </head>

    <body>
        <div class="invoice-header">
            <img src="{{ public_path('umzugefiles/logo.jpg') }}" alt="Logo" class="logo">
        </div>
        <!--   <h1>Invoice</h1> -->

        <div class="header">
            <p style="float: right;margin-right: 10px">TRANSPORT </p>
            <p>Firma: {{ $transport['Firma'] }} , Ansprechpartner: {{ $transport['Ansprechpartner'] }}</p>
            <p>Ihre Telefonnr.: {{ $transport['telefon'] }} </p>
            <p>Ihre Email.: {{ $transport['email'] }} </p>
        </div>

        <div class="Anfrage">
            <div style="float: left;margin-left: 10px">
                <p> <strong>Anfrage - Nr: {{ $transport['id'] }} </strong></p>
            </div>
            <div style="float: right;margin-right: 10px">
                <p> <strong>vom: {{ date('Y-m-d H:i') }}</strong></p>
            </div>
        </div>
        <br>

        <div class="Anfrage1">
            <div  class='box' style="float: left">
                <p> <strong>Anzahl: </strong>{{ $transport->Anzahl }}</p>
                <p> <strong>Bitte wählen: </strong>{{ $transport->Bitte }}</p>
                <p> <strong>Abmessungen: </strong>{{ $transport->Abmessungen }}</p>
                <p> <strong>Gewicht: </strong>{{ $transport->Gewicht }}</p>
                <p> <strong>Warenwert: </strong>{{ $transport->Warenwert }}</p>
                <p> <strong>Warendetails: </strong>{{ $transport->Warendetails }}</p>
            </div>

            <div  class='box' style="float: right">
                <p> <strong>Ladestelle: </strong>{{ $transport->Ladestelle}}</p>
                <p> <strong>Abholdatum: </strong>{{ $transport->Abholdatum }}</p>
                <p> <strong>Liefertermin: </strong>{{ $transport->Liefertermin }}</p>
                <p> <strong>Entladestelle: </strong>{{ $transport->Entladestelle }}</p>
                <p> <strong>Bemerkungen_Uhrzeiten: </strong>{{ $transport->Bemerkungen_Uhrzeiten }}</p>
            </div>
        </div>
        <br/>
        <div class="w-100 d-block">
            <p>für Ihre Anfrage und das uns entgegengebrachte Vertrauen möchten wir uns herzlich bedanken.
                Nachfolgend erhalten Sie eine Aufstellung Ihrer getätigten Angaben, auf deren Basis wir Ihnen ein
                Angebot
                unterbreiten.
            </p>
        </div>
        <br/>

        <div class="Anfrage">
            <div style="float: left;margin-left: 10px">
                <p> <strong>Terminangaben</strong></p>
            </div>
        </div>
        <br/>
        <div class="carType">
            <p><strong>Name:</strong> {{ $transport->car_type->name }}</p>
            @if($transport->car_type->space != null)
            <p><strong>Maße:</strong> {{ $transport->car_type->space }}</p>
            @endif
            @if($transport->car_type->weight != null)
            <p><strong>Nutzlast:</strong>MAX. {{ $transport->car_type->weight }}kg</p>
            @endif
            <p class="price">{{ $transport->car_type->price }}</p>
            <p>{{ $transport->car_type->desc }}</p>
        </div>
    </body>

    </html>
