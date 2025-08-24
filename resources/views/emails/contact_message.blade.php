<p>Ada pesan baru dari form kontak:</p>

<p><strong>Nama:</strong> {{ $messageModel->nama }}</p>
<p><strong>Email:</strong> {{ $messageModel->email }}</p>
<p><strong>Subjek:</strong> {{ $messageModel->subject }}</p>

<p><strong>Pesan:</strong><br>
{!! nl2br(e($messageModel->pesan)) !!}</p>

@if(isset($messageModel->recaptcha_score))
  <p style="color:#666;font-size:12px;">
    reCAPTCHA score: {{ $messageModel->recaptcha_score }}
  </p>
@endif
