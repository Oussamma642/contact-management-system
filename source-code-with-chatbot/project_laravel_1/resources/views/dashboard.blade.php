@extends('dashboard-layouts.app')

@section('content')
<main class="p-3 sm:p-4 lg:p-6">
    @if(session('error') || $errors->any())
    @include('modals.errors')
    @endif

        <!-- En-tête avec statistiques -->
        <div class="mt-7 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-4 sm:mb-6">
            <div class="bg-white rounded-lg shadow p-4 sm:p-6">
                <div class="flex items-center">
                    <div class="p-2 sm:p-3 rounded-full bg-blue-100 text-blue-600">
                        <i class="fas fa-user-friends text-xl sm:text-2xl"></i>
                    </div>
                    <div class="ml-3 sm:ml-4">
                        <p class="text-xs sm:text-sm text-gray-500">Ami</p>
                        <p class="text-base sm:text-lg font-semibold">{{ $stats['ami'] }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 sm:p-6">
                <div class="flex items-center">
                    <div class="p-2 sm:p-3 rounded-full bg-green-100 text-green-600">
                        <i class="fas fa-users text-xl sm:text-2xl"></i>
                    </div>
                    <div class="ml-3 sm:ml-4">
                        <p class="text-xs sm:text-sm text-gray-500">Famille</p>
                        <p class="text-base sm:text-lg font-semibold">{{ $stats['famille'] }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 sm:p-6">
                <div class="flex items-center">
                    <div class="p-2 sm:p-3 rounded-full bg-purple-100 text-purple-600">
                        <i class="fas fa-briefcase text-xl sm:text-2xl"></i>
                    </div>
                    <div class="ml-3 sm:ml-4">
                        <p class="text-xs sm:text-sm text-gray-500">Professionnels</p>
                        <p class="text-base sm:text-lg font-semibold">{{ $stats['professionnel'] }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 sm:p-6">
                <div class="flex items-center">
                    <div class="p-2 sm:p-3 rounded-full bg-yellow-100 text-yellow-600">
                        <i class="fas fa-building text-xl sm:text-2xl"></i>
                    </div>
                    <div class="ml-3 sm:ml-4">
                        <p class="text-xs sm:text-sm text-gray-500">Collègues</p>
                        <p class="text-base sm:text-lg font-semibold">{{ $stats['collegue'] }}</p>
                    </div>
                </div>
            </div>
        </div> <!-- Liste des contacts -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-4 sm:p-6 border-b border-gray-200">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-3 sm:space-y-0">
                    <h2 class="text-lg sm:text-xl font-semibold text-gray-800">Vos contacts récents</h2>
                <button onclick="openUsersModal()"
                    class="w-full sm:w-auto bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    <i class="fas fa-share-alt mr-2"></i>Partager
                </button>
                    <a href="{{ route('export.contacts') }}"
                        class="w-full sm:w-auto bg-green-800 text-white px-4 py-2 rounded-lg hover:bg-green-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <i class="fas fa-file-excel mr-2"></i>Export to Excel
                    </a>
                    <button onclick="openAddModal()"
                        class="w-full sm:w-auto bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <i class="fas fa-plus mr-2"></i>Nouveau contact
                    </button>
            </div>
                </div>

        <!-- Filtrage des contacts -->
        <div class="p-4 sm:p-6 border-b border-gray-200 bg-gray-50">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-md font-medium text-gray-700">Filtrer vos contacts</h3>
                <button id="reset-filters" class="text-sm text-blue-600 hover:text-blue-800">
                    <i class="fas fa-undo mr-1"></i>Réinitialiser
                </button>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                <div>
                    <label for="filter-name" class="block text-sm font-medium text-gray-700">Nom</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <input type="text" id="filter-name" class="pl-10 focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Rechercher par nom">
                    </div>
                </div>
                <div>
                    <label for="filter-email" class="block text-sm font-medium text-gray-700">Email</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input type="text" id="filter-email" class="pl-10 focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Rechercher par email">
                    </div>
                </div>
                <div>
                    <label for="filter-phone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-phone text-gray-400"></i>
                        </div>
                        <input type="text" id="filter-phone" class="pl-10 focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Rechercher par téléphone">
                    </div>
                </div>
                <div>
                    <label for="filter-category" class="block text-sm font-medium text-gray-700">Catégorie</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-tag text-gray-400"></i>
                        </div>
                        <select id="filter-category" class="pl-10 focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            <option value="">Toutes les catégories</option>
                            <option value="ami">Ami</option>
                            <option value="famille">Famille</option>
                            <option value="professionnel">Professionnel</option>
                            <option value="collegue">Collègue</option>
                        </select>
                    </div>
                </div>
            </div>
            </div>

        <form method="POST" action="{{ route('share.contacts') }}">
            @csrf
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <input type="checkbox" id="selectAll" onclick="toggleSelectAll(this)">
                            </th>
                            <th
                                class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nom
                            </th>
                            <th
                                class="hidden sm:table-cell px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Email
                            </th>
                            <th
                                class="hidden md:table-cell px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Téléphone
                            </th>
                            <th
                                class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Catégorie
                            </th>
                            <th
                                class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($contacts as $contact)
                        <tr>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" name="contact_ids[]" value="{{ $contact->id }}">
                            </td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8 sm:h-10 sm:w-10">
                                        <div
                                            class="h-8 w-8 sm:h-10 sm:w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                            <i class="fas fa-user text-gray-500 text-sm sm:text-base"></i>
                                        </div>
                                    </div>
                                    <div class="ml-3 sm:ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $contact->name }}</div>
                                        <div class="sm:hidden text-xs text-gray-500">{{ $contact->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="hidden sm:table-cell px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $contact->email }}</div>
                            </td>
                            <td class="hidden md:table-cell px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $contact->phone }}</div>
                            </td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($contact->category == 'ami') bg-blue-100 text-blue-800
                                    @elseif($contact->category == 'famille') bg-green-100 text-green-800
                                    @elseif($contact->category == 'professionnel') bg-purple-100 text-purple-800
                                    @else bg-yellow-100 text-yellow-800
                                    @endif">
                                    {{ ucfirst($contact->category) }}
                                </span>
                            </td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button type="button" onclick="openEditModal({{ $contact->id }})"
                                    class="text-blue-600 hover:text-blue-900 mr-3" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="{{ route('persons.RelatedPersons', $contact->id) }}"
                                    class="text-purple-600 hover:text-purple-900 mr-3" title="Personnes liées">
                                    <i class="fas fa-people-arrows"></i>
                                </a>
                                <button type="button" onclick="deleteContact({{ $contact->id }})"
                                    class="text-red-600 hover:text-red-900" title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                Aucun contact trouvé
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div id="usersModal"
                    class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
                    @include('modals.usersModal')
            </div>
            </div>
        </form>
        </div>

    <!-- Improved chatbot icon with animation -->
    <div id="chatbot-icon" class="fixed bottom-6 right-6 cursor-pointer z-40 transition-transform hover:scale-110">
        <div class="relative">
            <div class="p-4 bg-blue-600 text-white rounded-full shadow-lg hover:bg-blue-700 transition-colors">
                <i class="fas fa-robot text-3xl"></i>
            </div>
            <span class="absolute -top-2 -right-2 bg-green-500 text-white text-xs px-2 py-1 rounded-full animate-pulse">Vocal</span>
        </div>
    </div>
</main>

<!-- Modal d'ajout/modification de contact -->
<div id="contactModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    @include('modals.contactModals')
                </div>

<!-- Chatbot Interface -->
<div id="chatbot-container" class="fixed bottom-24 right-6 w-80 md:w-96 bg-white rounded-lg shadow-2xl z-40 hidden transform transition-all duration-300 scale-95 opacity-0">
    <!-- Header -->
    <div class="bg-blue-600 text-white px-4 py-3 flex justify-between items-center rounded-t-lg">
        <div class="flex items-center">
            <i class="fas fa-robot mr-2 text-lg"></i>
            <span class="font-bold">Assistant Vocal</span>
                </div>
        <div class="flex space-x-2">
            <button id="reset-chat" class="hover:bg-blue-700 p-1 rounded transition-colors" title="Réinitialiser">
                <i class="fas fa-redo-alt"></i>
            </button>
            <button id="close-chatbot" class="hover:bg-blue-700 p-1 rounded transition-colors">
                <i class="fas fa-times"></i>
            </button>
                </div>
                </div>
    
    <!-- Messages Area -->
    <div id="chatbot-messages" class="h-72 p-4 overflow-y-auto bg-gray-50"></div>
    
    <!-- Status Area -->
    <div class="border-t border-gray-200 bg-white">
        <div class="p-3 text-center">
            <div id="voice-status" class="text-sm text-gray-600 mb-2">Cliquez sur le microphone pour commencer</div>
            <div id="mic-animation" class="hidden mx-auto w-12 h-12 rounded-full relative">
                <div class="absolute inset-0 rounded-full bg-red-500 opacity-75 animate-ping"></div>
                <div class="relative rounded-full bg-red-600 w-full h-full flex items-center justify-center">
                    <i class="fas fa-microphone text-white"></i>
                </div>
            </div>
        </div>
        
        <!-- Microphone Button -->
        <div class="p-3 flex justify-center">
            <button id="mic-button" class="w-14 h-14 bg-blue-600 text-white rounded-full shadow-lg hover:bg-blue-700 focus:outline-none transition-all transform hover:scale-105">
                <i class="fas fa-microphone text-xl"></i>
                    </button>
        </div>
        
        <!-- Manual Input Area -->
        <div id="manual-controls" class="p-3 border-t border-gray-200 hidden">
            <div class="flex items-center">
                <input type="text" id="correction-input" class="flex-1 border border-gray-300 rounded-l-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Corriger la réponse...">
                <button id="submit-correction" class="bg-blue-600 text-white px-4 py-2 rounded-r-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                    <i class="fas fa-check"></i>
                    </button>
                </div>
        </div>
    </div>
</div>

<script>
// Improved voice recognition and UI interaction for the contact management chatbot

// Global variables to track state
let contactInfo = {
    name: '',
    email: '',
    phone: '',
    category: ''
};

// Conversation state tracking
let isListening = false;
let currentStep = '';
let lastRecognizedText = '';
let processingVoice = false;

// Timing constants (milliseconds)
const SHORT_DELAY = 1000;  // 1 second
const MEDIUM_DELAY = 1800; // 1.8 seconds
const LONG_DELAY = 2500;   // 2.5 seconds

// Speech recognition options by language
const recognitionConfigs = {
    'fr-FR': {
        lang: 'fr-FR',
        placeholders: {
            nameCorrection: "Corriger le nom si nécessaire",
            emailCorrection: "Corriger l'email si nécessaire",
            phoneCorrection: "Corriger le numéro si nécessaire",
            categoryCorrection: "Corriger la catégorie si nécessaire"
        },
        prompts: {
            welcome: "Bonjour! Je vais vous aider à ajouter un nouveau contact. Cliquez sur le microphone quand vous êtes prêt.",
            askName: "Quel est le nom du contact ?",
            askEmail: "Quel est l'email du contact ?",
            askPhone: "Quel est le numéro de téléphone du contact ?",
            askCategory: "Quelle est la catégorie ? (ami, famille, professionnel, collègue)",
            confirmDetails: "Voici les détails du contact à ajouter:",
            confirmQuestion: "Dites 'Oui' pour confirmer ou 'Non' pour annuler.",
            contactAdded: "Contact ajouté avec succès !",
            contactCancelled: "Ajout de contact annulé.",
            errorUnderstanding: "Je n'ai pas bien compris. Veuillez utiliser le clavier pour entrer votre réponse.",
            readyToListen: "Prêt à écouter...",
            listening: "Écoute en cours...",
            recognized: " reconnu. Correction possible.",
            error: "Erreur"
        },
        categoryMappings: {
            'ami': ['ami', 'amie', 'amis', 'copain', 'pote'],
            'famille': ['famille', 'familial', 'parent', 'parents', 'frère', 'sœur', 'soeur'],
            'professionnel': ['pro', 'professionnel', 'professionnelle', 'travail', 'business', 'client'],
            'collegue': ['collègue', 'collegue', 'collège', 'college', 'travail', 'bureau', 'boulot']
        },
        confirmWords: ['oui', 'yes', 'ok', 'confirme', 'accepte', 'valide', "d'accord"]
    }
};

// Use French by default 
const currentLang = 'fr-FR';
const config = recognitionConfigs[currentLang];

// Document ready function
document.addEventListener('DOMContentLoaded', function() {
    setupEventListeners();
    
    // Check for browser support of required APIs
    checkBrowserCompatibility();
    
    // Add CSS animations
    addChatbotStyles();
    
    // Set up form submission handlers
    setupFormHandlers();
});

// Set up all event listeners
function setupEventListeners() {
    // Chatbot icon click - open the chatbot
    document.getElementById('chatbot-icon').addEventListener('click', function() {
        showChatbot();
        setTimeout(() => startVoiceInteraction(), 500); // Increase timeout to ensure UI is visible first
    });
    
    // Close button click
    document.getElementById('close-chatbot').addEventListener('click', function() {
        hideChatbot();
        resetChatbot();
    });
    
    // Reset button click
    document.getElementById('reset-chat').addEventListener('click', function() {
        resetChatbot();
        setTimeout(() => startVoiceInteraction(), 300);
    });
    
    // Microphone button click
    document.getElementById('mic-button').addEventListener('click', function() {
        if (processingVoice) return; // Prevent multiple clicks during processing
        
        if (!isListening) {
            continueVoiceInteraction();
        } else {
            // If already listening, stop the recognition
            if (window.currentRecognition) {
                window.currentRecognition.abort();
            }
        }
    });
    
    // Submit correction button click
    document.getElementById('submit-correction').addEventListener('click', function() {
        const correctionInput = document.getElementById('correction-input');
        if (correctionInput.value.trim()) {
            handleUserCorrection(correctionInput.value.trim());
        }
    });
    
    // Correction input Enter key press
    document.getElementById('correction-input').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            const correctionInput = document.getElementById('correction-input');
            if (correctionInput.value.trim()) {
                handleUserCorrection(correctionInput.value.trim());
            }
        }
    });
}

// Set up form submission handlers
function setupFormHandlers() {
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(event) {
            // For debugging purposes only
            console.log('Form submitted:');
            console.log('Action:', this.action);
            console.log('Method:', this.method);
            
            // Check for CSRF token
            const token = document.querySelector('input[name="_token"]');
            if (!token || !token.value) {
                event.preventDefault();
                console.error('CSRF token missing');
                alert('Erreur: CSRF token manquant. Veuillez rafraîchir la page et réessayer.');
                return false;
            }
            
            // Log form data being submitted
            const formData = new FormData(this);
            console.log('Form data:');
            for (let pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }
            
            // Allow form submission to continue
            return true;
        });
    }
}

