<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Vitra consultation</title>
    <style>
        /* Inline styles for simplicity, consider using CSS classes for larger templates */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f1f1f1;
        }

        .title {
            text-align: center;
            margin-bottom: 20px;
        }


        .message {
            padding: 20px;
            background-color: #ffffff;
        }

        .message p {
            margin-bottom: 10px;
        }


    </style>
</head>

<body>
<div class="container">

    <div class="message">
        <h2 class="title">SOLICITĂ O CONSULTANȚĂ</h2>
        <p>From {{ $mailData['name'] }}</p>
        <p>Email: {{ $mailData['email'] }}</p>
        <p>Phone: {{ $mailData['phone'] }}</p>
        <p>Message: {{ $mailData['message'] }}</p>

    </div>

</div>
</body>

</html>