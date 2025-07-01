

document.addEventListener('DOMContentLoaded', () => {
  const consentCookie = getCookie('privacy_consent');
  const declinedCookie = getCookie('privacy_declined');

  if (!consentCookie && !declinedCookie) {
    showConsentBox();
  }
});

function showConsentBox() {
  const consentBox = document.getElementById('consent-box');
  if (!consentBox) return;

  // Block scrolling
  document.body.style.overflow = 'hidden';
  consentBox.classList.remove('d-none');

  document.getElementById('accept-consent').addEventListener('click', () => {
    const guid = crypto.randomUUID();
    const now = new Date().toISOString();
    const version = 1;

    const consentData = JSON.stringify({ guid, date: now, version });
    setCookie('privacy_consent', consentData, 365);

    // Optional: send to backend to store consent data
    fetch('/consent', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: consentData,
    }).catch(console.error);

    consentBox.classList.add('d-none');
    document.body.style.overflow = '';
  });

  document.getElementById('decline-consent').addEventListener('click', () => {
    setCookie('privacy_declined', new Date().toISOString(), 1);

    consentBox.classList.add('d-none');
    document.body.style.overflow = '';
  });
}

function setCookie(name, value, days) {
  let expires = '';
  if (days) {
    const d = new Date();
    d.setTime(d.getTime() + days * 864e5); // 864e5 = 24*60*60*1000
    expires = '; expires=' + d.toUTCString();
  }
  document.cookie = `${name}=${encodeURIComponent(value)}${expires}; path=/`;
}

function getCookie(name) {
  const cookies = document.cookie.split(';');
  for (let c of cookies) {
    c = c.trim();
    if (c.startsWith(name + '=')) {
      return decodeURIComponent(c.substring(name.length + 1));
    }
  }
  return null;
}