// Add required CSS for animations
function addChatbotStyles() {
    if (!document.getElementById('chatbot-animations')) {
        const style = document.createElement('style');
        style.id = 'chatbot-animations';
        style.textContent = `
            .message-enter {
                animation: messageEnter 0.3s ease-out;
            }
            
            @keyframes messageEnter {
                from { transform: translateY(10px); opacity: 0; }
                to { transform: translateY(0); opacity: 1; }
            }
            
            #chatbot-container.hidden {
                display: none;
            }
            
            #chatbot-container {
                transition: transform 0.3s ease, opacity 0.3s ease;
            }
        `;
        document.head.appendChild(style);
    }
}

// Check for browser support of required APIs
function checkBrowserCompatibility() {
    const compatibilityIssues = [];
    
    // Check for SpeechRecognition
    if (!window.SpeechRecognition && !window.webkitSpeechRecognition) {
        compatibilityIssues.push("La reconnaissance vocale n'est pas prise en charge par votre navigateur.");
    }
    
    // Check for SpeechSynthesis
    if (!window.speechSynthesis) {
        compatibilityIssues.push("La synthèse vocale n'est pas prise en charge par votre navigateur.");
    }
    
    // Display compatibility issues if any
    if (compatibilityIssues.length > 0) {
        console.error("Problèmes de compatibilité:", compatibilityIssues);
        
        // Show warning in chatbot container when opened
    const chatbotContainer = document.getElementById('chatbot-container');
    if (chatbotContainer) {
            const warningBanner = document.createElement('div');
            warningBanner.className = 'bg-yellow-100 text-yellow-800 px-4 py-2 text-sm border-b border-yellow-200';
            warningBanner.innerHTML = `
                <div class="flex items-center">
                    <i class="fas fa-exclamation-triangle text-yellow-600 mr-2"></i>
                    <span>Votre navigateur pourrait ne pas prendre en charge correctement la reconnaissance vocale. 
                    Utilisez Chrome pour de meilleurs résultats.</span>
                </div>
            `;
            
            // Insert after the header
            const header = chatbotContainer.querySelector('.bg-blue-600');
            if (header && header.nextSibling) {
                chatbotContainer.insertBefore(warningBanner, header.nextSibling);
            }
        }
    }
    
    // Check if using mobile device
    const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    if (isMobile) {
        console.log("Detected mobile device - optimizing for mobile experience");
        // Add mobile-specific adjustments if needed
    }
    
    return compatibilityIssues.length === 0;
}

