@extends('dashboard-layouts.app')

@section('content')
<main class="p-4 sm:p-6 lg:p-8 max-w-4xl mx-auto bg-gray-50 min-h-screen">
    <!-- Success Messages -->
    @if(session('success'))
        <div class="bg-white border-l-4 border-emerald-500 text-gray-700 p-4 rounded shadow mb-8 flex justify-between items-center animate-fadeIn">
            <div class="flex items-center">
                <div class="h-8 w-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-500 mr-3">
                    <i class="fas fa-check"></i>
                </div>
                <div>
                    <h4 class="font-medium text-emerald-700 mb-0.5">Succès</h4>
                    <p class="text-gray-600 text-sm">{{ session('success') }}</p>
                </div>
            </div>
            <button type="button" class="text-gray-400 hover:text-gray-600 transition-colors duration-200" onclick="this.parentElement.style.display='none'">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    <!-- Profile Header -->
    <div class="bg-white rounded-xl shadow-xl overflow-hidden mb-8 transition-all duration-300 hover:shadow-2xl">
        <div class="bg-gradient-to-r from-indigo-600 via-blue-600 to-blue-500 px-6 py-10 relative">
            <div class="absolute top-0 left-0 w-full h-full opacity-10">
                <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'100%\' height=\'100%\' viewBox=\'0 0 1000 1000\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cdefs%3E%3ClinearGradient id=\'a\' gradientUnits=\'userSpaceOnUse\' x1=\'0\' x2=\'1000\' y1=\'0\' y2=\'1000\'%3E%3Cstop offset=\'0\' stop-color=\'%23ffffff\' stop-opacity=\'0\'/%3E%3Cstop offset=\'1\' stop-color=\'%23ffffff\' stop-opacity=\'0.1\'/%3E%3C/linearGradient%3E%3C/defs%3E%3Cpath d=\'M0,1000 C200,800 800,200 1000,0 L1000,1000 Z\' fill=\'url(%23a)\'/%3E%3C/svg%3E')"></div>
            </div>
            <div class="flex flex-col sm:flex-row items-center relative z-10">
                <div class="h-28 w-28 rounded-full bg-white flex items-center justify-center text-blue-600 text-4xl shadow-lg border-4 border-white transform hover:scale-105 transition-transform duration-300">
                    <i class="fas fa-user"></i>
                </div>
                <div class="mt-5 sm:mt-0 sm:ml-8 text-center sm:text-left">
                    <h1 class="text-white text-3xl font-bold tracking-tight">{{ Auth::user()->name }}</h1>
                    <p class="text-blue-100 mt-1 flex items-center justify-center sm:justify-start">
                        <i class="fas fa-envelope mr-2 opacity-75"></i>
                        {{ Auth::user()->email }}
                    </p>
                    <p class="text-blue-100 text-sm mt-2 opacity-80 flex items-center justify-center sm:justify-start">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        Membre depuis {{ Auth::user()->created_at->format('d M Y') }}
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Profile Navigation Tabs -->
        <div class="border-b border-gray-200 bg-gray-50">
            <nav class="flex space-x-6 px-6" aria-label="Tabs">
                <button onclick="switchTab('profile')" id="profile-tab" class="tab-button text-blue-600 border-blue-600 active-tab">
                    <i class="fas fa-user mr-2"></i>Profil
                </button>
                <button onclick="switchTab('security')" id="security-tab" class="tab-button text-gray-500 hover:text-gray-700 hover:border-gray-300">
                    <i class="fas fa-lock mr-2"></i>Sécurité
                </button>
                <button onclick="switchTab('danger')" id="danger-tab" class="tab-button text-gray-500 hover:text-gray-700 hover:border-gray-300">
                    <i class="fas fa-exclamation-triangle mr-2"></i>Zone Dangereuse
                </button>
            </nav>
        </div>
    </div>
    
    <!-- Profile Information Section -->
    <div id="profile-content" class="tab-content mt-8 transition-opacity duration-300">
        <div class="bg-white rounded-xl shadow-md p-8 mb-6 border border-gray-100">
            <div class="flex items-center mb-6">
                <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 mr-3">
                    <i class="fas fa-id-card"></i>
                </div>
                <h2 class="text-xl font-semibold text-gray-800">Information du Profil</h2>
            </div>
            <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="relative">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <input type="text" name="name" id="name" value="{{ Auth::user()->name }}" class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-all duration-200">
                    </div>
                </div>
                
                <div class="relative">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input type="email" name="email" id="email" value="{{ Auth::user()->email }}" class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-all duration-200">
                    </div>
                </div>
                
                <div class="flex justify-end pt-2">
                    <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-lg shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transform hover:-translate-y-0.5 transition-all duration-200 flex items-center">
                        <i class="fas fa-save mr-2"></i>
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Security Section -->
    <div id="security-content" class="tab-content hidden mt-8 transition-opacity duration-300">
        <div class="bg-white rounded-xl shadow-md p-8 mb-6 border border-gray-100">
            <div class="flex items-center mb-6">
                <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 mr-3">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h2 class="text-xl font-semibold text-gray-800">Changer le Mot de Passe</h2>
            </div>
            <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="relative">
                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe actuel</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-key text-gray-400"></i>
                        </div>
                        <input type="password" name="current_password" id="current_password" class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-all duration-200">
                    </div>
                </div>
                
                <div class="relative">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Nouveau mot de passe</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" name="password" id="password" class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-all duration-200">
                    </div>
                </div>
                
                <div class="relative">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmer le mot de passe</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-all duration-200">
                    </div>
                </div>
                
                <div class="flex justify-end pt-2">
                    <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-indigo-500 text-white rounded-lg shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transform hover:-translate-y-0.5 transition-all duration-200 flex items-center">
                        <i class="fas fa-key mr-2"></i>
                        Mettre à jour le mot de passe
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Danger Zone Section -->
    <div id="danger-content" class="tab-content hidden mt-8 transition-opacity duration-300">
        <div class="bg-white rounded-xl shadow-md p-8 mb-6 border-2 border-red-200 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 transform translate-x-8 -translate-y-8">
                <div class="absolute top-0 left-0 w-full h-full bg-red-100 rounded-full opacity-30"></div>
            </div>
            
            <div class="flex items-center mb-6 relative z-10">
                <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center text-red-600 mr-3">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <h2 class="text-xl font-semibold text-red-600">Supprimer le Compte</h2>
            </div>
            
            @if(session('error'))
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded mb-6 shadow-sm">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-2 text-red-500"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                </div>
            @endif
            
            <div class="bg-red-50 p-4 rounded-lg mb-6">
                <p class="text-sm text-gray-700 leading-relaxed relative z-10">
                    <strong class="text-red-600 font-medium">Attention:</strong> Une fois votre compte supprimé, toutes ses ressources et données seront <span class="font-semibold">définitivement effacées</span>. Avant de supprimer votre compte, veuillez télécharger toutes les données ou informations que vous souhaitez conserver.
                </p>
            </div>
            
            <!-- Enhanced deletion button -->
            <form action="{{ route('profile.delete') }}" method="POST" onsubmit="return confirm('Êtes-vous vraiment sûr de vouloir supprimer votre compte? Cette action est irréversible.')" class="relative z-10">
                @csrf
                
                <button type="submit" class="w-full px-5 py-4 bg-gradient-to-r from-red-600 to-red-500 text-white font-bold rounded-lg shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center">
                    <i class="fas fa-trash-alt mr-2"></i>
                    SUPPRIMER MON COMPTE DÉFINITIVEMENT
                </button>
            </form>
        </div>
    </div>
