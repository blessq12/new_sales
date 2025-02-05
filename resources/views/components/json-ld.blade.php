@props(['type' => 'Organization'])

@if($type === 'Organization')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "{{ config('app.name') }}",
    "url": "{{ url('/') }}",
    "logo": "{{ Storage::disk('assets')->url('images/logo.png') }}",
    "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "{{ config('company.phone') }}",
        "contactType": "customer service"
    }
}
</script>
@endif

@if($type === 'WebPage')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebPage",
    "name": "@yield('title')",
    "description": "@yield('description')",
    "url": "{{ url()->current() }}"
}
</script>
@endif
