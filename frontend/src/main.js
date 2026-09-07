import { IndonesiaOpenLanguage } from '@iol/typescript-sdk';

const api = new IndonesiaOpenLanguage({ baseUrl: import.meta.env.VITE_API_URL || '/api/v1' });
document.querySelector('#app').innerHTML += '<p id="status">Loading published languages…</p>';
api.languages.list().then(({ data }) => {
  document.querySelector('#status').textContent = `${data.length} published languages available.`;
}).catch(() => {
  document.querySelector('#status').textContent = 'API is not available yet.';
});
