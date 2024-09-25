@props(['messages'])

@if ($messages)
    <div class="popup">
        @foreach ((array) $messages as $message)
            <p>{{ $message }}</p>
        @endforeach
    </div>
@endif
