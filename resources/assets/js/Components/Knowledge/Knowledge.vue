<template>
    <navbar></navbar>
    <div class="row jumbo" v-for="info in codeDetails" v-cloak>
        <div class="column small-12 medium-10 medium-offset-1 large-7">
            {{{info.text | markdown}}}
        </div>
        <div class="column large-4 show-for-large">
            <img v-for="url in info.images" :src="url" width="300px">
        </div>
    </div>
    <div class="row jumbo jumbo-details align-middle" v-for="info in details" v-cloak>
        <div class="column medium-5 small-12 medium-offset-1">
            {{{info.text | markdown}}}
        </div>
        <div class="column medium-5 small-12">
            <img :src="info.image_url">
        </div>
    </div>
    <my-footer></my-footer>
</template>

<script>
    import Navbar from "./../Navbar.vue";
    import MyFooter from "./../Footer.vue";
    export default {
        data () {
            return {
                codeDetails: [
                    {
                        text: `
Amplio manejo de:

\`\`\`php
namespace Slayerfat;

class PHP extends Web {

    /**
    * @var Int
    */
    public $version;

    /**
    * PHP constructor.
    */
    public function __construct()
    {
        $this->version = $this->setVersion(7);
    }

    /**
    * @return Int
    */
    public function getVersion()
    {
        return $this->version;
    }

    /**
    * @param int $type
    * @return Int
    */
    public function setVersion(int $type): Int
    {
        if ($type < 7) return 5;

        return 7;
    }
}

echo (new \\Slayerfat\\PHP)->getVersion();
\`\`\`
PHP en version 5 y 7, las librerías mas populares actualmente como

\`\`\`bash
composer
laravel new App
WordPress
\`\`\`
entre otros, así como programación funcional y orientada a objetos.`,
                        images: [
                            'http://i.imgur.com/PayoMLZ.png',
                            'http://i.imgur.com/j3ysFyB.png',
                            'http://i.imgur.com/CfweMiu.png',
                            'http://i.imgur.com/g8ZxYd4.png'
                        ]
                    },
                    {
                        text: `
conocimientos relacionados con:
\`\`\`js
class Javascript {

    constructor(){
        this.version = this.setVersion(6);
    }

    /**
     *
     * @returns {number}
     */
    getVersion()
    {
        return this.version;
    }

    /**
     *
     * @param number
     * @returns {number}
     */
    setVersion(number)
    {
        if (number < 6) {
            return 5;
        }

        return 6;
    }
}

console.log((new Javascript()).getVersion());
\`\`\`

Asi como librerias populares actualmente en el desarrollo web como:

\`\`\`js
// jQuery
$(function() {
    $('#jQuery').val();
});
// Vue.js
var Vue = require('vue');
new Vue({
    el: '#Vuejs'
});

// Angular 2
import { Component } from '@angular/core';
@Component({
  selector: 'my-app',
  template: '<h1>Angular 2</h1>'
})
export class AppComponent { }
\`\`\`
                        `,
                        images: [
                            'http://i.imgur.com/sA5lm1d.png',
                            'http://i.imgur.com/jId5B4U.png',
                            'http://i.imgur.com/T1guo3x.png',
                            'http://i.imgur.com/Z7KuJv9.png'
                        ]
                    }
                ],

                details: [
                    {
                        text: 'Manejo oportuno de <code>$ git --version</code> para el control de versiones de código fuente, sumado a la <strong>integración continua</strong> por medio de la creación y <em>estrategias de prueba</em> según la <strong>Ingeniería de Software.</strong>',
                        image_url: 'http://i.imgur.com/yW65OEN.png'
                    }
                ]
            };
        },

        components: {
            Navbar,
            MyFooter
        }
    };
</script>
