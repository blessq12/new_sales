<div class="bg-cover bg-center py-20 relative" style="background-image: url('{{ $image }}');">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="container mx-auto">
        <nav class="mb-4 relative text-white">
            <ol class="list-reset flex">
                <li>
                    <a href="/" class="text-white hover:underline space-x-2">
                        <i class="mdi mdi-home"></i>
                        Главная
                    </a>
                </li>
                &nbsp;/&nbsp;
                @foreach($breadcrumbs as $breadcrumb)
                    <li>
                        <a href="{{ $breadcrumb['url'] }}" class="text-white hover:underline">{{ $breadcrumb['title'] }}</a>
                        @if (!$loop->last)
                            <span class="mx-2">/</span>
                        @endif
                    </li>
                @endforeach
            </ol>
        </nav>
        <div class="text-left max-w-2xl text-white relative">
            <h1 class="text-4xl font-bold mb-4">{{ $title }}</h1>
            <p class="text-lg">{{ $description }}</p>
        </div>
    </div>
</div> 