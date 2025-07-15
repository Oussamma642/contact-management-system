<nav class="bg-white shadow-lg fixed w-full z-40">
    <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-6">
        <div class="flex justify-between items-center h-14 sm:h-16">
            <!-- Bouton menu mobile -->
            <div class="flex lg:hidden">
                <button type="button" onclick="toggleSidebar()"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                    <span class="sr-only">Ouvrir le menu</span>
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>

            <!-- Logo -->
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-address-book text-2xl sm:text-3xl text-blue-600"></i>
                </div>
                <span class="ml-2 text-lg sm:text-xl font-bold text-gray-800">ContactPro</span>
            </div>

            <!-- Shared Contacts Icon with Badge -->
            <div class="flex items-center relative">
                <button type="button" onclick="openSharedContactsModal()"
                    class="text-gray-700 hover:text-gray-900 focus:outline-none mx-3">
                    <i class="fas fa-share-alt text-xl sm:text-2xl"></i>
                    <span class="hidden sm:inline-block ml-2 text-sm font-medium">Shared Contacts</span>
                </button>
                <!-- Pending Count Badge -->
                <span id="sharedContactsCount"
                    class="absolute top-0 right-0 bg-red-600 text-white text-xs font-bold px-1.5 py-0.5 rounded-full -mt-1 -mr-2">
                    0
                </span>
            </div>

            <!-- Menu utilisateur -->
            <div class="flex items-center">
                <div class="relative" x-data="{ open: false }">
                    <button type="button" @click="open = !open"
                        class="flex items-center text-gray-700 hover:text-gray-900 focus:outline-none">
                        <span class="hidden sm:inline-block mr-2">{{ Auth::user()->name }}</span>
                        <i class="fas fa-chevron-down text-xs ml-1"></i>
                    </button>
                    
                    <!-- Dropdown menu -->
                    <div x-show="open" @click.away="open = false" 
                        class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95">
                        
                        <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-user mr-2"></i>Mon Profil
                        </a>
                        
                        <form method="POST" action="{{ route('logout') }}" class="block">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>