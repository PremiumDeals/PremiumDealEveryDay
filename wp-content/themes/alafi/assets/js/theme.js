(function () {
  const darkToggle = document.querySelector('[data-dark-mode]');
  if (darkToggle) {
    darkToggle.addEventListener('click', () => {
      const enabled = document.body.classList.toggle('alafi-dark-mode');
      document.cookie = `alafi_dark_mode=${enabled ? '1' : '0'};path=/;max-age=31536000`;
    });
  }

  const voiceButton = document.querySelector('[data-voice-search]');
  if (voiceButton && 'webkitSpeechRecognition' in window) {
    const recognition = new webkitSpeechRecognition();
    recognition.lang = 'en-IN';
    recognition.onresult = (event) => {
      const query = event.results[0][0].transcript;
      const searchInput = document.querySelector('input[type="search"]');
      if (searchInput) {
        searchInput.value = query;
        searchInput.form?.submit();
      }
    };
    voiceButton.addEventListener('click', () => recognition.start());
  }

  document.querySelectorAll('[data-pincode-checker]').forEach((form) => {
    form.addEventListener('submit', async (event) => {
      event.preventDefault();
      const input = form.querySelector('input[name="pincode"]');
      const result = form.querySelector('[data-pincode-result]');
      if (!input || !result || !window.alafiData) return;
      const response = await fetch(`${alafiData.restUrl}pincode/${input.value}`);
      const data = await response.json();
      result.textContent = data.serviceable ? `Delivery ETA: ${data.eta}` : 'Sorry, not serviceable yet.';
    });
  });
})();
