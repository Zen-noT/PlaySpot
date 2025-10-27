

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

import './ajax.js'; 
import 'bootstrap';


console.log('app.js loaded');


