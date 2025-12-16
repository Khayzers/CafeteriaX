import './bootstrap';

// Import Bootstrap
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

// Import Croppie
import Croppie from 'croppie';
window.Croppie = Croppie;
// Importar scripts específicos de cafeterías para que Vite los incluya en el manifest
import './cafeterias/index.js';
import './cafeterias/show.js';
import './home.js';