</main>

<style>
    .tab-button {
        @apply px-4 py-3 font-medium text-sm border-b-2 border-transparent transition-all duration-200;
    }
    .active-tab {
        @apply border-blue-600 text-blue-600;
    }
    .animate-fadeIn {
        animation: fadeIn 0.5s ease-in-out;
    }
    .tab-content {
        opacity: 1;
        transition: opacity 0.3s ease-in-out;
    }
    .tab-content.hidden {
        opacity: 0;
        pointer-events: none;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    input, button {
        transition: all 0.2s ease-in-out;
    }
    input:focus {
        transform: translateY(-1px);
    }
</style>

<script>
    // Check for errors in delete account form and switch to danger tab if needed
    document.addEventListener('DOMContentLoaded', function() {
        @if($errors->has('delete_confirm') || $errors->has('general') || session('error'))
            switchTab('danger');
        @endif
        
        // Add ripple effect to buttons
        const buttons = document.querySelectorAll('button[type="submit"]');
        buttons.forEach(button => {
            button.addEventListener('mousedown', createRipple);
        });
        
        // Add animation to success message if present
        const successMsg = document.querySelector('.animate-fadeIn');
        if (successMsg) {
            setTimeout(() => {
                successMsg.style.opacity = '0.9';
            }, 5000);
            setTimeout(() => {
                successMsg.style.opacity = '0';
                successMsg.style.height = '0';
                successMsg.style.margin = '0';
                successMsg.style.padding = '0';
                successMsg.style.transition = 'all 0.5s ease-in-out';
            }, 5500);
        }
    });

    function createRipple(event) {
        const button = event.currentTarget;
        const ripple = document.createElement('span');
        const rect = button.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height) * 2;
        
        ripple.style.width = ripple.style.height = `${size}px`;
        ripple.style.left = `${event.clientX - rect.left - size/2}px`;
        ripple.style.top = `${event.clientY - rect.top - size/2}px`;
        ripple.classList.add('ripple');
        
        const existingRipple = button.querySelector('.ripple');
        if (existingRipple) {
            existingRipple.remove();
        }
        
        button.appendChild(ripple);
        
        setTimeout(() => {
            ripple.remove();
        }, 600);
    }

    function switchTab(tabName) {
        // Add a small delay to allow for the fade out effect
        document.querySelectorAll('.tab-content').forEach(content => {
            if (!content.classList.contains('hidden')) {
                content.style.opacity = '0';
                setTimeout(() => {
                    content.classList.add('hidden');
                    showNewTab(tabName);
                }, 200);
            } else if (document.querySelectorAll('.tab-content:not(.hidden)').length === 0) {
                // If all tabs are already hidden, just show the new one
                showNewTab(tabName);
            }
        });
        
        // Update tab styles with a smooth transition
        document.querySelectorAll('.tab-button').forEach(tab => {
            tab.classList.remove('active-tab', 'text-blue-600', 'border-blue-600');
            tab.classList.add('text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
        });
        
        document.getElementById(`${tabName}-tab`).classList.add('active-tab', 'text-blue-600', 'border-blue-600');
        document.getElementById(`${tabName}-tab`).classList.remove('text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
    }
    
    function showNewTab(tabName) {
        const newContent = document.getElementById(`${tabName}-content`);
        newContent.classList.remove('hidden');
        setTimeout(() => {
            newContent.style.opacity = '1';
        }, 50);
    }
</script>

<style>
    .ripple {
        position: absolute;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.4);
        transform: scale(0);
        animation: ripple-animation 0.6s linear;
        pointer-events: none;
    }
    
    @keyframes ripple-animation {
        to {
            transform: scale(2);
            opacity: 0;
        }
    }
</style>
@endsection 