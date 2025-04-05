<!-- Подключаем Font Awesome для иконок -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<div class="dashboard-container">
    <div class="stats-grid">
        <div class="stats-card services">
            <div class="stats-icon">
                <i class="fas fa-tools"></i>
            </div>
            <div class="stats-info">
                <h3>Услуги</h3>
                <p class="stats-number">{{ $services->count() }}</p>
            </div>
        </div>

        <div class="stats-card services">
            <div class="stats-icon">
                <i class="fas fa-tools"></i>
            </div>
            <div class="stats-info">
                <h3>Категории услуг</h3>
                <p class="stats-number">{{ $categories->count() }}</p>
            </div>
        </div>

        <div class="stats-card orders">
            <div class="stats-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="stats-info">
                <h3>Заказы</h3>
                <p class="stats-number">{{ $orders->count() }}</p>
            </div>
        </div>

        <div class="stats-card reviews">
            <div class="stats-icon">
                <i class="fas fa-star"></i>
            </div>
            <div class="stats-info">
                <h3>Отзывы</h3>
                <p class="stats-number">{{ $reviews->count() }}</p>
            </div>
        </div>
    </div>
    <div class="stats-section analytics">
        <h2 class="section-title">Статистика посещений</h2>
        <div class="analytics-grid">
            <div class="analytics-card">
                <div class="analytics-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="analytics-info">
                    <h4>Посетители</h4>
                    <p class="analytics-number">{{ $metrics->todayVisits }}</p>
                    <span class="analytics-label">визитов сегодня</span>
                </div>
            </div>

            <div class="analytics-card">
                <div class="analytics-icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="analytics-info">
                    <h4>Уникальные посетители</h4>
                    <p class="analytics-number">{{ $metrics->todayUsers }}</p>
                    <span class="analytics-label">пользователей сегодня</span>
                </div>
            </div>

            <div class="analytics-card">
                <div class="analytics-icon">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="analytics-info">
                    <h4>Просмотры</h4>
                    <p class="analytics-number">{{ $metrics->todayPageviews }}</p>
                    <span class="analytics-label">просмотров страниц</span>
                </div>
            </div>

            <div class="analytics-card">
                <div class="analytics-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <div class="analytics-info">
                    <h4>Новые посетители</h4>
                    <p class="analytics-number">{{ $metrics->todayPercentNewVisitors }}%</p>
                    <span class="analytics-label">от общего числа</span>
                </div>
            </div>

            <div class="analytics-card">
                <div class="analytics-icon">
                    <i class="fas fa-sign-out-alt"></i>
                </div>
                <div class="analytics-info">
                    <h4>Отказы</h4>
                    <p class="analytics-number">{{ $metrics->todayBounceRate }}%</p>
                    <span class="analytics-label">показатель отказов</span>
                </div>
            </div>

            <div class="analytics-card">
                <div class="analytics-icon">
                    <i class="fas fa-book-open"></i>
                </div>
                <div class="analytics-info">
                    <h4>Глубина просмотра</h4>
                    <p class="analytics-number">{{ $metrics->todayPageDepth }}</p>
                    <span class="analytics-label">страниц за визит</span>
                </div>
            </div>

            <div class="analytics-card">
                <div class="analytics-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="analytics-info">
                    <h4>Время на сайте</h4>
                    <p class="analytics-number">{{ $metrics->todayAvgVisitDurationSeconds }}</p>
                    <span class="analytics-label">среднее время визита</span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .dashboard-container {
        padding: 1rem 18px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .dashboard-title {
        font-size: 2rem;
        color: #2c3e50;
        margin-bottom: 2rem;
        font-weight: 600;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
        gap: 1.5rem;
    }

    .stats-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        display: flex;
        flex: 1;
        align-items: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .stats-icon {
        background: #f8f9fa;
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1.5rem;
    }

    .stats-icon i {
        font-size: 1.5rem;
    }

    .services .stats-icon {
        color: #2ecc71;
    }

    .orders .stats-icon {
        color: #3498db;
    }

    .reviews .stats-icon {
        color: #f1c40f;
    }

    .stats-info h3 {
        margin: 0;
        font-size: 1.1rem;
        color: #7f8c8d;
        font-weight: 500;
    }

    .stats-number {
        margin: 0.5rem 0 0;
        font-size: 1.8rem;
        font-weight: 600;
        color: #2c3e50;
    }

    .stats-section {
        margin-top: 2rem;
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .section-title {
        font-size: 1.5rem;
        color: #2c3e50;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #e9ecef;
    }

    .analytics-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 1.25rem;
        padding: 0.5rem 0.25rem;
    }

    .analytics-card {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 1.25rem;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        flex: 0 0 250px;
        scroll-snap-align: start;
    }

    .analytics-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .analytics-icon {
        color: #3498db;
        margin-bottom: 1rem;
    }

    .analytics-icon i {
        font-size: 1.75rem;
    }

    .analytics-info h4 {
        margin: 0;
        font-size: 1rem;
        color: #7f8c8d;
        font-weight: 500;
    }

    .analytics-number {
        margin: 0.5rem 0;
        font-size: 1.5rem;
        font-weight: 600;
        color: #2c3e50;
    }

    .analytics-label {
        font-size: 0.875rem;
        color: #95a5a6;
    }

    @media (max-width: 768px) {
        .dashboard-container {
            padding: 1rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .stats-card {
            padding: 1rem;
        }

        .stats-icon {
            width: 50px;
            height: 50px;
        }

        .stats-number {
            font-size: 1.5rem;
        }

        .analytics-grid {
            padding: 0.5rem 0;
        }

        .analytics-card {
            padding: 1rem;
            flex: 0 0 200px;
        }
    }
</style>
