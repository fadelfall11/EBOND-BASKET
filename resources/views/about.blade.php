@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <div class="animate-fade-in-up">
            <h1 class="hero-title">
                Notre <span style="color: #fbbf24;">Histoire</span>
            </h1>
            <p class="hero-subtitle">
                Découvrez l'histoire et les valeurs qui font notre excellence
            </p>
        </div>
    </div>
</section>

<!-- Story Section -->
<section class="section">
    <div class="container">
        <div style="max-width: 900px; margin: 0 auto;">
            @foreach([
                [
                    'icon' => 'fas fa-basketball-ball',
                    'title' => 'Les Origines',
                    'content' => "EBOND est une école de basket née d'une vision simple mais puissante : offrir aux jeunes Sénégalais une formation de qualité dans un sport qui allie discipline, teamwork et excellence. Notre école a été créée pour développer les talents et former les champions de demain."
                ],
                [
                    'icon' => 'fas fa-trophy',
                    'title' => 'La Croissance',
                    'content' => "Dès ses débuts avec seulement <strong>15 jeunes passionnés</strong> dans un quartier de Dakar, l'école a connu une croissance remarquable. Grâce à des méthodes d'entraînement innovantes et une approche holistique du développement, nous sommes rapidement devenus une référence au Sénégal. Aujourd'hui, nous accueillons plus de <strong>120 jeunes</strong> répartis dans <strong>8 catégories</strong> différentes, des débutants aux seniors."
                ],
                [
                    'icon' => 'fas fa-star',
                    'title' => 'Les Réalisations',
                    'content' => "Au fil des années, notre école a formé des dizaines de talents qui ont intégré des clubs professionnels au Sénégal, en Europe et même en <strong>NBA</strong>. Nous avons remporté de nombreux tournois nationaux et internationaux, mais notre plus grande fierté reste le développement personnel de chacun de nos joueurs. Nos valeurs de respect, de discipline et d'engagement sont au cœur de notre succès."
                ],
                [
                    'icon' => 'fas fa-eye',
                    'title' => 'Notre Vision',
                    'content' => "Notre vision est de devenir la <strong>meilleure école de basketball d'Afrique</strong>, non seulement en termes de performance sportive, mais aussi en tant que centre de développement humain. Nous voulons continuer à former non seulement d'excellents joueurs, mais aussi des <strong>leaders de demain</strong> qui porteront haut les couleurs du Sénégal sur et en dehors des terrains."
                ]
            ] as $story)
                <div class="card" style="margin-bottom: 2rem;">
                    <div class="card-content">
                        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                            <div class="stat-icon" style="margin: 0;">
                                <i class="{{ $story['icon'] }}"></i>
                            </div>
                            <h2 style="font-size: 2rem; font-weight: 800; color: #1e293b;">{{ $story['title'] }}</h2>
                        </div>
                        <p style="font-size: 1.125rem; line-height: 1.8; color: #475569;">
                            {!! $story['content'] !!}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="section" style="background: #f8fafc;">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Nos Valeurs</h2>
            <p class="section-subtitle">
                Les principes qui guident notre action chaque jour
            </p>
        </div>
        
        <div class="stats-grid">
            @foreach([
                ['icon' => 'fas fa-heart', 'title' => 'Passion', 'desc' => "L'amour du basketball comme moteur de notre engagement quotidien"],
                ['icon' => 'fas fa-graduation-cap', 'title' => 'Excellence', 'desc' => 'La recherche constante de la perfection technique et humaine'],
                ['icon' => 'fas fa-users', 'title' => 'Solidarité', 'desc' => "L'esprit d'équipe et le soutien mutuel comme fondement"],
                ['icon' => 'fas fa-medal', 'title' => 'Intégrité', 'desc' => "Le respect des règles et l'honnêteté dans toutes nos actions"]
            ] as $value)
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="{{ $value['icon'] }}"></i>
                    </div>
                    <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 0.75rem; color: #1e293b;">{{ $value['title'] }}</h3>
                    <p style="color: #64748b; line-height: 1.6;">{{ $value['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Coaches Section -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Notre Équipe d'Encadrement</h2>
            <p class="section-subtitle">
                Des coachs expérimentés passionnés par la formation des jeunes talents
            </p>
        </div>
        
        <div class="cards-grid">
            @forelse ($coaches as $coach)
                <div class="card">
                    <div class="card-image" style="height: 350px; padding: 0; overflow: hidden; position: relative;">
                        @if($coach->photo)
                            <img src="{{ asset('storage/' . $coach->photo) }}" alt="{{ $coach->prenom }} {{ $coach->nom }}" 
                                 style="width: 100%; height: 100%; object-fit: cover; {{ $coach->photo_style }}">
                        @else
                            <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #2563eb, #3b82f6); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-user-tie" style="font-size: 5rem; color: rgba(255,255,255,0.5);"></i>
                            </div>
                        @endif
                    </div>
                    <div class="card-content" style="text-align: center;">
                        <h3 class="card-title" style="margin-bottom: 0.5rem;">{{ $coach->prenom }} {{ $coach->nom }}</h3>
                        <div style="margin-bottom: 1rem;">
                            <span class="badge" style="background: #e0f2fe; color: #0284c7; padding: 0.25rem 0.75rem; border-radius: 9999px; font-weight: 600; font-size: 0.875rem;">
                                {{ $coach->specialite }}
                            </span>
                        </div>
                        <div style="display: flex; align-items: center; justify-content: center; gap: 0.5rem; margin-bottom: 1.5rem; color: #64748b;">
                            <i class="fas fa-award" style="color: #fbbf24;"></i>
                            <span>{{ $coach->experience }} ans d'expérience</span>
                        </div>
                        <p class="card-text" style="text-align: left;">{{ Str::limit($coach->bio, 120) }}</p>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 4rem 2rem;">
                    <div style="width: 80px; height: 80px; background: #e2e8f0; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                        <i class="fas fa-users" style="font-size: 2rem; color: #94a3b8;"></i>
                    </div>
                    <p style="color: #64748b;">Notre équipe de coachs sera bientôt disponible.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="hero" style="padding: 6rem 0;">
    <div class="container">
        <div style="text-align: center; max-width: 800px; margin: 0 auto;">
            <h2 style="font-size: clamp(2rem, 4vw, 3rem); font-weight: 800; color: white; margin-bottom: 1.5rem;">
                Rejoignez notre famille !
            </h2>
            <p style="font-size: 1.25rem; color: rgba(255, 255, 255, 0.9); margin-bottom: 2.5rem;">
                Que vous soyez débutant ou joueur confirmé, nous avons une place pour vous
            </p>
            <div class="hero-buttons" style="justify-content: center;">
                <a href="{{ route('categories.index') }}" class="btn-white">
                    <i class="fas fa-users"></i>
                    Découvrir nos catégories
                </a>
                <a href="mailto:contact@ebond.sn" class="btn-outline">
                    <i class="fas fa-envelope"></i>
                    Nous contacter
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
