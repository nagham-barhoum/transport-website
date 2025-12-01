<php use App\Models\umzuge; ?>

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
        </style>
    </head>

    <body>
        <div class="invoice-header">
            <img src="{{ public_path('umzugefiles/logo.jpg') }}" alt="Logo" class="logo">
        </div>
        <!--   <h1>Invoice</h1> -->

        <div class="header">
            <p style="float: right;margin-right: 10px">UMZÜGE </p>
          
        </div>

        <div class="Anfrage">
            <div style="float: left;margin-left: 10px">
                <p> <strong>Anfrage - Nr: {{ $umzuge['id'] }} </strong></p>
            </div>
            <div style="float: right;margin-right: 10px">
                <p> <strong>vom: {{ date('Y-m-d H:i') }}</strong></p>
            </div>
        </div>

        <br>

        <div>
            <p>für Ihre Anfrage und das uns entgegengebrachte Vertrauen möchten wir uns herzlich bedanken.
                Nachfolgend erhalten Sie eine Aufstellung Ihrer getätigten Angaben, auf deren Basis wir Ihnen ein
                Angebot
                unterbreiten.
            </p>
        </div>
        <br>
        <table>
            <tr>
                <th>BELADESTELLE</th>
                <th>ENTLADESTELLE</th>
            </tr>
    
                <tr>
                    <td>{{ $umzuge['from_Strabe'] }} {{ $umzuge['from_Hausnr'] }}</td>
                    <td>{{ $umzuge['to_Strabe'] }} {{ $umzuge['to_Hausnr'] }}</td>
                </tr>
               
            {{-- @endif --}}
        </table>
        <br>
        <div class="Anfrage">
            <div style="float: left;margin-left: 10px">
                <p> <strong>Terminangaben</strong></p>
            </div>
        </div>
        {{-- <br> --}}
    </body>

    </html>
