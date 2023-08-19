<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name')}}</title>
</head>
<style>
    .button {
        background-color: #3d78e3; /* Green */
        border: none;
        color: white;
        padding: 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 12px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 5px;
    }
</style>
<body>
<div class="container-fluid">
    <div class="row">
        <table class="text-center">
            <tr>
                <td>Dear Mr/Mrs : <strong>{{$ticket->user->name}}</strong></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Welcome to {{config('app.name')}}.
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Your Ticket Reply Is : {{$ticket->ticket_reply}}</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Thanks & Regard,</td>
            </tr>
            <tr>
                <td>{{config('app.name')}}</td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>
