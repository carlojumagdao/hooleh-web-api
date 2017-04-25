<!DOCTYPE html>
<html>
    <head>
        <title>Successful Payment</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: black;
                display: table;
                font-weight: bold;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
                color: black;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Payment Successful!</div>
                <p><b>Confirmation Number: {{$strConfirmationNumber}}</b></p>
            </div>
            <div><b>
                <a href='{{ URL::to("portal/driver/$driverID") }}' type="button" class="btn btn-primary">
                    Back to Driver's Page
                </a>
                </b>
            </div>
        </div>
    </body>
</html>
