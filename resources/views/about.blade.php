@extends('layouts.app')

@section('content')
@php
    $coachPhones = [
        // Format recommandé: 2217XXXXXXXX (sans +)
        // Alioune Ndiaye: 78 125 34 60
        'alioune ndiaye' => '221781253460',
        // Thiendou Ndiaye: 78 474 17 96
        'thiendou ndiaye' => '221784741796',
        // Awa Sene: 77 442 06 12
        'awa sene' => '221774420612',
    ];
@endphp
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

<div id="contactModal" style="position: fixed; inset: 0; z-index: 3000; display: none; align-items: center; justify-content: center; padding: 1rem;">
    <div id="contactModalOverlay" style="position: absolute; inset: 0; background: rgba(15, 23, 42, 0.65); backdrop-filter: blur(6px);"></div>
    <div style="position: relative; width: 100%; max-width: 520px; background: white; border-radius: 18px; border: 1px solid #e2e8f0; box-shadow: 0 24px 60px rgba(15, 23, 42, 0.22); overflow: hidden;">
        <div style="padding: 1.25rem 1.25rem 1rem; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; gap: 1rem;">
            <div>
                <div style="font-weight: 800; color: #0f172a; font-size: 1.1rem;">Contacter</div>
                <div id="contactModalSubtitle" style="color: #64748b; font-size: 0.9rem; margin-top: 0.2rem;"></div>
            </div>
            <button type="button" id="contactModalClose" aria-label="Fermer" style="width: 42px; height: 42px; border-radius: 9999px; border: 1px solid #e2e8f0; background: #f8fafc; color: #0f172a; cursor: pointer; display: inline-flex; align-items: center; justify-content: center;">
                <i class="fas fa-xmark"></i>
            </button>
        </div>

        <div style="padding: 1rem 1.25rem 1.25rem;">
            <div style="display: grid; grid-template-columns: 1fr; gap: 0.75rem;">
                <a id="contactWhatsappLink" href="#" target="_blank" rel="noopener" style="text-decoration: none; display: flex; align-items: center; justify-content: space-between; gap: 1rem; padding: 0.95rem 1rem; border-radius: 14px; border: 1px solid rgba(16, 185, 129, 0.28); background: rgba(16, 185, 129, 0.10); color: #065f46; font-weight: 800;">
                    <span style="display: inline-flex; align-items: center; gap: 0.7rem;">
                        <i class="fab fa-whatsapp" style="font-size: 1.35rem;"></i>
                        Envoyer un message WhatsApp
                    </span>
                    <i class="fas fa-arrow-right" style="opacity: 0.8;"></i>
                </a>

                <button id="contactSaveBtn" type="button" style="display: flex; align-items: center; justify-content: space-between; gap: 1rem; padding: 0.95rem 1rem; border-radius: 14px; border: 1px solid rgba(37, 99, 235, 0.25); background: rgba(37, 99, 235, 0.10); color: #1e40af; font-weight: 800; cursor: pointer;">
                    <span style="display: inline-flex; align-items: center; gap: 0.7rem;">
                        <i class="fas fa-address-card" style="font-size: 1.2rem;"></i>
                        Enregistrer le numéro
                    </span>
                    <i class="fas fa-download" style="opacity: 0.8;"></i>
                </button>
            </div>

            <div style="margin-top: 1rem; color: #94a3b8; font-size: 0.8rem; line-height: 1.4;">
                WhatsApp s'ouvrira si l'application est installée. Sinon, la version web sera proposée.
            </div>
        </div>
    </div>
</div>

