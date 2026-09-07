export class IndonesiaOpenLanguage {
  constructor({ baseUrl, token, fetchImpl = globalThis.fetch }) {
    if (!baseUrl) throw new Error('baseUrl is required');
    this.baseUrl = baseUrl.replace(/\/$/, '');
    this.token = token;
    this.fetch = fetchImpl;
  }

  async request(path, options = {}) {
    const headers = { Accept: 'application/json', ...(options.body ? { 'Content-Type': 'application/json' } : {}), ...(this.token ? { Authorization: `Bearer ${this.token}` } : {}), ...options.headers };
    const response = await this.fetch(`${this.baseUrl}${path}`, { ...options, headers });
    const body = response.status === 204 ? null : await response.json();
    if (!response.ok) throw Object.assign(new Error(body?.message || `API request failed (${response.status})`), { status: response.status, body });
    return body;
  }

  languages = { list: () => this.request('/languages'), get: (id) => this.request(`/languages/${id}`), statistics: (id) => this.request(`/languages/${id}/statistics`) };
  dictionary = { search: (q, params = {}) => this.request(`/dictionary?${new URLSearchParams({ q, ...params })}`), get: (id) => this.request(`/dictionary/${id}`) };
  contributions = { list: () => this.request('/contributions'), create: (payload) => this.request('/contributions', { method: 'POST', body: JSON.stringify(payload) }), submit: (id) => this.request(`/contributions/${id}/submit`, { method: 'POST' }) };
  learning = { courses: () => this.request('/courses'), progress: () => this.request('/me/progress'), recordProgress: (payload) => this.request('/me/progress', { method: 'POST', body: JSON.stringify(payload) }) };
  search = (q) => this.request(`/search?${new URLSearchParams({ q })}`);
}
