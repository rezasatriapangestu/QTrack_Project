async function playQueueSound(message) {
    try {
        // Retrieve available voices
        const availableVoices = await fetchVoices();

        // Filter voices to get Indonesian language voices
        const indonesianVoices = availableVoices.filter((voice) =>
            voice.lang.includes("id")
        );

        // Select a more natural-sounding voice, if available
        const selectedVoice =
            indonesianVoices.find((voice) => voice.name.includes("Natural")) ||
            indonesianVoices[indonesianVoices.length - 1];

        // Create a new speech synthesis utterance
        const utterance = new SpeechSynthesisUtterance(message);

        // Set the voice and speech properties
        utterance.voice = selectedVoice;
        utterance.rate = 0.9; // Slightly faster than before
        utterance.pitch = 1.1; // Slightly higher pitch
        utterance.volume = 1; // Full volume

        // Speak the message
        window.speechSynthesis.speak(utterance);
    } catch (error) {
        console.error("Error playing queue sound:", error);
    }
}

function fetchVoices() {
    return new Promise((resolve, reject) => {
        const intervalId = setInterval(() => {
            const voices = window.speechSynthesis.getVoices();
            if (voices.length) {
                resolve(voices);
                clearInterval(intervalId);
            }
        }, 10);
    });
}

document.addEventListener("livewire:initialized", () => {
    Livewire.on("queue-called", playQueueSound);
});