<!-- Leadership Section -->
<section class="section" style="background: #f8fafc;">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Notre Leadership</h2>
            <p class="section-subtitle">
                Les visionnaires qui font la grandeur de EBOND
            </p>
        </div>
        
        <div class="cards-grid" style="grid-template-columns: repeat(auto-fit, minmax(320px, 360px)); justify-content: center; gap: 3rem;">
            <div class="card">
                <div class="card-image" style="height: 350px; padding: 0; overflow: hidden; position: relative;">
                    <img src="{{ asset('images/Leadership/Dieylani kebe.jpeg') }}" alt="Dieylani Kebe" style="width: 100%; height: 100%; object-fit: cover; object-position: 50% 15%; display: block;">
                </div>
                <div class="card-content" style="text-align: center;">
                    <h3 class="card-title" style="margin-bottom: 0.5rem;">Dieylani Kebe</h3>
                    <div style="margin-bottom: 1rem;">
                        <span class="badge" style="background: #dbeafe; color: #1e40af; padding: 0.25rem 0.75rem; border-radius: 9999px; font-weight: 600; font-size: 0.875rem;">
                            Fondateur & Entraîneur Principal
                        </span>
                    </div>
                    <div style="display: flex; align-items: center; justify-content: center; gap: 0.5rem; margin-bottom: 1.5rem; color: #64748b;">
                        <i class="fas fa-award" style="color: #fbbf24;"></i>
                        <span>26 ans d'expérience</span>
                    </div>
                    <p class="card-text" style="text-align: left;">
                        Visionnaire passionné, Dieylani Kebe est le fondateur de EBOND. Avec plus de deux décennies d'expérience, il a su créer une école de basket de référence au Sénégal. Son expertise technique et sa capacité à développer les talents font de lui un mentor respecté qui a formé des générations de joueurs d'excellence.
                    </p>
                </div>
            </div>
            
            <div class="card">
                <div class="card-image" style="height: 350px; padding: 0; overflow: hidden; position: relative;">
                    <img src="{{ asset('images/Leadership/Abbabacar Ndiaye.jpeg') }}" alt="Ababacar Ndiaye" style="width: 100%; height: 100%; object-fit: cover; object-position: 50% 15%; display: block;">
                </div>
                <div class="card-content" style="text-align: center;">
                    <h3 class="card-title" style="margin-bottom: 0.5rem;">Ababacar Ndiaye</h3>
                    <div style="margin-bottom: 1rem;">
                        <span class="badge" style="background: #fce7f3; color: #ec4899; padding: 0.25rem 0.75rem; border-radius: 9999px; font-weight: 600; font-size: 0.875rem;">
                            Président de Ligue de Basket de Diourbel
                        </span>
                    </div>
                    <div style="display: flex; align-items: center; justify-content: center; gap: 0.5rem; margin-bottom: 1.5rem; color: #64748b;">
                        <i class="fas fa-trophy" style="color: #fbbf24;"></i>
                        <span>Leader Dynamique</span>
                    </div>
                    <p class="card-text" style="text-align: left;">
                        Jeune leader sérieux et dynamique, Ababacar Ndiaye est un passionné qui ne vit que pour le basket diourbelois. Son engagement sans faille pour le développement du basketball dans la région de Diourbel fait de lui un acteur incontournable. Il incarne la nouvelle génération de dirigeants qui allient modernité et valeurs traditionnelles.
                    </p>
                </div>
            </div>
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
                            <img src="{{ asset('images/' . $coach->photo) }}" alt="{{ $coach->prenom }} {{ $coach->nom }}" 
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

                        @php
                            $fallbackPhone = '221700000000';
                            $coachKey = Str::lower(Str::ascii($coach->prenom . ' ' . $coach->nom));
                            $phone = $coachPhones[$coachKey] ?? $fallbackPhone;
                        @endphp

                        <div style="margin-top: 1.25rem; display: flex; flex-direction: column; align-items: center; gap: 0.75rem;">
                            <button
                                type="button"
                                class="btn-primary"
                                data-contact-trigger
                                data-coach-name="{{ $coach->prenom }} {{ $coach->nom }}"
                                data-coach-phone="{{ $phone }}"
                                style="display: inline-flex; align-items: center; justify-content: center; gap: 0.6rem; width: 100%; max-width: 260px; padding: 0.75rem 1.1rem; border-radius: 9999px;"
                            >
                                <i class="fas fa-phone"></i>
                                Contacter
                            </button>

                        @if(Str::lower(Str::ascii($coach->prenom . ' ' . $coach->nom)) === 'alioune ndiaye')
                                <a href="{{ route('coaches.show', $coach) }}" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.6rem 1.1rem; border-radius: 9999px; background: rgba(37, 99, 235, 0.12); color: #2563eb; font-weight: 700; font-size: 0.9rem; border: 1px solid rgba(37, 99, 235, 0.25); text-decoration: none;">
                                    Voir plus
                                    <i class="fas fa-arrow-right" style="font-size: 0.9rem;"></i>
                                </a>
                        @endif
                        </div>
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

