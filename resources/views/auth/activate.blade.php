<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <div id="app">

        <div class="row w-50 m-auto align-items-center justify-content-center mt-5">
            <h1 class="text-center">
                @if(!$activated)
                Activate account
                @else
                Account activated
                @endif
            </h1>

            <div class="d-flex justify-content-center">

                @if(!$activated)
                <form class="form-control" method="GET" {{ route('activate') }}>
                    <div class="mb-3">
                        <label for="token" class="form-label fw-bold">Token</label>
                        <input type="text" class="form-control" id="token" name="token" placeholder="Please enter your verification token">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success w-100">Verify Account</button>
                    </div>

                    <p>Already have an account? Click <a href="/login">here</a> to login</p>
                </form>
                @else
                <p>Your account has been activated. You can login <a href="/login">here</a>.</p>
                @endif
            </div>
        </div>
    </div>
</body>