// Show the chatbot interface with animation
function showChatbot() {
    const chatbotContainer = document.getElementById('chatbot-container');
    
    // Make sure the chatbot is visible before animating
    chatbotContainer.classList.remove('hidden', 'scale-95', 'opacity-0');
    chatbotContainer.classList.add('opacity-100', 'scale-100');
    
    // Force a repaint to trigger animation
    void chatbotContainer.offsetWidth;
}

// Hide the chatbot interface with animation
function hideChatbot() {
    const chatbotContainer = document.getElementById('chatbot-container');
    chatbotContainer.classList.add('scale-95', 'opacity-0');
    
    // Remove the element from the DOM after animation completes
    setTimeout(() => {
        chatbotContainer.classList.add('hidden');
    }, 300);
}

// Start the voice interaction flow
function startVoiceInteraction() {
    resetChatbot();
    
    // Check for microphone permission
    checkMicrophonePermission()
        .then(hasPermission => {
            if (hasPermission) {
                // Add welcome message
                addMessage(config.prompts.welcome, "assistant");
                updateStatus(config.prompts.readyToListen);
            } else {
                addMessage("Pour utiliser l'assistant vocal, veuillez autoriser l'accès au microphone dans votre navigateur.", "assistant");
                updateStatus("Microphone non autorisé");
            }
        });
}

// Continue voice interaction based on current state
function continueVoiceInteraction() {
    // Prevent multiple clicks
    if (processingVoice) return;
    processingVoice = true;
    
    // Hide any manual controls or buttons
    document.getElementById('manual-controls').classList.add('hidden');
    removeQuickResponseButtons();
    
    // Determine which question to ask next
    if (!contactInfo.name) {
        askForName();
    } else if (!contactInfo.email) {
        askForEmail();
    } else if (!contactInfo.phone) {
        askForPhone();
    } else if (!contactInfo.category) {
        askForCategory();
    } else {
        confirmContactDetails();
    }
}

// Reset the chatbot to initial state
function resetChatbot() {
    // Reset the contact info
    contactInfo = {
        name: '',
        email: '',
        phone: '',
        category: ''
    };
    
    // Clear any ongoing speech synthesis and recognition
    window.speechSynthesis.cancel();
    if (window.currentRecognition) {
        try {
            window.currentRecognition.abort();
        } catch (e) {
            console.log("Error aborting recognition", e);
        }
        window.currentRecognition = null;
    }
    
    // Reset UI
    const messageArea = document.getElementById('chatbot-messages');
    if (messageArea) {
        messageArea.innerHTML = '';
    }
    
    // Remove quick response buttons
    removeQuickResponseButtons();
    
    // Reset state
    document.getElementById('mic-animation').classList.add('hidden');
    document.getElementById('manual-controls').classList.add('hidden');
    
    // Reset status message
    updateStatus("Cliquez sur le microphone pour commencer");
    
    // Reset flags
    isListening = false;
    processingVoice = false;
    currentStep = '';
}

// Add a new message to the chat
function addMessage(text, sender) {
    const messageArea = document.getElementById('chatbot-messages');
    if (!messageArea) return;
    
    const messageElement = document.createElement('div');
    messageElement.className = `${sender}-message message-enter`;
    
    const messageClasses = sender === 'assistant' 
        ? 'bg-blue-50 text-gray-800 border-l-4 border-blue-500 rounded-r-lg py-2 px-3 mb-3'
        : 'bg-blue-500 text-white rounded-lg py-2 px-4 mb-3 ml-auto';
        
    messageElement.className += ' ' + messageClasses;
    
    // Format text with line breaks
    text = text.replace(/\n/g, '<br>');
    messageElement.innerHTML = text;
    
    messageArea.appendChild(messageElement);
    messageArea.scrollTop = messageArea.scrollHeight;
}

// Update the status display
function updateStatus(text) {
    const statusIndicator = document.getElementById('voice-status');
    if (statusIndicator) {
        statusIndicator.textContent = text;
    }
}

// Show/hide the microphone animation
function showListeningAnimation(show) {
    const micAnimation = document.getElementById('mic-animation');
    if (micAnimation) {
        if (show) {
            micAnimation.classList.remove('hidden');
        } else {
            micAnimation.classList.add('hidden');
        }
    }
}

// Show manual correction controls
function showManualControls(show, placeholder = 'Corriger la réponse...') {
    const controlsContainer = document.getElementById('manual-controls');
    const input = document.getElementById('correction-input');
    
    if (controlsContainer && input) {
        if (show) {
            controlsContainer.classList.remove('hidden');
        } else {
            controlsContainer.classList.add('hidden');
        }
        
        input.placeholder = placeholder;
        input.value = lastRecognizedText;
        input.focus();
        input.select();
    }
}

// Process email from voice recognition
function processEmail(email) {
    // Remove any trailing periods which often get added by speech recognition
    email = email.trim().replace(/\.$/, '');
    
    // Convert French number words to digits
    const numberWords = {
        'un': '1', 'une': '1', 'deux': '2', 'trois': '3', 'quatre': '4', 
        'cinq': '5', 'six': '6', 'sept': '7', 'huit': '8', 'neuf': '9', 'zero': '0'
    };
    
    // Replace number words with digits
    Object.keys(numberWords).forEach(word => {
        const regex = new RegExp(`\\b${word}\\b`, 'gi');
        email = email.replace(regex, numberWords[word]);
    });
    
    return email.toLowerCase()
        .replace(/ point /g, '.')
        .replace(/ dot /g, '.')
        .replace(/ at /g, '@')
        .replace(/ arobase /g, '@')
        .replace(/ a commercial /g, '@')
        .replace(/ underscore /g, '_')
        .replace(/ tiret bas /g, '_')
        .replace(/ tiret /g, '-')
        .replace(/ dash /g, '-')
        .replace(/ hyphen /g, '-')
        .replace(/underscore/g, '_')
        .replace(/arobase/g, '@')
        .replace(/at/g, '@')
        .replace(/dot/g, '.')
        .replace(/point/g, '.')
        .replace(/,/g, '.') // Replace commas with periods (common error in emails)
        .replace(/\s+/g, '');
}

// Normalize category from text input
function normalizeCategoryFromText(text) {
    const normalizedText = text.toLowerCase().trim();
    
    // Define keyword mappings
    const categoryMappings = {
        'ami': ['ami', 'amie', 'amis', 'copain', 'pote'],
        'famille': ['famille', 'familial', 'parent', 'parents', 'frère', 'sœur', 'soeur'],
        'professionnel': ['pro', 'professionnel', 'professionnelle', 'travail', 'business', 'client'],
        'collegue': ['collègue', 'collegue', 'collège', 'college', 'travail', 'bureau', 'boulot']
    };
    
    // Check against each category's keywords
    for (const [category, keywords] of Object.entries(categoryMappings)) {
        if (keywords.some(keyword => normalizedText.includes(keyword))) {
            return category;
        }
    }
    
    // Default to ami if not recognized
    return 'ami';
}

// Handle user correction from manual input
function handleUserCorrection(text) {
    // Update the last message in the chat (the user message)
    const messages = document.getElementById('chatbot-messages').children;
    const lastUserMessage = Array.from(messages).filter(el => el.classList.contains('user-message')).pop();
    
    if (lastUserMessage) {
        lastUserMessage.innerHTML = text;
    } else {
        // If no user message exists, add one
        addMessage(text, "user");
    }
    
    // Process the corrected input based on the current step
    if (currentStep === 'name') {
        contactInfo.name = text.trim();
        setTimeout(() => askForEmail(), MEDIUM_DELAY);
    } else if (currentStep === 'email') {
        contactInfo.email = processEmail(text);
        setTimeout(() => askForPhone(), MEDIUM_DELAY);
    } else if (currentStep === 'phone') {
        contactInfo.phone = text.replace(/\D/g, '');
        setTimeout(() => askForCategory(), MEDIUM_DELAY);
    } else if (currentStep === 'category') {
        contactInfo.category = normalizeCategoryFromText(text);
        setTimeout(() => confirmContactDetails(), MEDIUM_DELAY);
    } else if (currentStep === 'confirm') {
        const response = text.toLowerCase().trim();
        const confirmWords = ['oui', 'yes', 'ok', 'confirme', 'accepte', 'valide', "d'accord"];
        const isConfirmation = confirmWords.some(word => response.includes(word));
        
        if (isConfirmation) {
            addContact(contactInfo.name, contactInfo.email, contactInfo.phone, contactInfo.category);
        } else {
            addMessage("Ajout de contact annulé.", "assistant");
            speak("Ajout de contact annulé.");
            updateStatus("Contact non ajouté");
            
            // Reset after a short delay
            setTimeout(() => {
                resetChatbot();
                startVoiceInteraction();
            }, 3000);
        }
    }
    
    // Hide the manual controls
    showManualControls(false);
}