<!-- Credit Bar -->
<div style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); border-top: 1px solid #334155; color: white; padding: 1.5rem 0; text-align: center; font-size: 0.875rem; position: relative; overflow: hidden;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem; position: relative; z-index: 2;">
        <div style="display: flex; align-items: center; justify-content: center; gap: 0.75rem; flex-wrap: wrap;">
            <div style="display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-code" style="color: #fbbf24; font-size: 1rem;"></i>
                <span style="color: #94a3b8; font-weight: 400;">Développé par</span>
            </div>
            <div style="display: flex; align-items: center; gap: 0.5rem;">
                <strong style="color: #f1f5f9; font-weight: 600; font-size: 0.95rem;">Mohamed Fadel Fall</strong>
                <span style="background: rgba(251, 191, 36, 0.2); color: #fbbf24; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500; border: 1px solid rgba(251, 191, 36, 0.3);">
                    Junior Developer
                </span>
            </div>
        </div>
        <div style="margin-top: 0.5rem; color: #64748b; font-size: 0.75rem;">
            © {{ date('Y') }} EBOND Basket — Tous droits réservés
        </div>
    </div>
    <!-- Subtle animated pattern -->
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.05; background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.4"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E'); background-size: 60px 60px; pointer-events: none;"></div>
</div>

<script>
    (function () {
        const modal = document.getElementById('contactModal');
        const overlay = document.getElementById('contactModalOverlay');
        const closeBtn = document.getElementById('contactModalClose');
        const subtitle = document.getElementById('contactModalSubtitle');
        const whatsappLink = document.getElementById('contactWhatsappLink');
        const saveBtn = document.getElementById('contactSaveBtn');

        if (!modal || !overlay || !closeBtn || !subtitle || !whatsappLink || !saveBtn) return;

        let current = { name: '', phone: '' };

        const normalizePhone = (value) => (value || '').toString().replace(/\s+/g, '').replace(/^\+/, '');

        const openModal = ({ name, phone }) => {
            current.name = name || '';
            current.phone = normalizePhone(phone);

            subtitle.textContent = current.name ? `Coach: ${current.name}` : '';

            const waPhone = current.phone || '221700000000';
            const waText = encodeURIComponent('Bonjour Coach, je vous contacte depuis le site EBOND.');
            whatsappLink.href = `https://wa.me/${waPhone}?text=${waText}`;

            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        };

        const closeModal = () => {
            modal.style.display = 'none';
            document.body.style.overflow = '';
        };

        const downloadVcf = () => {
            const phone = current.phone || '221700000000';
            const name = current.name || 'Coach EBOND';

            const vcf = [
                'BEGIN:VCARD',
                'VERSION:3.0',
                `FN:${name}`,
                `TEL;TYPE=CELL:+${phone}`,
                'END:VCARD'
            ].join('\n');

            const blob = new Blob([vcf], { type: 'text/vcard;charset=utf-8' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `${name.replace(/[^a-z0-9\-\s]/gi, '').trim() || 'contact'}.vcf`;
            document.body.appendChild(a);
            a.click();
            a.remove();
            setTimeout(() => URL.revokeObjectURL(url), 250);
        };

        document.querySelectorAll('[data-contact-trigger]').forEach((btn) => {
            btn.addEventListener('click', () => {
                openModal({
                    name: btn.getAttribute('data-coach-name'),
                    phone: btn.getAttribute('data-coach-phone'),
                });
            });
        });

        overlay.addEventListener('click', closeModal);
        closeBtn.addEventListener('click', closeModal);
        saveBtn.addEventListener('click', () => {
            downloadVcf();
            closeModal();
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && modal.style.display === 'flex') {
                closeModal();
            }
        });
    })();
</script>
@endsection
