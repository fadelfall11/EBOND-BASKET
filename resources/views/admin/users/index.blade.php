@extends('layouts.app')

@section('content')
<section class="section">
    <div class="container">
        <div style="display:flex; align-items:center; justify-content:space-between; gap:1rem; flex-wrap:wrap; margin-bottom:2rem;">
            <div>
                <h2 class="section-title" style="margin-bottom:0.25rem;">Gestion des utilisateurs</h2>
                <p class="section-subtitle" style="margin:0;">Rôles admin, email, reset mot de passe.</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="btn-outline" style="border:2px solid #2563eb; color:#2563eb; padding:0.75rem 1.5rem; border-radius:10px; text-decoration:none; display:inline-flex; align-items:center; gap:0.5rem;">
                <i class="fas fa-arrow-left"></i>
                Admin
            </a>
        </div>

        <div class="card">
            <div class="card-content">
                <div style="overflow-x:auto;">
                    <table style="width:100%; border-collapse:collapse;">
                        <thead>
                            <tr style="text-align:left; border-bottom:1px solid #e2e8f0;">
                                <th style="padding:0.75rem;">Nom</th>
                                <th style="padding:0.75rem;">Email</th>
                                <th style="padding:0.75rem;">Admin</th>
                                <th style="padding:0.75rem;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr style="border-bottom:1px solid #f1f5f9;">
                                    <td style="padding:0.75rem; font-weight:600;">{{ $user->name }}</td>
                                    <td style="padding:0.75rem; color:#64748b;">{{ $user->email }}</td>
                                    <td style="padding:0.75rem; color:#64748b;">{{ $user->is_admin ? 'Oui' : 'Non' }}</td>
                                    <td style="padding:0.75rem;">
                                        <div style="display:flex; gap:0.5rem; flex-wrap:wrap;">
                                            <a class="btn-outline" href="{{ route('admin.users.edit', $user) }}" style="border:2px solid #2563eb; color:#2563eb; padding:0.5rem 0.9rem; border-radius:10px; text-decoration:none; display:inline-flex; align-items:center; gap:0.4rem;">
                                                <i class="fas fa-pen"></i>
                                                Modifier
                                            </a>
                                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Supprimer cet utilisateur ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-outline" style="border:2px solid #dc2626; color:#dc2626; padding:0.5rem 0.9rem; border-radius:10px; background:transparent; cursor:pointer; display:inline-flex; align-items:center; gap:0.4rem;">
                                                    <i class="fas fa-trash"></i>
                                                    Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="padding:1rem; color:#64748b; text-align:center;">Aucun utilisateur.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($users->hasPages())
                    <div style="margin-top:1.5rem;">{{ $users->links() }}</div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
