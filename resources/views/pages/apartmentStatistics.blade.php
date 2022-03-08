@foreach ($filteredMessages as $message)
    {{$message->id}}
    {{$message->text}} <br>
@endforeach