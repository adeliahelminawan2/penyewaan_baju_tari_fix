/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/views/welcome.blade.php",
    "./resources/views/**/*.blade.php",
    "./resources/js/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        'accent': '#B37428',
      },
    },
  },
  plugins: [],
}