@extends('layouts.main')

@section('title', $service->name)
@section('description', $service->description)

@section('content')
    <x-hero-banner
        :image="Storage::disk('uploads')->url($service->image)"
        :title="$service->name"
        :description="$service->description"
        :breadcrumbs="[
            ['title' => 'Услуги', 'url' => route('services')],
            ['title' => $service->name, 'url' => route('services.show', $service->slug)],
        ]"
    ></x-hero-banner>

    <section class="py-20">
        <section class="py-5">
        <div class="container mx-auto">
            {!! $service->content !!}
        </div>
    </section>
    
@endsection
