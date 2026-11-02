// Design tokens copied from the Stitch export (design/stitch/index.html), the primary design reference.
/** @type {import("tailwindcss").Config} */
module.exports = {
  content: ["./wp-theme/healing-hands/**/*.{php,js,txt}"],
  theme: {
  "extend": {
    "colors": {
      "on-secondary-fixed-variant": "#234f39",
      "on-tertiary": "#ffffff",
      "surface-container-lowest": "#ffffff",
      "forest-rich": "#204B35",
      "canvas-ivory": "#FBF9F5",
      "on-tertiary-fixed": "#002020",
      "primary-fixed": "#c7ebd4",
      "on-secondary-container": "#416d55",
      "border-subtle": "#E5E1D8",
      "surface-container": "#f1ede5",
      "on-primary-container": "#83a590",
      "outline-variant": "#c1c8c2",
      "sage-tint": "#E2ECE5",
      "surface-container-high": "#ece8e0",
      "surface": "#fdf9f1",
      "secondary": "#3b674f",
      "on-secondary-fixed": "#002112",
      "secondary-fixed": "#bdeecf",
      "on-primary-fixed": "#002113",
      "tertiary": "#002525",
      "error": "#ba1a1a",
      "mist-blue": "#E8F1F4",
      "surface-variant": "#e6e2da",
      "surface-dim": "#dddad2",
      "error-container": "#ffdad6",
      "secondary-fixed-dim": "#a2d1b4",
      "inverse-on-surface": "#f4f0e8",
      "on-secondary": "#ffffff",
      "background": "#fdf9f1",
      "on-error": "#ffffff",
      "surface-container-low": "#f7f3eb",
      "inverse-surface": "#31302b",
      "healing-blue": "#3B7A8C",
      "surface-container-highest": "#e6e2da",
      "surface-tint": "#456553",
      "tertiary-fixed": "#b1edee",
      "text-ink": "#1C2520",
      "on-tertiary-fixed-variant": "#074f50",
      "on-error-container": "#93000a",
      "outline": "#727973",
      "secondary-container": "#bdeecf",
      "on-primary": "#ffffff",
      "surface-bright": "#fdf9f1",
      "on-surface": "#1c1c17",
      "surface-cream": "#F5F1E9",
      "primary-container": "#1b3b2b",
      "on-primary-fixed-variant": "#2d4d3c",
      "primary": "#032517",
      "tertiary-container": "#003c3d",
      "inverse-primary": "#abcfb8",
      "primary-fixed-dim": "#abcfb8",
      "tertiary-fixed-dim": "#95d1d2",
      "on-surface-variant": "#424843",
      "on-background": "#1c1c17",
      "on-tertiary-container": "#6da8a9",
      "text-muted": "#55635B",
      "gold": "#A88F4E",
      "gold-soft": "#EFE7D2"
    },
    "borderRadius": {
      "DEFAULT": "0.25rem",
      "lg": "0.5rem",
      "xl": "0.75rem",
      "full": "9999px"
    },
    "spacing": {
      "margin": "3rem",
      "margin-mobile": "1.25rem",
      "gutter": "1.5rem",
      "space-xs": "0.375rem",
      "space-sm": "0.75rem",
      "space-md": "1.25rem",
      "space-xl": "3.5rem",
      "gutter-mobile": "1rem",
      "space-lg": "2rem"
    },
    "fontFamily": {
      "sans": [
        "\"Plus Jakarta Sans\"",
        "system-ui",
        "sans-serif"
      ],
      "serif": [
        "\"Playfair Display\"",
        "Georgia",
        "serif"
      ],
      "headline-lg": [
        "\"Playfair Display\"",
        "Georgia",
        "serif"
      ],
      "headline-sm": [
        "\"Playfair Display\"",
        "Georgia",
        "serif"
      ],
      "headline-md": [
        "\"Playfair Display\"",
        "Georgia",
        "serif"
      ],
      "label-md": [
        "\"Plus Jakarta Sans\"",
        "system-ui",
        "sans-serif"
      ],
      "headline-lg-mobile": [
        "\"Playfair Display\"",
        "Georgia",
        "serif"
      ],
      "body-sm": [
        "\"Plus Jakarta Sans\"",
        "system-ui",
        "sans-serif"
      ],
      "display-hero": [
        "\"Playfair Display\"",
        "Georgia",
        "serif"
      ],
      "body-md": [
        "\"Plus Jakarta Sans\"",
        "system-ui",
        "sans-serif"
      ],
      "title-md": [
        "\"Plus Jakarta Sans\"",
        "system-ui",
        "sans-serif"
      ],
      "title-lg": [
        "\"Plus Jakarta Sans\"",
        "system-ui",
        "sans-serif"
      ],
      "label-sm": [
        "\"Plus Jakarta Sans\"",
        "system-ui",
        "sans-serif"
      ],
      "body-lg": [
        "\"Plus Jakarta Sans\"",
        "system-ui",
        "sans-serif"
      ],
      "display-hero-mobile": [
        "\"Playfair Display\"",
        "Georgia",
        "serif"
      ]
    },
    "fontSize": {
      "headline-lg": [
        "40px",
        {
          "lineHeight": "52px",
          "letterSpacing": "-0.015em",
          "fontWeight": "400"
        }
      ],
      "headline-sm": [
        "22px",
        {
          "lineHeight": "30px",
          "fontWeight": "600"
        }
      ],
      "headline-md": [
        "28px",
        {
          "lineHeight": "36px",
          "fontWeight": "500"
        }
      ],
      "label-md": [
        "13px",
        {
          "lineHeight": "18px",
          "letterSpacing": "0.04em",
          "fontWeight": "600"
        }
      ],
      "headline-lg-mobile": [
        "28px",
        {
          "lineHeight": "36px",
          "letterSpacing": "-0.01em",
          "fontWeight": "400"
        }
      ],
      "body-sm": [
        "13px",
        {
          "lineHeight": "20px",
          "fontWeight": "400"
        }
      ],
      "display-hero": [
        "56px",
        {
          "lineHeight": "68px",
          "letterSpacing": "-0.02em",
          "fontWeight": "400"
        }
      ],
      "body-md": [
        "15px",
        {
          "lineHeight": "24px",
          "fontWeight": "400"
        }
      ],
      "title-md": [
        "17px",
        {
          "lineHeight": "24px",
          "fontWeight": "600"
        }
      ],
      "title-lg": [
        "20px",
        {
          "lineHeight": "28px",
          "fontWeight": "600"
        }
      ],
      "label-sm": [
        "11px",
        {
          "lineHeight": "16px",
          "letterSpacing": "0.06em",
          "fontWeight": "600"
        }
      ],
      "body-lg": [
        "18px",
        {
          "lineHeight": "28px",
          "fontWeight": "400"
        }
      ],
      "display-hero-mobile": [
        "36px",
        {
          "lineHeight": "44px",
          "letterSpacing": "-0.01em",
          "fontWeight": "400"
        }
      ]
    }
  }
},
  plugins: [require("@tailwindcss/forms")],
};
