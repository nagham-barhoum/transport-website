<php use App\Models\Entsorgung; ?>

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
                width: 600px;
                height: 100px;
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
                height: fit-content;
            }
            .Anfrage1 .box {
                padding: 20px;
                flex-flow: row;
                border: 1px solid rgb(228, 229, 230);
                background-color: rgb(245, 248, 249);
                width: 100%;
                display: block;
            }
        </style>
    </head>

    <body>
        <div class="">
            <img src="{{ public_path('umzugefiles/logo.jpg') }}" alt="Logo" class="logo">
        </div>
        <!--   <h1>Invoice</h1> -->

        <div class="">
            <p style="float: right;margin-right: 10px">Entrümpelung </p>
            <p>{{ $entsorgung['vorname'] }} {{ $entsorgung['name'] }}</p>
            <p>Ihre Telefonnr.: {{ $entsorgung['telefon'] }} </p>
            <p>Ihre Whatsapp.: {{ $entsorgung['whatsapp'] }} </p>
            <br>
            <br>
        </div>


        <div class="Anfrage">
            <div style="float: left;margin-left: 10px">
                <p> <strong>Anfrage - Nr: {{ $entsorgung['id'] }} </strong></p>
            </div>
            <div style="float: right;margin-right: 10px">
                <p> <strong>vom: {{ date('Y-m-d H:i') }}</strong></p>
            </div>
        </div>
        <br>

        <div class="Anfrage1">
            <div  class='box' style="float: left">
                <p> <strong>welche bbjektart soll entrümpelt werden: </strong>{{ $entsorgung->welche_bbjektart_soll_entrümpelt_werden }}</p>
                <p> <strong>Zusatzarbeiten styroporplatten number: </strong>{{ $entsorgung->Zusatzarbeiten_styroporplatten_number }}</p>
            </div>
        </div>

        <div>
            <p></p>
        </div>
        <br>

        <div class="Anfrage">
            <div style="float: left;margin-left: 10px">
                <p> <strong>Terminangaben</strong></p>
            </div>
        </div>
        <br>
        <p>
            {{ $entsorgung['kommentare'] }}
        </p>

    </body>

    </html>
