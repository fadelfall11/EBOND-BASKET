@extends('layouts.app')

@section('content')
<section class="section">
    <div class="container">
        <div style="max-width: 1000px; margin: 0 auto;">
            <div style="display: flex; align-items: center; justify-content: space-between; gap: 1rem; flex-wrap: wrap; margin-bottom: 2rem;">
                <div>
                    <h2 class="section-title" style="margin-bottom: 0.25rem;">Administration</h2>
                    <p class="section-subtitle" style="margin: 0;">Gestion du contenu et des paramètres.</p>
                </div>
                <a href="{{ route('home') }}" class="btn-primary">
                    <i class="fas fa-home"></i>
                    Retour au site
                </a>
            </div>

            <div class="cards-grid">
                <div class="card">
                    <div class="card-content">
                        <h3 class="card-title" style="display:flex; align-items:center; gap:0.75rem;">
                            <i class="fas fa-newspaper" style="color:#2563eb;"></i>
                            Actualités
                        </h3>
                        <p class="card-text">Créer, modifier et supprimer les actualités.</p>
                        <div style="display:flex; gap:0.75rem; flex-wrap:wrap;">
                            <a href="{{ route('admin.actualites.index') }}" class="btn-primary">
                                Gérer
                                <i class="fas fa-arrow-right"></i>
                            </a>
                            <a href="{{ route('admin.actualites.create') }}" class="btn-outline" style="border:2px solid #2563eb; color:#2563eb; padding:0.75rem 1.5rem; border-radius:10px; text-decoration:none; display:inline-flex; align-items:center; gap:0.5rem;">
                                <i class="fas fa-plus"></i>
                                Ajouter
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-content">
                        <h3 class="card-title" style="display:flex; align-items:center; gap:0.75rem;">
                            <i class="fas fa-layer-group" style="color:#2563eb;"></i>
                            Catégories
                        </h3>
                        <p class="card-text">Créer, modifier et supprimer les catégories.</p>
                        <div style="display:flex; gap:0.75rem; flex-wrap:wrap;">
                            <a href="{{ route('admin.categories.index') }}" class="btn-primary">
                                Gérer
                                <i class="fas fa-arrow-right"></i>
                            </a>
                            <a href="{{ route('admin.categories.create') }}" class="btn-outline" style="border:2px solid #2563eb; color:#2563eb; padding:0.75rem 1.5rem; border-radius:10px; text-decoration:none; display:inline-flex; align-items:center; gap:0.5rem;">
                                <i class="fas fa-plus"></i>
                                Ajouter
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-content">
                        <h3 class="card-title" style="display:flex; align-items:center; gap:0.75rem;">
                            <i class="fas fa-calendar-alt" style="color:#2563eb;"></i>
                            Emploi du temps
                        </h3>
                        <p class="card-text">Ajouter, modifier et supprimer des entraînements.</p>
                        <div style="display:flex; gap:0.75rem; flex-wrap:wrap;">
                            <a href="{{ route('emploi-du-temps.index') }}" class="btn-primary">
                                Voir
                                <i class="fas fa-arrow-right"></i>
                            </a>
                            <a href="{{ route('emploi-du-temps.create') }}" class="btn-outline" style="border:2px solid #2563eb; color:#2563eb; padding:0.75rem 1.5rem; border-radius:10px; text-decoration:none; display:inline-flex; align-items:center; gap:0.5rem;">
                                <i class="fas fa-plus"></i>
                                Ajouter
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-content">
                        <h3 class="card-title" style="display:flex; align-items:center; gap:0.75rem;">
                            <i class="fas fa-user-tie" style="color:#2563eb;"></i>
                            Coachs
                        </h3>
                        <p class="card-text">Créer, modifier et supprimer les coachs.</p>
                        <div style="display:flex; gap:0.75rem; flex-wrap:wrap;">
                            <a href="{{ route('admin.coaches.index') }}" class="btn-primary">
                                Gérer
                                <i class="fas fa-arrow-right"></i>
                            </a>
                            <a href="{{ route('admin.coaches.create') }}" class="btn-outline" style="border:2px solid #2563eb; color:#2563eb; padding:0.75rem 1.5rem; border-radius:10px; text-decoration:none; display:inline-flex; align-items:center; gap:0.5rem;">
                                <i class="fas fa-plus"></i>
                                Ajouter
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-content">
                        <h3 class="card-title" style="display:flex; align-items:center; gap:0.75rem;">
                            <i class="fas fa-users" style="color:#2563eb;"></i>
                            Joueurs
                        </h3>
                        <p class="card-text">Créer, modifier et supprimer les joueurs.</p>
                        <div style="display:flex; gap:0.75rem; flex-wrap:wrap;">
                            <a href="{{ route('admin.joueurs.index') }}" class="btn-primary">
                                Gérer
                                <i class="fas fa-arrow-right"></i>
                            </a>
                            <a href="{{ route('admin.joueurs.create') }}" class="btn-outline" style="border:2px solid #2563eb; color:#2563eb; padding:0.75rem 1.5rem; border-radius:10px; text-decoration:none; display:inline-flex; align-items:center; gap:0.5rem;">
                                <i class="fas fa-plus"></i>
                                Ajouter
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-content">
                        <h3 class="card-title" style="display:flex; align-items:center; gap:0.75rem;">
                            <i class="fas fa-user-shield" style="color:#2563eb;"></i>
                            Utilisateurs
                        </h3>
                        <p class="card-text">Gérer les comptes (rôles admin, mots de passe).</p>
                        <div style="display:flex; gap:0.75rem; flex-wrap:wrap;">
                            <a href="{{ route('admin.users.index') }}" class="btn-primary">
                                Gérer
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
