export default {
    // greeter main heading
    name: 'Alejandro Granadillo Palau',

    // stores currently selected descList item
    currentDesc: '',

    descList: [
        'Programación, ingeniería de software, estructura de datos y mas.',
        'PHP 7 > PHP 5.',
        'Creador del Código T, los Trululus, Maria Sofia y Cafe Pedro Lopez.',
        'Saaaaaaaaaaaludos a todos!',
        'También conocido como wachi.',
        'slayerfat, el único e inigualable, campeón del Código A, S y T en Starcraft 2.',
        'Control de version de código fuente.',
        'Adicto innecesario del perfeccionismo, lo correcto y lo exacto.',
        'Narrador, comentarista, aficionado de los números, amante de los Zerg.',
        'Creador de contenidos multimedia web 2.0',
        'Mago de entidades, relaciones y flujo de datos nivel 8.',
        'Modelo, Vista, Controlador, Entidad, Relación, Metodología.'
    ],

    // links existing in the vue-router
    localLinks: [
        {
            title: 'Blog de Alejandro slayerfat Granadillo',
            url: '/blog',
            className: 'pencil'
        },
        {
            title: 'Videos en youtube de Alejandro slayerfat Granadillo',
            url: '/videos', className: 'play'
        },
        {
            title: 'Conocimientos de Alejandro slayerfat Granadillo',
            url: '/conocimientos', className: 'book'
        }
    ],

    // links existing in the vue-router but only for admins
    maintenanceLinks: [
        {
            title: 'Etiquetas',
            url: '/etiquetas',
            className: 'tags'
        }
    ],

    // external links
    links: [
        {
            title: 'Alejandro slayerfat Granadillo en twitter @slayerfat',
            url: 'http://www.twitter.com/slayerfat',
            className: 'twitter'
        },
        {
            title: 'Alejandro slayerfat Granadillo en Facebook',
            url: 'http://www.facebook.com/slayerfat',
            className: 'facebook'
        },
        {
            title: 'Perfil en Github de Alejandro slayerfat Granadillo',
            url: 'http://www.github.com/slayerfat',
            className: 'github'
        }
    ]
};
