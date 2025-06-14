const setCookie = (name, value, days) => {
  const expires = new Date();
  expires.setTime(expires.getTime() + days * 24 * 60 * 60 * 1000);
  document.cookie = `${name}=${value};expires=${expires.toUTCString()};path=/`;
};

const getCookie = (name) => {
  const cookieArray = document.cookie.split(';');
  const foundCookie = cookieArray.find((cookie) => {
    const [cookieName] = cookie.trim().split('=');
    return cookieName === name;
  });

  return foundCookie ? decodeURIComponent(foundCookie.trim().split('=')[1]) : null;
};

const hideBanner = () => {
  const banner = document.querySelector('.cookie-banner');
  if (banner) {
    banner.style.display = 'none';
  }
};

const acceptCookies = () => {
  setCookie('cookieConsent', 'accepted', 365);
};

const showCookieBanner = () => {
  const acceptedCookie = getCookie('cookieConsent') === 'accepted';
  if (acceptedCookie) return;

  const banner = document.createElement('div');
  banner.classList.add('cookie-banner');
  banner.innerHTML = `
    <p>Цей сайт використовує файли cookie.</p>
    <button type="button">Добре</button>
  `;

  document.body.appendChild(banner);

  const buttonAccept = document.querySelector('.cookie-banner button');
  buttonAccept.addEventListener('click', () => {
    acceptCookies();
    hideBanner();
  });
};

export default showCookieBanner;
