Thank you for your registration.

Please use the token below to verify your account or click <a href="{{ url()->route('activate', [
    'token' => $activation_token
]) }}">here</a>.

<br><br>

<b>Token:</b> {{ $activation_token }}
