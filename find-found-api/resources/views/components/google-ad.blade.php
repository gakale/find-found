@props(['slot' => 'default'])

<div class="google-ad my-4">
    @if(config('services.google.adsense.enabled'))
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="{{ config('services.google.adsense.client') }}"
             data-ad-slot="{{ $slot }}"
             data-ad-format="auto"
             data-full-width-responsive="true"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    @endif
</div>
