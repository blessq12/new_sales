@props(['type' => 'Organization'])

@if ($type === 'Organization')
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "LocalBusiness",
      "name": "{{ $company->name }}",
      "legalName": "ООО Салес",
      "description": "{{ $company->description }}",
      "url": "{{ $company->website }}",
      "logo": "{{ $company->logo }}",
      "image": "{{ $company->logo }}",
      "telephone": {{ json_encode($company->phones) }},
      "email": {{ json_encode($company->emails) }},
      "address": [
        @foreach($company->addresses as $index => $address)
        {
          "@type": "PostalAddress",
          "streetAddress": "{{ $address }}",
          "addressLocality": "Томск",
          "addressRegion": "Томская область",
          "postalCode": "634003",
          "addressCountry": "RU"
        }@if(!$loop->last),@endif
        @endforeach
      ],
      "areaServed": {
        "@type": "GeoCircle",
        "geoMidpoint": {
          "@type": "GeoCoordinates",
          "latitude": "56.5010",
          "longitude": "84.9924"
        },
        "geoRadius": "300000"
      },
      "serviceArea": {
        "@type": "GeoCircle",
        "geoMidpoint": {
          "@type": "GeoCoordinates",
          "latitude": "56.5010",
          "longitude": "84.9924"
        },
        "geoRadius": "300000"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": "56.5010",
        "longitude": "84.9924"
      },
      "openingHoursSpecification": [
        {
          "@type": "OpeningHoursSpecification",
          "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
          "opens": "09:00",
          "closes": "18:00"
        },
        {
          "@type": "OpeningHoursSpecification",
          "dayOfWeek": ["Saturday", "Sunday"],
          "opens": "10:00",
          "closes": "16:00"
        }
      ],
      "sameAs": [
        "{{ $company->socials['vk']['url'] }}",
        "{{ $company->socials['ok']['url'] }}",
        "{{ $company->socials['youtube']['url'] }}",
        "{{ $company->socials['facebook']['url'] }}",
        "{{ $company->socials['instagram']['url'] }}"
      ],
      "priceRange": "₽₽",
      "paymentAccepted": ["Cash", "Credit Card"],
      "currenciesAccepted": "RUB",
      "contactPoint": [
        {
          "@type": "ContactPoint",
          "telephone": "{{ $company->phones[0] }}",
          "contactType": "customer service",
          "areaServed": "RU",
          "availableLanguage": ["Russian"]
        },
        {
          "@type": "ContactPoint",
          "telephone": "{{ $company->phones[1] }}",
          "contactType": "emergency service",
          "areaServed": "RU",
          "availableLanguage": ["Russian"]
        }
      ]
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
