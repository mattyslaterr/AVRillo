import './bootstrap';
import { createApp } from 'vue';

const app = createApp({});

// SweetAlert2 for popup notifications
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
app.use(VueSweetalert2);

// Login component
import Login from './components/Login.vue';
app.component('login', Login);

// Register component
import Register from './components/Register.vue';
app.component('register', Register);

app.mount('#app');
