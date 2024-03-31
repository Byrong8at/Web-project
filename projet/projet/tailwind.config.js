/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['*.{html,js}'],
  theme: {
    extend: {
      colors: {
        'custom-blue': '#4C9094',
        'custom-green': '#164988',
        'custom-purple': '#567BB2',
        'custom-blue-sky':'#267C90',
      },
    },
  },
  plugins: [],
}

/*npx tailwindcss -i ./style/tail_element.css -o ./style/gerer.css --watch*/