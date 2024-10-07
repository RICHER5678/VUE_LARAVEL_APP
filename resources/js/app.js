// Import the Vue.js library
import { createApp } from 'vue';


//axios for inserting into the database
import axios from 'axios';

// Import Bootstrap's CSS
import 'bootstrap/dist/css/bootstrap.min.css';

// Import Bootstrap's JavaScript
import 'bootstrap';

// Import your main application component
import App from './components/MainComponent.vue';

// Import the other components
import columns from './components/columns.vue';
import NavbarComponent from './components/NavbarComponent.vue';
import FormComponent from './components/FormComponent.vue';


// Create a new Vue application instance
const app = createApp(App);

// Register the components globally
app.component('navbar-component', NavbarComponent);
app.component('form-component', FormComponent);
app.component('columns',columns)

// Mount the application to the HTML element with id 'app'
app.mount('#app');