// Ask for the contact name
function askForName() {
    currentStep = 'name';
    processingVoice = true;
        
        setTimeout(() => {
        updateStatus(config.prompts.readyToListen);
        addMessage(config.prompts.askName, "assistant");
            
            setTimeout(() => {
            speak(config.prompts.askName)
                .then(() => {
                    setTimeout(() => {
                        updateStatus(config.prompts.listening);
                showListeningAnimation(true);
                listen()
                    .then(name => {
                                processingVoice = false;
                        lastRecognizedText = name.trim();
                        contactInfo.name = lastRecognizedText;
                        addMessage(contactInfo.name, "user");
                        updateStatus("Nom reconnu. Correction possible.");
                        showListeningAnimation(false);
                        
                        // Allow for manual correction
                                showManualControls(true, config.placeholders.nameCorrection);
                        
                        // Continue after a delay if no correction
                        setTimeout(() => {
                                    if (!document.getElementById('manual-controls').classList.contains('hidden')) {
                                showManualControls(false);
                                askForEmail();
                            }
                        }, 5000);
                    })
                    .catch(error => {
                                processingVoice = false;
                        handleVoiceError(error);
                    });
            }, SHORT_DELAY);
                });
        }, SHORT_DELAY);
    }, SHORT_DELAY);
}

// Ask for the contact email
function askForEmail() {
    currentStep = 'email';
    processingVoice = true;
        
        setTimeout(() => {
        updateStatus(config.prompts.readyToListen);
        addMessage(config.prompts.askEmail, "assistant");
            
            setTimeout(() => {
            speak(config.prompts.askEmail)
                .then(() => {
                    setTimeout(() => {
                        updateStatus(config.prompts.listening);
                showListeningAnimation(true);
                listen()
                    .then(email => {
                                processingVoice = false;
                                // Process the email - convert spelled-out characters and fix common errors
                                let processedEmail = processEmail(email);
                        lastRecognizedText = email;
                                
                                // Explicitly check if the email contains a comma and fix it
                                if (processedEmail.includes(',')) {
                                    const originalEmail = processedEmail;
                                    processedEmail = processedEmail.replace(/,/g, '.');
                                    
                                    // Add a message to show the correction
                                    addMessage(`${originalEmail} → ${processedEmail} (correction automatique)`, "user");
                                    setTimeout(() => {
                                        addMessage("<div class='flex items-center'><i class='fas fa-info-circle text-blue-500 mr-2'></i> J'ai corrigé l'email en remplaçant la virgule par un point.</div>", "assistant");
                                    }, 500);
                                } else {
                                    // No correction needed
                                    addMessage(processedEmail, "user");
                                }
                                
                                // Validate email format
                                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                                if (!emailRegex.test(processedEmail)) {
                                    addMessage("<div class='flex items-center'><i class='fas fa-exclamation-triangle text-yellow-500 mr-2'></i> Le format de l'email semble incorrect. Veuillez le corriger.</div>", "assistant");
                                    updateStatus("Format d'email invalide");
                                } else {
                        updateStatus("Email reconnu. Correction possible.");
                                }
                                
                                // Store the processed email
                                contactInfo.email = processedEmail;
                                
                        showListeningAnimation(false);
                        
                        // Allow for manual correction
                                showManualControls(true, config.placeholders.emailCorrection);
                        
                        // Continue after a delay if no correction
                        setTimeout(() => {
                                    if (!document.getElementById('manual-controls').classList.contains('hidden')) {
                                showManualControls(false);
                                askForPhone();
                            }
                        }, 5000);
                    })
                    .catch(error => {
                                processingVoice = false;
                        handleVoiceError(error);
                    });
            }, SHORT_DELAY);
                });
        }, SHORT_DELAY);
    }, MEDIUM_DELAY);
}

// Ask for the contact phone number
function askForPhone() {
    currentStep = 'phone';
    processingVoice = true;
        
        setTimeout(() => {
        updateStatus(config.prompts.readyToListen);
        addMessage(config.prompts.askPhone, "assistant");
            
            setTimeout(() => {
            speak(config.prompts.askPhone)
                .then(() => {
                    setTimeout(() => {
                        updateStatus(config.prompts.listening);
                showListeningAnimation(true);
                listen()
                    .then(phone => {
                                processingVoice = false;
                        // Process the phone number
                        lastRecognizedText = phone;
                        
                                // Process phone number - convert number words to digits
                                const processedPhone = processPhoneNumber(phone);
                                contactInfo.phone = processedPhone;
                        
                        // Format for display
                                addMessage(phone + (phone !== processedPhone ? ` → ${processedPhone}` : ""), "user");
                                updateStatus("Téléphone reconnu. Correction possible.");
                        showListeningAnimation(false);
                        
                        // Allow for manual correction
                                showManualControls(true, config.placeholders.phoneCorrection);
                        
                        // Continue after a delay if no correction
                        setTimeout(() => {
                                    if (!document.getElementById('manual-controls').classList.contains('hidden')) {
                                showManualControls(false);
                                askForCategory();
                            }
                        }, 5000);
                    })
                    .catch(error => {
                                processingVoice = false;
                        handleVoiceError(error);
                    });
            }, SHORT_DELAY);
                });
        }, SHORT_DELAY);
    }, MEDIUM_DELAY);
}

// Process phone number from voice recognition
function processPhoneNumber(phone) {
    // Remove any trailing periods which often get added by speech recognition
    phone = phone.trim().replace(/\.$/, '');
    
    // Convert French number words to digits
    const numberWords = {
        'un': '1', 'une': '1', 'deux': '2', 'trois': '3', 'quatre': '4', 
        'cinq': '5', 'six': '6', 'sept': '7', 'huit': '8', 'neuf': '9', 'zero': '0',
        'zéro': '0'
    };
    
    // Replace number words with digits
    Object.keys(numberWords).forEach(word => {
        const regex = new RegExp(`\\b${word}\\b`, 'gi');
        phone = phone.replace(regex, numberWords[word]);
    });
    
    // Remove all non-digit characters
    return phone.replace(/\D/g, '');
}

// Ask for the contact category
function askForCategory() {
    currentStep = 'category';
    processingVoice = true;
        
        setTimeout(() => {
        updateStatus(config.prompts.readyToListen);
        addMessage(config.prompts.askCategory, "assistant");
            
            setTimeout(() => {
            speak(config.prompts.askCategory)
                .then(() => {
                    setTimeout(() => {
                        updateStatus(config.prompts.listening);
                showListeningAnimation(true);
                listen()
                    .then(category => {
                                processingVoice = false;
                        lastRecognizedText = category;
                        
                        // Normalize the category
                                const normalizedCategory = normalizeCategoryFromText(category);
                        
                        contactInfo.category = normalizedCategory;
                        addMessage(category + " (→ " + normalizedCategory + ")", "user");
                        updateStatus("Catégorie reconnue. Correction possible.");
                        showListeningAnimation(false);
                        
                        // Allow for manual correction
                                showManualControls(true, config.placeholders.categoryCorrection);
                        
                        // Continue after a delay if no correction
                        setTimeout(() => {
                                    if (!document.getElementById('manual-controls').classList.contains('hidden')) {
                                showManualControls(false);
                                confirmContactDetails();
                            }
                        }, 5000);
                    })
                    .catch(error => {
                                processingVoice = false;
                        handleVoiceError(error);
                    });
            }, SHORT_DELAY);
                });
        }, SHORT_DELAY);
    }, MEDIUM_DELAY);
}

