module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    daisyui: {
        themes: [
            {
                mytheme: {
                    primary: "#45369e",

                    secondary: "#521482",

                    accent: "#2dd4bf",

                    neutral: "#1e3a8a",

                    "base-100": "#F7F4FF",
                    "base-200": "#DBD5EA",

                    info: "#8157eb",

                    success: "#36D399",

                    warning: "#FBBD23",

                    error: "#f43f5e",
                },
            },
        ],
    },

    theme: {
        extend: {},
    },
    plugins: [require("daisyui")],
};
