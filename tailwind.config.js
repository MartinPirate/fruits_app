module.exports = {
    theme: {},
    variants: {},
    content: [
        './assets/**/*.{vue,js,ts,jsx,tsx}',
        './templates/**/*.{html,twig}'
    ],
    plugins: [
        require('@tailwindcss/typography'),
        require('flowbite/plugin')
    ],

}