// Confirm contact details before saving
function confirmContactDetails() {
    currentStep = 'confirm';
    processingVoice = true;
    
    // Validate and correct the email before confirmation
    if (contactInfo.email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(contactInfo.email)) {
            // Try to fix the email
            const fixedEmail = contactInfo.email.replace(/,/g, '.');
            
            // If it's now valid after fixing
            if (emailRegex.test(fixedEmail)) {
                contactInfo.email = fixedEmail;
                // No need for message here as we'll show the corrected value in the summary
            }
        }
    }
    
    // Format the contact info for display
        const summary = `<strong>Nom:</strong> ${contactInfo.name}<br>
<strong>Email:</strong> ${contactInfo.email}<br>
<strong>Téléphone:</strong> ${contactInfo.phone}<br>
<strong>Catégorie:</strong> ${contactInfo.category}`;

    // Clear any previous messages that might cause confusion
    const messageArea = document.getElementById('chatbot-messages');
    const previousConfirmMessages = Array.from(messageArea.children).filter(el => 
        el.innerHTML.includes(config.prompts.confirmDetails) || 
        el.innerHTML.includes("Enregistrement en cours")
    );
    
    // Remove previous confirmation messages to avoid confusion
    previousConfirmMessages.forEach(el => el.remove());

    addMessage(`${config.prompts.confirmDetails}<br>${summary}<br><br>${config.prompts.confirmQuestion}`, "assistant");
            
            setTimeout(() => {
                updateStatus("Attente de confirmation...");
        speak(`${config.prompts.confirmDetails} ${config.prompts.confirmQuestion}`)
            .then(() => {
                setTimeout(() => {
                    updateStatus(config.prompts.listening);
                showListeningAnimation(true);
                    
                    // Add a button for quick yes/no response
                    addQuickResponseButtons();
                    
                listen()
                    .then(response => {
                            removeQuickResponseButtons();
                            processingVoice = false;
                        lastRecognizedText = response;
                        const normalizedResponse = response.toLowerCase().trim();
                        
                        addMessage(response, "user");
                            updateStatus("Réponse reconnue");
                        showListeningAnimation(false);
                        
                        // Determine if this is a confirmation
                            const isConfirmation = config.confirmWords.some(word => normalizedResponse.includes(word));
                            const isRejection = ['non', 'no', 'annuler', 'cancel'].some(word => normalizedResponse.includes(word));
                        
                        if (isConfirmation) {
                            addContact(contactInfo.name, contactInfo.email, contactInfo.phone, contactInfo.category);
                            } else if (isRejection) {
                            addMessage("Ajout de contact annulé. Cliquez sur le microphone pour recommencer.", "assistant");
                            speak("Ajout de contact annulé.");
                            updateStatus("Contact non ajouté");
                                
                                // Reset after a short delay
                                setTimeout(() => resetChatbot(), 3000);
                            } else {
                                // Ambiguous response - ask for clarification
                                addMessage("Je n'ai pas compris votre réponse. Veuillez répondre par 'Oui' pour confirmer ou 'Non' pour annuler.", "assistant");
                                speak("Je n'ai pas compris votre réponse. Veuillez répondre par Oui pour confirmer ou Non pour annuler.");
                                setTimeout(() => confirmContactDetails(), 3000);
                        }
                    })
                    .catch(error => {
                            removeQuickResponseButtons();
                            processingVoice = false;
                        handleVoiceError(error);
                            
                            // Add yes/no buttons for manual confirmation
                            addManualConfirmationButtons();
                    });
            }, SHORT_DELAY);
            })
            .catch(error => {
                console.error("Speech synthesis error:", error);
                processingVoice = false;
                // Fallback if speech synthesis fails
                updateStatus("Attente de confirmation...");
                addManualConfirmationButtons();
            });
        }, SHORT_DELAY);
}

// Add buttons for quick yes/no response
function addQuickResponseButtons() {
    const controlsContainer = document.getElementById('manual-controls');
    if (!controlsContainer) return;
    
    // Create confirmation buttons container
    const confirmButtons = document.createElement('div');
    confirmButtons.id = 'confirm-buttons';
    confirmButtons.className = 'flex justify-center space-x-4 mb-2';
    
    // Yes button
    const yesButton = document.createElement('button');
    yesButton.type = 'button';
    yesButton.className = 'bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 focus:outline-none transition-colors';
    yesButton.innerHTML = '<i class="fas fa-check mr-2"></i>Oui';
    yesButton.onclick = function() {
        addMessage("Oui", "user");
        addContact(contactInfo.name, contactInfo.email, contactInfo.phone, contactInfo.category);
        removeQuickResponseButtons();
    };
    
    // No button
    const noButton = document.createElement('button');
    noButton.type = 'button';
    noButton.className = 'bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 focus:outline-none transition-colors';
    noButton.innerHTML = '<i class="fas fa-times mr-2"></i>Non';
    noButton.onclick = function() {
        addMessage("Non", "user");
        addMessage("Ajout de contact annulé. Cliquez sur le microphone pour recommencer.", "assistant");
        speak("Ajout de contact annulé.");
        updateStatus("Contact non ajouté");
        removeQuickResponseButtons();
        setTimeout(() => resetChatbot(), 3000);
    };
    
    confirmButtons.appendChild(yesButton);
    confirmButtons.appendChild(noButton);
    
    // Insert before the manual controls
    controlsContainer.parentNode.insertBefore(confirmButtons, controlsContainer);
}

// Remove quick response buttons
function removeQuickResponseButtons() {
    const confirmButtons = document.getElementById('confirm-buttons');
    if (confirmButtons) {
        confirmButtons.remove();
    }
}

// Add manual confirmation buttons when voice fails
function addManualConfirmationButtons() {
    removeQuickResponseButtons(); // Remove any existing buttons first
    addQuickResponseButtons(); // Add the buttons
    
    // Show the buttons
    const confirmButtons = document.getElementById('confirm-buttons');
    if (confirmButtons) {
        confirmButtons.style.display = 'flex';
    }
}

// Start the voice interaction flow with better initialization
function startVoiceInteraction() {
    resetChatbot();
    
    // Check for microphone permission
    checkMicrophonePermission()
        .then(hasPermission => {
            if (hasPermission) {
                // Add welcome message
                addMessage(config.prompts.welcome, "assistant");
                updateStatus(config.prompts.readyToListen);
            } else {
                addMessage("Pour utiliser l'assistant vocal, veuillez autoriser l'accès au microphone dans votre navigateur.", "assistant");
                updateStatus("Microphone non autorisé");
            }
        });
}

// Check if microphone permission is granted
function checkMicrophonePermission() {
    return new Promise((resolve) => {
        if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
            console.warn("getUserMedia not supported");
            resolve(false);
            return;
        }
        
        navigator.mediaDevices.getUserMedia({ audio: true })
            .then(stream => {
                // Stop all tracks immediately after getting permission
                stream.getTracks().forEach(track => track.stop());
                resolve(true);
            })
            .catch(error => {
                console.error("Microphone permission error:", error);
                resolve(false);
            });
    });
}

// Improved error handling for voice recognition
function handleVoiceError(error) {
    console.error('Speech recognition error type:', error);
    showListeningAnimation(false);
    
    // Different error messages based on the error type
    let errorMessage = config.prompts.errorUnderstanding;
    
    if (error === 'no-speech') {
        errorMessage = "Je n'ai pas entendu votre voix. Veuillez parler plus fort ou vérifier votre microphone.";
        updateStatus("Aucune voix détectée");
    } else if (error === 'aborted') {
        errorMessage = "La reconnaissance vocale a été interrompue.";
        updateStatus("Reconnaissance interrompue");
    } else if (error === 'network') {
        errorMessage = "Problème de connexion réseau. Veuillez vérifier votre connexion internet.";
        updateStatus("Erreur réseau");
    } else if (error === 'no-final-result') {
        errorMessage = "Je n'ai pas bien compris. Pourriez-vous répéter plus clairement?";
        updateStatus("Voix détectée mais pas comprise");
    } else {
        updateStatus("Erreur de reconnaissance vocale");
    }
    
    addMessage(errorMessage, "assistant");
    speak(errorMessage);
    
    // Show manual input interface
    showManualControls(true);
    
    // Reset listening state
    isListening = false;
    processingVoice = false;
}

