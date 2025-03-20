@props(['type' => 'Organization'])

@if ($type === 'Organization')
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "LocalBusiness",
      "name": "{{ $company->name }}",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "{{ $company->address }}",
        "addressLocality": "{{ $company->city }}",
        "addressRegion": "{{ $company->region }}",
        "postalCode": "634021",
        "addressCountry": "RU"
      },
      "telephone": "{{ $company->phones[0] }}",
      "openingHours": "Mo-Su 09:00-18:00",
      "priceRange": "₽"
    }
    </script>
@endif

@if ($type === 'WebPage')
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
