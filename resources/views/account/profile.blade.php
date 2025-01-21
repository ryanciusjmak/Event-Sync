@extends('layouts.main')

@section('title', 'My Profile')

@section('content')

<div class="master-card-profile max-w-4xl mx-auto mt-2 p-2 rounded-lg">

    <div class="profile-card">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <ion-icon name="settings-outline"></ion-icon>
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/my-account/settings-profile">Settigns Profile</a></li>
            </ul>
            </div>
    @if($user->profile_picture)
        <img src="{{ asset('uploads/profile_pictures/' . $user->profile_picture) }}" alt="Foto de Perfil"
            class="rounded-circle img-fluid" style="width: 100px; height: 100px; object-fit: cover; border: solid 1px #ff0000;" id="image-profile">
    @else
        <img src="{{ asset('uploads/profile_pictures/picture_user.jpg') }}" alt="Foto de Perfil"
            class="rounded-circle img-fluid" style="width: 80px; height: 80px; object-fit: cover;">
    @endif
    <!-- Informações do Usuário -->
    <div class="bg-gray-50 p-4 rounded-lg mb-6">
        <h2 class="text-xl font-semibold text-white">User</h2>
        <p class="text-white mt-2">Name: <span class="font-semibold">{{ $user->name }}</span></p>
        <p class="text-white">Email: <span class="font-semibold">{{ $user->email }}</span></p>
    </div>
     <!-- Sessões Ativas -->
     <div class="bg-gray-50 p-4 rounded-lg">
        <h2 class="text-xl font-semibold text-white mb-4">Sessões Ativas</h2>
        @if ($sessions->isNotEmpty())
            <table class="min-w-full table-auto border-collapse">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left text-white">IP</th>
                        <th class="px-4 py-2 text-left text-white">Última Atividade</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sessions as $session)
                        <tr class="border-t">
                            <td class="px-2 py-1 text-white">{{ $session->ip_address }}</td>
                            <td class="px-2 py-1 text-white">
                                {{ \Carbon\Carbon::createFromTimestamp($session->last_activity)->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-white">Nenhuma sessão ativa encontrada.</p>
        @endif
    </div>
</div>

   
</div>
@endsection