// Better form submission to save contact information
function addContact(name, email, phone, category) {
    // Validate input before sending to server
    if (!name || !email || !phone || !category) {
        const errorMessage = "Informations de contact incomplètes. Veuillez réessayer.";
        addMessage('<div class="flex items-center"><i class="fas fa-exclamation-circle text-red-500 mr-2"></i> ' + errorMessage + '</div>', "assistant");
        speak(errorMessage);
        updateStatus("Données incomplètes");
        return;
    }
    
    // Validate email format before submission
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        // Try to fix the email
        const fixedEmail = email.replace(/,/g, '.');
        
        // If it's still invalid after fixing
        if (!emailRegex.test(fixedEmail)) {
            const errorMessage = "Le format de l'email est invalide. Veuillez le corriger.";
            addMessage('<div class="flex items-center"><i class="fas fa-exclamation-circle text-red-500 mr-2"></i> ' + errorMessage + '</div>', "assistant");
            speak(errorMessage);
            updateStatus("Email invalide");
            
            // Show manual correction for email
            currentStep = 'email';
            contactInfo.email = email;
            lastRecognizedText = email;
            showManualControls(true, "Corriger l'email (format invalide)");
            return;
        } else {
            // Use the fixed email
            email = fixedEmail;
            contactInfo.email = fixedEmail;
        }
    }

    // Validate phone format (should be numbers only)
    const phoneDigits = phone.replace(/\D/g, '');
    if (phoneDigits.length < 8) {
        const errorMessage = "Le numéro de téléphone semble trop court. Veuillez le vérifier.";
        addMessage('<div class="flex items-center"><i class="fas fa-exclamation-circle text-red-500 mr-2"></i> ' + errorMessage + '</div>', "assistant");
        speak(errorMessage);
        updateStatus("Téléphone invalide");
        
        // Show manual correction for phone
        currentStep = 'phone';
        contactInfo.phone = phone;
        lastRecognizedText = phone;
        showManualControls(true, "Corriger le numéro de téléphone");
        return;
    }
    
    updateStatus("Ajout du contact en cours...");
    
    // Show loading message with animation
    addMessage('<div class="flex items-center"><div class="animate-spin mr-2 h-4 w-4 border-t-2 border-b-2 border-blue-500 rounded-full"></div> Enregistrement en cours...</div>', "assistant");
    
    // Try to use the form submission first, which is more reliable
    tryFormSubmission(name, email, phone, category);
}

// Try direct AJAX submission if form submission fails
function directSubmission(name, email, phone, category) {
    // Get the CSRF token
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Show loading message
    addMessage('<div class="flex items-center"><i class="fas fa-sync text-blue-500 mr-2 animate-spin"></i> Tentative d\'ajout direct...</div>', "assistant");
    
    // Create form data
    const formData = new FormData();
    formData.append('name', name);
    formData.append('email', email);
    formData.append('phone', phone);
    formData.append('category', category);
    formData.append('source', 'chatbot_direct');
    formData.append('_token', token);
    
    // Log what we're sending
    console.log('Sending contact data via AJAX:', {
        name,
        email,
        phone,
        category,
        token: token ? 'Present' : 'Missing'
    });
    
    // Send AJAX request
    fetch('/contacts', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Contact added successfully:', data);
        addMessage('<div class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-2"></i> Contact ajouté avec succès!</div>', "assistant");
        speak("Contact ajouté avec succès!");
        
        setTimeout(() => {
            // Refresh the page to show the new contact
            window.location.reload();
        }, 2000);
    })
    .catch(error => {
        console.error('Error adding contact:', error);
        addMessage('<div class="flex items-center"><i class="fas fa-exclamation-circle text-red-500 mr-2"></i> Erreur lors de l\'ajout du contact. Essayez de soumettre manuellement.</div>', "assistant");
        speak("Une erreur est survenue. Veuillez essayer d'ajouter le contact manuellement.");
        
        // Fallback to manual form
        tryFormSubmission(name, email, phone, category);
    });
}

// Add option to try direct submission in the tryFormSubmission function
function tryFormSubmission(name, email, phone, category) {
    addMessage('<div class="flex items-center"><i class="fas fa-sync text-blue-500 mr-2 animate-spin"></i> Utilisation du formulaire pour ajouter le contact...</div>', "assistant");
    
    const contactForm = document.getElementById('contactForm');
    
    if (!contactForm) {
        addMessage('<div class="flex items-center"><i class="fas fa-exclamation-circle text-red-500 mr-2"></i> Impossible de trouver le formulaire. Tentative d\'ajout direct...</div>', "assistant");
        directSubmission(name, email, phone, category);
        return;
    }
    
    // First, open the modal but don't reset the form
    openAddModalWithoutReset();
    
    // Then fill in the form
    setTimeout(() => {
        document.getElementById('name').value = name;
        document.getElementById('email').value = email;
        document.getElementById('phone').value = phone;
        document.getElementById('category').value = category;
        
        // Add a hidden field to track that this submission came from the chatbot
        let sourceInput = document.querySelector('input[name="source"]');
        if (sourceInput) {
            sourceInput.value = "chatbot";
        } else {
            sourceInput = document.createElement('input');
            sourceInput.type = 'hidden';
            sourceInput.name = 'source';
            sourceInput.value = 'chatbot';
            contactForm.appendChild(sourceInput);
        }
        
        console.log("Form filled with:", {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            phone: document.getElementById('phone').value,
            category: document.getElementById('category').value,
            source: sourceInput.value
        });
        
        // Let the user know what's happening
        addMessage('<div class="flex items-center"><i class="fas fa-info-circle text-blue-500 mr-2"></i> Le formulaire a été pré-rempli. Veuillez vérifier les informations et cliquer sur Enregistrer.</div>', "assistant");
        speak("Le formulaire a été pré-rempli avec les informations du contact. Veuillez vérifier et cliquer sur Enregistrer.");
        
        // Add submit handler to capture form submission result
        contactForm.addEventListener('submit', function(event) {
            // Don't add multiple handlers
            if (this.getAttribute('data-has-submit-handler')) return;
            this.setAttribute('data-has-submit-handler', 'true');
            
            // Add success feedback
            addMessage('<div class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-2"></i> Formulaire soumis avec succès!</div>', "assistant");
        });
        
        // Focus on the submit button
        const submitButton = contactForm.querySelector('button[type="submit"]');
        if (submitButton) {
            submitButton.focus();
            // Add a highlighting effect
            submitButton.classList.add('ring', 'ring-blue-300', 'animate-pulse');
            setTimeout(() => {
                submitButton.classList.remove('ring', 'ring-blue-300', 'animate-pulse');
            }, 3000);
        }
        
        // Add options for form interaction at the bottom of the form
        const formActions = contactForm.querySelector('.flex.justify-end, .justify-end');
        if (formActions) {
            const quickActionsDiv = document.createElement('div');
            quickActionsDiv.className = 'mb-4 flex items-center space-x-2 mt-4';
            quickActionsDiv.innerHTML = `
                <button id="auto-submit-form" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 focus:outline-none">
                    <i class="fas fa-check mr-2"></i>Soumettre automatiquement
                </button>
                <button id="direct-submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 focus:outline-none">
                    <i class="fas fa-bolt mr-2"></i>Soumettre directement (AJAX)
                </button>
            `;
            
            // Insert before the form actions
            formActions.parentNode.insertBefore(quickActionsDiv, formActions);
            
            // Add click handler to auto-submit button
            document.getElementById('auto-submit-form').addEventListener('click', function(e) {
                e.preventDefault();
                
                // Show submitting message
                addMessage('<div class="flex items-center"><i class="fas fa-paper-plane text-blue-500 mr-2"></i> Envoi automatique du formulaire...</div>', "assistant");
                
                // Submit the form
                submitButton.click();
            });
            
            // Add click handler for direct submission
            document.getElementById('direct-submit').addEventListener('click', function(e) {
                e.preventDefault();
                
                // Close the modal
                closeModal();
                
                // Try direct submission
                directSubmission(name, email, phone, category);
            });
        }
    }, 500); // Increased delay to ensure DOM is ready
}

// Function to open the contact modal without resetting the form
function openAddModalWithoutReset() {
    document.getElementById('contactModal').classList.remove('hidden');
    document.getElementById('modalTitle').textContent = 'Nouveau contact';
    // Don't reset the form
    document.getElementById('contactForm').action = "{{ route('contacts.store') }}";
    document.getElementById('contactForm').method = 'POST';
}

// Original function to open the contact modal
function openAddModal() {
    document.getElementById('contactModal').classList.remove('hidden');
    document.getElementById('modalTitle').textContent = 'Nouveau contact';
    document.getElementById('contactForm').reset();
    document.getElementById('contactForm').action = "{{ route('contacts.store') }}";
    document.getElementById('contactForm').method = 'POST';
}

