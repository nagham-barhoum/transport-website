<!DOCTYPE html>
@include('layout.blogimport')
    <meta name="description" content="{{ $blog['desc'] }}">
    <meta name="keywords" content="{{ $blog['keywords'] }}">
    <meta property="og:title" content="{{ $blog['og_title'] }}" />
<meta property="og:description" content="{{ $blog['og_desc'] }}" />
<meta property="og:url" content="{{ $blog['og_url'] }}" />
<meta property="og:type" content="{{ $blog['og_type'] }}" />
<meta property="og:image" content="{{ $blog['og_image'] }}" />

<meta name="twitter:card" content="{{ $blog['twitter_card'] }}" />
<meta name="twitter:title" content="{{ $blog['twitter_title'] }}" />
<meta name="twitter:description" content="{{ $blog['twitter_desc'] }}" />
<meta name="twitter:image" content="{{ $blog['twitter_image'] }}" />
<meta name="twitter:url" content="{{ $blog['twitter_url'] }}" />

<link rel="canonical" href="{{ $blog['og_url'] }}" />
    <title>{{ $blog['title'] }}</title>
<body>
    <!-- ======= Header ======= -->

    @include('layout.entsorgungheader')
    <!-- ======= Footer ======= -->
    @include('layout.newfooter')
</body>
</html>
