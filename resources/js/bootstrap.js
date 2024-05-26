import axios from 'axios';
import htmx from 'htmx.org';
import Alpine from 'alpinejs';

window.htmx = htmx;
window.axios = axios;
window.Alpine = Alpine;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
