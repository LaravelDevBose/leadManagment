@include('emails.include.head')
@include('emails.include.header')

<div class="content">
    <p>{{ $inbox->mail_body }}</p>
    @if(!empty($inbox->mail_attachments) && count($inbox->mail_attachments) > 0)
    <hr>
    <ul>
        @foreach($inbox->mail_attachments as $attachment)
        <li><a href="{{ asset('storage/'.$attachment['path']) }}" download style="text-decoration: underline; color: #f89635;"> {{ $attachment['file_name'] }}</a></li>
        @endforeach
    </ul>
    @endif
</div>
@include('emails.include.footer')
