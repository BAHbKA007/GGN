/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

    
window.del_data = function del_data(link, id, name, redirect) {

    if (confirm(name + " wirklich löschen?")) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
            url: '/' + link + '/' + id,
            type: 'DELETE',
        success: function(result) {
            setTimeout(function(){
                if (result == '') { window.location.href = '/' + link; } else { window.location.href = '/programm/' + redirect; }
            }, 100);
        }
        });
    }
}

window.del_gezaehlt = function del_gezaehlt(zaehlpos_id,zaehlung_id,kunde_id,artikel_id) {

    if (confirm("wirklich löschen?")) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
            url: '/zaehlposition/' + zaehlpos_id,
            type: 'DELETE',
        success: function(result) {
            setTimeout(function(){
                window.location.href = '/zaehlung/' + zaehlung_id + '/kunde/' + kunde_id + '/artikel/' + artikel_id;
            }, 100);
        }
        });
    }
}

window.del_artikel = function del_artikel(id, name, redirect, pro_id) {

    if (confirm(name + " wirklich löschen?")) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
            url: '/programmkundeartikel/' + id,
            type: 'DELETE',
        success: function(result) {
            setTimeout(function(){
                window.location.href = '/programm/'+ pro_id +'/' + redirect;
                }, 100);
        }
        });
    }
}

window.onload = function() {

    setTimeout(function(){
        $(".myAlert-bottom").fadeOut(); 
        }, 6000);
    
    document.getElementById("focus").focus();
};