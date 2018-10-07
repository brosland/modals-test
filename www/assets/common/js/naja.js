import Naja from 'naja';
import BootstrapExtension from "./BootstrapExtension";
import FormErrorsExtension from './FormErrorsExtension.js';
import Brosland_ModalsNajaExtension from "./Brosland_ModalsNajaExtension";

Naja.registerExtension(BootstrapExtension);
Naja.registerExtension(FormErrorsExtension);
Naja.registerExtension(Brosland_ModalsNajaExtension);

Naja.defaultOptions = {
	history: false
};

// We must attach Naja to window load event.
document.addEventListener('DOMContentLoaded', Naja.initialize.bind(Naja));