// Function to close the modal
function closeModal(modalId = 'contactModal') {
    // If a specific modal ID is provided, use it, otherwise default to contactModal
    const modalToClose = modalId || 'contactModal';
    
    // Hide the modal
    document.getElementById(modalToClose).classList.add('hidden');
    
    // Reset the form after a short delay (to allow animation to complete)
    if (modalToClose === 'contactModal') {
        setTimeout(() => {
            const form = document.getElementById('contactForm');
            if (form) {
                // Reset form fields
                form.reset();
                
                // Reset form action and method to default (for adding new contacts)
                form.action = "{{ route('contacts.store') }}";
                form.method = 'POST';
                
                // Remove any method override (for PUT/DELETE)
                const methodInput = form.querySelector('input[name="_method"]');
                if (methodInput) {
                    methodInput.remove();
                }
                
                // Reset the modal title
                document.getElementById('modalTitle').textContent = 'Nouveau contact';
                
                // Remove any custom buttons or elements added for edit
                const customElements = document.querySelectorAll('.custom-modal-element');
                customElements.forEach(element => element.remove());
                
                console.log('Modal closed and form reset');
            }
        }, 100);
    } else if (modalToClose === 'acceptSharedContactModal') {
        document.getElementById(modalToClose).classList.add('hidden');
        openSharedContactsModal();
    } else if (modalToClose === 'sharedContactsModal') {
        document.getElementById(modalToClose).classList.add('hidden');
        // Optional: reload the page
        // location.reload();
    } else {
        document.getElementById(modalToClose).classList.add('hidden');
    }
}

