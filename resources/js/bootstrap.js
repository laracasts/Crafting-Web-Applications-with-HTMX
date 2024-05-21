import axios from 'axios';
import htmx from 'htmx.org';

window.htmx = htmx;
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
