import 'bootstrap';
import React from 'react';
import { createRoot } from 'react-dom'; // Use 'react-dom' for createRoot
import Example from './components/Example.jsx';
import Service from "./components/Service.jsx"; // Adjust the path as needed
import ReactDOM from 'react-dom';
import Formservices from "./components/Formservices.jsx";
import Formcaisse from "./components/Formcaisse.jsx";


// Check if the "example" element exists on the page
const exampleElement = document.getElementById('example');
if (exampleElement) {
    ReactDOM.render(
        <React.StrictMode>
            <Example />
        </React.StrictMode>,
        exampleElement
    );
}

// Check if the "service" element exists on the page
const serviceElement = document.getElementById('service');
if (serviceElement) {
    ReactDOM.render(
        <React.StrictMode>
            <Service />
        </React.StrictMode>,
        serviceElement
    );
}

const FormserviceElement = document.getElementById('Formservice');
if (FormserviceElement) {
    ReactDOM.render(
        <React.StrictMode>
            <Formservices />
        </React.StrictMode>,
        FormserviceElement
    );
}

const CaisseElement = document.getElementById('Formcaisse');
if (CaisseElement) {
    ReactDOM.render(
        <React.StrictMode>
            <Formcaisse />
        </React.StrictMode>,
        CaisseElement
    );
}
