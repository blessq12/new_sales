@extends('layouts.main')

@section('title', $service->name)
@section('description', $service->description)

@section('content')
    <section class="py-5">
        <div class="container">
            <h1 class="fw-bold">{{ $service->name }}</h1>
            <p>{{ $service->description }}</p>

            <img src="{{ Storage::disk('uploads')->url($service->image) }}" alt="{{ $service->name }}">
        </div>
    </section>
    <section class="py-5">
        <div class="container">
            {!! $service->content !!}
        </div>
    </section>
@endsection
