<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <link
        href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;600;700&family=Work+Sans:wght@600&display=swap"
        rel="stylesheet">
    {{-- Scripts e Stylesheet nativos --}}
    <style>
        .email-content {
            display: block;
            width: 100%;
            height: 100%;
            background-color: #222222;
            color: #FFF;
            margin: 0 auto;
            margin-bottom: 2rem;
            margin-top: 2rem;
            padding: 1rem;
        }

        .img-container {
            margin: 0 auto;
        }

        .email-content .img-container img {
            display: block;
            text-align: center;
            width: 300px;
            margin: 0 auto;
        }

        .container-content h1{
            display: block;
            text-align: center;
        }

        .contato-content {
            display: block;
            margin-top: 3rem;
            margin-bottom: 3rem;
            width: 800px;
            max-width: 100%;
            padding: 1rem;
            background-color: #FFF;
            border-radius: 10px;
            color: #000;
            margin: 0 auto;
        }

        .row-content {
            display: block;
            padding: .5rem;
            margin: 0 auto;
        }

        .row-content p,
        .row-content h1,
        .row-content h2,
        .row-content div,
        .row-content a {
            width: fit-content;
            max-width: 100%;
            margin: 0 auto;
            text-align: center;
        }

        .tiny-text p {
            color: #C83C3C;
        }

        .tiny-text #emailReply {
            text-decoration: underline;
        }

        h1 {
            font-family: 'Quicksand', sans-serif;
        }

        p,
        a {
            font-family: 'Work Sans', sans-serif;
        }


        h2 {
            font-family: 'Quicksand', sans-serif;
        }
    </style>
</head>

<body class="email-content">
    <div class="img-container">
        <img src="https://new-peripherals.s3.amazonaws.com/logo-peripherals.jpeg" alt="Logo Peripherals">

    </div>

    <div class="container-content">
        <h1>{{ $nome }}</h1>

        <div class="contato-content">
            <div class="row-content">
                <h2>{{ $email }}</h2>
            </div>

            <div class="row-content">
                <h2>{{ $assunto }}</h2>
            </div>

            <div class="row-content">
                <p>{{ $mensagem }}</p>
            </div>

            <div class="row-content tiny-text">
                <p id="emailReply">{{ $email }}</p>
                <p>{{ $nome }}</p>
            </div>
        </div>
    </div>

</body>

</html>
