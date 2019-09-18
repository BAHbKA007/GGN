/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import 'flag-icon-css/css/flag-icon.css';

//window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

//ue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
// });


window.onload = function() {

    document.body.style.opacity='1';

    // IOS PWA öffnen in einem neuen Fenster verhindern
    // by https://github.com/irae
    (function(document,navigator,standalone) {
        // prevents links from apps from oppening in mobile safari
        // this javascript must be the first script in your <head>
        if ((standalone in navigator) && navigator[standalone]) {
            var curnode, location=document.location, stop=/^(a|html)$/i;
            document.addEventListener('click', function(e) {
                curnode=e.target;
                while (!(stop).test(curnode.nodeName)) {
                    curnode=curnode.parentNode;
                }
                // Condidions to do this only on links to your own app
                // if you want all links, use if('href' in curnode) instead.
                if('href' in curnode && ( curnode.href.indexOf('http') || ~curnode.href.indexOf(location.host) ) ) {
                    e.preventDefault();
                    location.href = curnode.href;
                }
            },false);
        }
    })(document,window.navigator,'standalone');

    $('.myAlert-bottom').slideDown();
    setTimeout(function(){
        $(".myAlert-bottom").slideUp(); 
    }, 4000);
    
    var focus = document.getElementById("focus");
    if (focus != null) {
        document.getElementById("focus").focus();
    }

    $('.hide').hide();

    $(".my-list-spinner").click(function() {
        $("#show"+$(this)[0].id).fadeIn(); 
    });

    $( ".copy" ).click(function() {
        var text = $(this).data("ggn");
        navigator.clipboard.writeText(text).then(function() {
            console.log('Async: Copying to clipboard was successful! ' + text);
        }, function(err) {
            console.error('Async: Could not copy text: ', err);
        });
    });

    $('.lodingButton').click(function(){
        console.log($(this).find("#spinner"));
        $(this).find("#btn-txt").text('Lade...');
        $(this).find("#spinner").show();
        $(this).find("#lodingButton").attr("disabled", true);
        $('#'+$(this).data("form")).submit();
    });
};