{{-- @foreach ($filteredMessages as $message)
    {{$message->id}}
    {{$message->text}} <br>
@endforeach --}}

messaggi : {{ count($filteredMessages) }}
<br>
visite: {{$apartment->views}}