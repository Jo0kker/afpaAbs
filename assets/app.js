/*
 * Welcome to your app's main JavaScript file!
 *
 */
// create global $ and jQuery variables
global.$ = global.jQuery = $ = require('jquery');

// resources required
import '@popperjs/core';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.min.js';
import axios from "axios";

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';
// start the Stimulus application
import './bootstrap';