// Function to delete a contact
function deleteContact(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce contact ?')) {
        // Create a form element for proper submission
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/contacts/${id}`;
        form.style.display = 'none';
        
        // Add CSRF token
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        form.appendChild(csrfInput);
        
        // Add method DELETE
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        form.appendChild(methodInput);
        
        // Append to document and submit
        document.body.appendChild(form);
        form.submit();
    }
}

// Function to open edit modal for a contact
function openEditModal(id) {
    // Show a loading indicator
    const loadingIndicator = document.createElement('div');
    loadingIndicator.className = 'fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50';
    loadingIndicator.innerHTML = `
        <div class="bg-white p-5 rounded-lg shadow-lg">
            <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-blue-600 mx-auto"></div>
            <p class="mt-2 text-gray-800">Chargement...</p>
        </div>
    `;
    document.body.appendChild(loadingIndicator);
    
    // Get the CSRF token from meta tag
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    fetch(`/contacts/${id}/edit`, {
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': token
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        // Remove loading indicator
        document.body.removeChild(loadingIndicator);
        
        document.getElementById('contactModal').classList.remove('hidden');
        document.getElementById('modalTitle').textContent = 'Modifier le contact';
        
        // Fill form with contact data
        document.getElementById('name').value = data.name || '';
        document.getElementById('email').value = data.email || '';
        document.getElementById('phone').value = data.phone || '';
        document.getElementById('category').value = data.category || 'ami';
        
        // Change form action for update
        const form = document.getElementById('contactForm');
        form.action = `/contacts/${id}`;
        form.method = 'POST';
        
        // Add method PUT
        let methodInput = document.querySelector('input[name="_method"]');
        if (!methodInput) {
            methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            form.appendChild(methodInput);
        }
        methodInput.value = 'PUT';
        
        // Make sure we have a CSRF token
        let tokenInput = document.querySelector('input[name="_token"]');
        if (!tokenInput) {
            tokenInput = document.createElement('input');
            tokenInput.type = 'hidden';
            tokenInput.name = '_token';
            form.appendChild(tokenInput);
        }
        tokenInput.value = token;
    })
    .catch(error => {
        // Remove loading indicator
        if (document.body.contains(loadingIndicator)) {
            document.body.removeChild(loadingIndicator);
        }
        
        console.error('Error:', error);
        alert('Erreur lors de la récupération des données du contact: ' + error.message);
    });
}

// Text-to-speech function with improved voice selection
function speak(text) {
    return new Promise((resolve) => {
        // Cancel any ongoing speech
        window.speechSynthesis.cancel();
        
        const utterance = new SpeechSynthesisUtterance(text);
        utterance.lang = 'fr-FR'; // Set to French since your UI is in French
        utterance.volume = 1;
        utterance.rate = 0.9; // Slightly slower rate for better comprehension
        utterance.pitch = 1;
        
        // Use a specific voice if available
        // This approach works better across browsers
        let voices = window.speechSynthesis.getVoices();
        if (voices.length === 0) {
            // If voices are not loaded yet, wait for them
        window.speechSynthesis.onvoiceschanged = function() {
                voices = window.speechSynthesis.getVoices();
                selectVoice();
            };
        } else {
            selectVoice();
        }
        
        function selectVoice() {
            // Try to find a French voice with this priority:
            // 1. French female voice
            // 2. Any French voice
            // 3. Default voice
            const frenchVoices = voices.filter(voice => voice.lang.includes('fr'));
            
            if (frenchVoices.length > 0) {
                // Try to find a female voice first (usually contains "female" or feminine names)
                const femaleVoice = frenchVoices.find(v => 
                    v.name.toLowerCase().includes('female') || 
                    v.name.toLowerCase().includes('féminin') ||
                    v.name.toLowerCase().includes('amélie') ||
                    v.name.toLowerCase().includes('marie') ||
                    v.name.toLowerCase().includes('jolie')
                );
                
                utterance.voice = femaleVoice || frenchVoices[0];
                console.log("Using voice:", utterance.voice.name);
            }
        }
        
        utterance.onend = function() {
            resolve();
        };
        
        // Add error handling for speech synthesis
        utterance.onerror = function(event) {
            console.error("Speech synthesis error:", event);
            resolve(); // Resolve anyway to continue the flow
        };
        
        window.speechSynthesis.speak(utterance);
        
        // Failsafe to resolve promise if onend doesn't fire (happens in some browsers)
        setTimeout(() => {
            resolve();
        }, text.length * 75); // Rough estimate of speech duration
    });
}

// Speech recognition function with improved voice capture and error handling
function listen() {
    return new Promise((resolve, reject) => {
        isListening = true;
        
        try {
            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
            if (!SpeechRecognition) {
                throw new Error('Speech recognition not supported by this browser');
            }
            
            const recognition = new SpeechRecognition();
            
            // Store the recognition instance so we can abort it if needed
            window.currentRecognition = recognition;
            
            recognition.lang = 'fr-FR'; // Set to French
            recognition.interimResults = true; // Get interim results for better feedback
            recognition.maxAlternatives = 5; // Get more alternatives for better accuracy
            recognition.continuous = false;
            
            // Add visual indicators that microphone is active
            const micButton = document.getElementById('mic-button');
            if (micButton) {
                micButton.classList.add('ring-4', 'ring-red-400', 'ring-opacity-50', 'ring-offset-2');
            }
            
            // Handle no speech detected
            let speechDetected = false;
            const speechTimeout = setTimeout(() => {
                if (!speechDetected && isListening) {
                    recognition.stop();
                    reject('no-speech');
                }
            }, 7000); // 7 seconds timeout
            
            let finalTranscript = '';
            
            recognition.onresult = function(event) {
                speechDetected = true;
                
                // Build the final transcript from interim results
                finalTranscript = '';
                for (let i = event.resultIndex; i < event.results.length; ++i) {
                    if (event.results[i].isFinal) {
                        finalTranscript += event.results[i][0].transcript;
                    }
                }
                
                // Remove trailing periods which are often added by speech recognition
                finalTranscript = finalTranscript.trim().replace(/\.$/, '');
                
                // If we have a final result, use it
                if (finalTranscript) {
                    clearTimeout(speechTimeout);
                    
                    // Log all alternatives for debugging
                    console.log('Voice input:', finalTranscript, 'Confidence:', event.results[event.results.length-1][0].confidence);
                    if (event.results[event.results.length-1].length > 1) {
                    console.log('Alternatives:');
                        for (let i = 1; i < event.results[event.results.length-1].length; i++) {
                            console.log(`  ${i}: ${event.results[event.results.length-1][i].transcript} (${event.results[event.results.length-1][i].confidence})`);
                    }
                }
                
                // Update UI
                isListening = false;
                
                    // Remove visual microphone indicator
                    if (micButton) {
                        micButton.classList.remove('ring-4', 'ring-red-400', 'ring-opacity-50', 'ring-offset-2');
                    }
                    
                    resolve(finalTranscript);
                }
            };
            
            recognition.onerror = function(event) {
                clearTimeout(speechTimeout);
                console.error('Speech recognition error:', event.error);
                isListening = false;
                
                // Remove visual microphone indicator
                if (micButton) {
                    micButton.classList.remove('ring-4', 'ring-red-400', 'ring-opacity-50', 'ring-offset-2');
                }
                
                reject(event.error);
            };
            
            recognition.onend = function() {
                clearTimeout(speechTimeout);
                isListening = false;
                
                // Remove visual microphone indicator
                if (micButton) {
                    micButton.classList.remove('ring-4', 'ring-red-400', 'ring-opacity-50', 'ring-offset-2');
                }
                
                // If we didn't get any results, resolve with empty string
                if (!finalTranscript && speechDetected) {
                    console.log('Recognition ended without final results, but speech was detected');
                    reject('no-final-result');
                } else if (!speechDetected) {
                    reject('no-speech');
                }
            };
            
            // Start recognition
            recognition.start();
            
        } catch (error) {
            console.error('Speech recognition error:', error);
            isListening = false;
            reject('Speech recognition not supported or other error');
        }
    });
}

// Function to open the shared contacts modal
function openSharedContactsModal() {
    const modal = document.getElementById('sharedContactsModal');
    modal.classList.remove('hidden');

    fetch('/shared-contacts') // Fetch pending shared contacts
        .then(response => response.json())
        .then(sharedContacts => {
            const tableBody = document.getElementById('sharedContactsTable');
            if (tableBody) {
                tableBody.innerHTML = ''; // Clear previous data
                
                // Populate the table with shared contacts
                sharedContacts.forEach(contact => {
                    tableBody.innerHTML += `
                        <tr data-share-id="${contact.share_id}">
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap">${contact.name}</td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap">${contact.sender_name} Contact Id: ${contact.id} Shared-Contact Id: ${contact.share_id}</td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                <button type="button" onclick="acceptContact(${contact.id}, ${contact.share_id})" class="bg-blue-500 text-white px-2 py-1 rounded">Accept</button>
                                <button type="button" onclick="rejectContact(${contact.share_id})" class="bg-red-500 text-white px-2 py-1 rounded">Reject</button>
                            </td>
                        </tr>
                    `;
                });
            }
        })
        .catch(error => {
            console.error('Error fetching shared contacts:', error);
        });
}

// Contact filtering functionality
document.addEventListener('DOMContentLoaded', function() {
    // Get filter elements
    const nameFilter = document.getElementById('filter-name');
    const emailFilter = document.getElementById('filter-email');
    const phoneFilter = document.getElementById('filter-phone');
    const categoryFilter = document.getElementById('filter-category');
    const resetButton = document.getElementById('reset-filters');
    
    // Add event listeners
    if (nameFilter && emailFilter && phoneFilter && categoryFilter) {
        nameFilter.addEventListener('input', filterContacts);
        emailFilter.addEventListener('input', filterContacts);
        phoneFilter.addEventListener('input', filterContacts);
        categoryFilter.addEventListener('change', filterContacts);
    }
    
    if (resetButton) {
        resetButton.addEventListener('click', resetFilters);
    }
    
    // Function to filter contacts
    function filterContacts() {
        const nameValue = nameFilter.value.toLowerCase();
        const emailValue = emailFilter.value.toLowerCase();
        const phoneValue = phoneFilter.value.toLowerCase();
        const categoryValue = categoryFilter.value.toLowerCase();
        
        // Get all table rows except the header
        const tableBody = document.querySelector('table tbody');
        if (!tableBody) return;
        
        const rows = tableBody.querySelectorAll('tr');
        let visibleRowCount = 0;
        
        // Loop through rows and hide/show based on filter
        rows.forEach(row => {
            // Skip the "no contacts found" row if it exists
            if (row.querySelector('td[colspan]')) return;
            
            const nameCell = row.querySelector('td:nth-child(2)');
            const emailCell = row.querySelector('td:nth-child(3)');
            const phoneCell = row.querySelector('td:nth-child(4)');
            const categoryCell = row.querySelector('td:nth-child(5)');
            
            if (!nameCell || !categoryCell) return;
            
            // Get cell text content
            const nameText = nameCell.textContent.toLowerCase();
            const emailText = emailCell ? emailCell.textContent.toLowerCase() : '';
            const phoneText = phoneCell ? phoneCell.textContent.toLowerCase() : '';
            const categoryText = categoryCell.textContent.toLowerCase();
            
            // Check if row matches all filters
            const nameMatch = nameText.includes(nameValue);
            const emailMatch = emailText.includes(emailValue);
            const phoneMatch = phoneText.includes(phoneValue);
            const categoryMatch = categoryValue === '' || categoryText.includes(categoryValue);
            
            // Show/hide row based on match
            if (nameMatch && emailMatch && phoneMatch && categoryMatch) {
                row.classList.remove('hidden');
                visibleRowCount++;
        } else {
                row.classList.add('hidden');
            }
        });
        
        // Show "no results" message if no matches
        let noResultsRow = tableBody.querySelector('.no-results-row');
        
        if (visibleRowCount === 0) {
            if (!noResultsRow) {
                noResultsRow = document.createElement('tr');
                noResultsRow.className = 'no-results-row';
                noResultsRow.innerHTML = `
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                        Aucun contact correspondant aux critères de recherche
                    </td>
                `;
                tableBody.appendChild(noResultsRow);
            } else {
                noResultsRow.classList.remove('hidden');
            }
        } else if (noResultsRow) {
            noResultsRow.classList.add('hidden');
        }
        
        // Update UI to show filter is active
        updateFilterUI();
    }
    
    // Function to reset filters
    function resetFilters() {
        nameFilter.value = '';
        emailFilter.value = '';
        phoneFilter.value = '';
        categoryFilter.value = '';
        
        // Show all rows
        const tableBody = document.querySelector('table tbody');
        if (tableBody) {
            const rows = tableBody.querySelectorAll('tr');
            rows.forEach(row => {
                if (!row.classList.contains('no-results-row')) {
                    row.classList.remove('hidden');
                }
            });
            
            // Hide no results row if it exists
            const noResultsRow = tableBody.querySelector('.no-results-row');
            if (noResultsRow) {
                noResultsRow.classList.add('hidden');
            }
        }
        
        // Update UI to show filters are inactive
        updateFilterUI(true);
    }
    
    // Update UI to show which filters are active
    function updateFilterUI(reset = false) {
        const filterSection = document.querySelector('.p-4.sm\\:p-6.border-b.border-gray-200.bg-gray-50');
        if (!filterSection) return;
        
        if (reset) {
            filterSection.classList.remove('bg-blue-50', 'border-blue-200');
            filterSection.classList.add('bg-gray-50');
            
            const labels = filterSection.querySelectorAll('label');
            labels.forEach(label => {
                label.classList.remove('text-blue-700');
                label.classList.add('text-gray-700');
            });
            
            return;
        }
        
        const isFiltering = nameFilter.value || emailFilter.value || phoneFilter.value || categoryFilter.value;
        
        if (isFiltering) {
            filterSection.classList.remove('bg-gray-50');
            filterSection.classList.add('bg-blue-50', 'border-blue-200');
            
            // Highlight active filter labels
            const filterInputs = [
                { input: nameFilter, label: 'filter-name' },
                { input: emailFilter, label: 'filter-email' },
                { input: phoneFilter, label: 'filter-phone' },
                { input: categoryFilter, label: 'filter-category' }
            ];
            
            filterInputs.forEach(item => {
                const label = document.querySelector(`label[for="${item.label}"]`);
                if (label) {
                    if (item.input.value) {
                        label.classList.remove('text-gray-700');
                        label.classList.add('text-blue-700');
                    } else {
                        label.classList.remove('text-blue-700');
                        label.classList.add('text-gray-700');
                    }
                }
            });
        } else {
            filterSection.classList.remove('bg-blue-50', 'border-blue-200');
            filterSection.classList.add('bg-gray-50');
        }
    }
});

</script>

<!-- Modal for the shared contacts -->
<div id="sharedContactsModal"
    class="fixed inset-0 bg-gray-600  bg-opacity-50 hidden pb-40  overflow-y-auto h-full w-full z-50">
    @include('modals.sharedContacts')
</div>

<!-- Modal for shwing the form to edit the infos of the future accepted shared-contact -->
<div class="fixed inset-0 bg-gray-600 bg-opacity-50  hidden overflow-y-auto h-full w-full z-50"
    id="acceptSharedContactModal">
    @include('modals.acceptSharedContact')
</div>
@endsection