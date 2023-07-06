<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>URL Shortener</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/shorten.js') }}"></script>
</head>
<body>
<h1>URL Shortener</h1>

<form id="shortenForm" method="post">
    @csrf
    <input type="text" id="urlInput" placeholder="Enter URL">
    <button type="submit">Shorten</button>
</form>

<p id="shortenedUrl"></p>

<h2>Last 10 shortened URLs:</h2>
<ul>
    @foreach ($urls as $url)
        <li>{{ $url->full }} - {{ $url->short }}</li>
    @endforeach
</ul>
</body>
</html>
