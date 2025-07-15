<button onclick="startVoiceCommand()" class="btn btn-primary">
    🎤 Add Contact with Voice
</button>

<script>
function startVoiceCommand() {
    const recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
    recognition.lang = 'en-US'; // or 'fr-FR' if you're working in French
    recognition.start();

    recognition.onresult = function(event) {
        let voiceText = event.results[0][0].transcript;
        console.log("Heard:", voiceText);

        // Send to Laravel backend
        fetch("{{ route('chatbot.voice') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ message: voiceText }),
        })
        .then(res => res.json())
        .then(data => {
            alert(data.response);
        })
        .catch(err => {
            alert("Erreur: " + err.message);
        });
    };
}
</script>
