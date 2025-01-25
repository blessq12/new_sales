<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('main.index') }}">Главная</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('main.about') }}">О нас</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('main.certificates') }}">Сертификаты</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('main.services') }}">Услуги</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('main.contacts') }}">Контакты</a></li>
            </ul>
        </div>
    </div>
</nav>
