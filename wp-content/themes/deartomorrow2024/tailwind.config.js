const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
  content: [
    // https://tailwindcss.com/docs/content-configuration
    './*.php',
    './inc/**/*.php',
    './templates/**/*.php',
    './safelist.txt'
    //'./**/*.php', // recursive search for *.php (be aware on every file change it will go even through /node_modules which can be slow, read doc)
  ],
  safelist: [
    'text-center'
    //{
    //  pattern: /text-(white|black)-(200|500|800)/
    //}
  ],
  theme: {
    extend: {
      colors: {
        'paper-white': 'var(--paper-white)',
        'midnight-blue': 'var(--midnight-blue)',
        'leaf-green': 'var(--leaf-green)',
        'morning-blue': 'var(--morning-blue)',
        'evening-teal': 'var(--evening-teal)',
        'sunrise-orange': 'var(--sunrise-orange)',
        'sunset-pink': 'var(--sunset-pink)',
        'dusk-purple': 'var(--dusk-purple)',
        'btn-bkg': 'var(--btn-bkg)'
      },
      spacing: {
        '0.5': '2px',
        '3.5': '14px',
        '4.5': '18px',
        '5': '20px',
        '5.5': '22px',
        '11': '44px',
        '13': '52px',
        '14.5': '58px',
        '29': '116px',
        '34': '136px',
      },
      fontFamily: {
        'sans': ['"Public Sans"', ...defaultTheme.fontFamily.sans],
        'louize': ['"Louize"', ...defaultTheme.fontFamily.sans],
      },
      aspectRatio: {
        'video-portrait': '9/16'
      },
      width: {
        '128': '512px',
        '135': '540px',
      },
    }
  },
  plugins: []
}