@if ($tagId = env('GOOGLE_TAG_ID'))
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-S6Y2TML1Q1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', '{{ $tagId }}');
  </script>
@endif

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name', 'Podcard.co') }}</title>
<link rel="shortcut icon" href="/favicon.png"/>

<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="@gettingtoramen" />
<meta name="twitter:image" content="https://jads.s3-us-west-2.amazonaws.com/podcard/screely-transistor.png" />

<meta property="og:type" content="url">
<meta property="og:title" content="{{ config('app.name', 'Podcard.co') }} - Customizable embeddable podcast player">
<meta property="og:description" content="A beautiful brandable podcast player that you can easily embed on your website." />
<meta property="og:url" content="https://podcard.co">
<meta property="og:image" content="https://jads.s3-us-west-2.amazonaws.com/podcard/screely-transistor.png">

@vite('resources/js/app.js')
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
