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
                color: #B0BEC5;
                display: table;
                font-weight: 100;
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
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Payment Successful!</div>
                <p>Confirmation Number: {{$strConfirmationNumber}}</p>
            </div>
            <div>
                <a href='{{ URL::to("portal/driver/$driverID") }}' type="button" class="btn btn-primary">
                    Back to Driver's Page
                </a>
            </div>
        </div>
    </body>
</html>
