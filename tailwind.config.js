module.exports = {
  purge: [],
  theme: {
    extend: {
      colors: {
        primary: '#f9f8f8',
        secondary: '586994',
        success: '#bdc8d4',
        info: '#0099cc',
        warning: '#a34c40',
        danger: '#8c271e',
        light: '#0e5499',
        dark: '#c0c0c0',
      }
    },
    // hier weiß ich nicht, wieso das nicht geht... Dit Fonts sind lokal installiert.
    // Eigentlich müsste es gehen...
    // https://stackoverflow.com/questions/61976785/how-do-you-use-custom-fonts-with-tailwindcss-and-nuxtjs
    fontFamily: {
      body: ['Roboto']
    }
  },
  variants: {},
  plugins: [],
}
