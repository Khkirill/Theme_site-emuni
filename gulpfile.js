let preprocessor = "sass";
// fileswatch = "html,htm,txt,json,md,woff2,php"; // List of files extensions for watching & hard reload

const { src, dest, parallel, series, watch } = require("gulp");
const browserSync = require("browser-sync").create();
const webpack = require("webpack-stream");
const sass = require("gulp-sass");
const compiler = require("sass");
sass.compiler = compiler;
const sassglob = require("gulp-sass-glob");
const cleancss = require("gulp-clean-css");
const autoprefixer = require("gulp-autoprefixer");
const rename = require("gulp-rename");
const imagemin = require("gulp-imagemin");
const newer = require("gulp-newer");
const sourcemaps = require("gulp-sourcemaps");

function scripts() {
    return src(["app/js/*.js", "!app/js/*.min.js"])
        .pipe(
            webpack({
                mode: "development",
                performance: { hints: false },
                module: {
                    rules: [
                        {
                            test: /\.(js)$/,
                            exclude: /(node_modules)/,
                            loader: "babel-loader",
                            query: {
                                presets: ["@babel/env"],
                                plugins: ["babel-plugin-root-import"],
                            },
                        },
                    ],
                },
            })
        )
        .on("error", function handleError() {
            this.emit("end");
        })
        .pipe(rename("app.min.js"))
        .pipe(dest("app/js"))
        .pipe(browserSync.stream());
}

function styles() {
    return src([`app/styles/*.scss`, `!app/styles/**/_*.*`])
        .pipe(sourcemaps.init())
        .pipe(sassglob())
        .pipe(sass().on("error", sass.logError))
        .pipe(autoprefixer({ overrideBrowserslist: ["last 10 versions"], grid: true }))
        .pipe(cleancss({ level: { 1: { specialComments: 0 } } /* format: 'beautify' */ }))
        .pipe(rename({ suffix: ".min" }))
        .pipe(sourcemaps.write('.'))
        .pipe(dest("app/css"))
        .pipe(browserSync.stream());
}

function images() {
    return src(["app/images/src/**/*"])
        .pipe(newer("app/images/dist"))
        .pipe(imagemin())
        .pipe(dest("app/images/dst"))
        .pipe(browserSync.stream());
}

function startwatch() {
    watch(`app/styles/**/*`, { usePolling: true }, styles);
    watch(["app/js/**/*.js", "!app/js/**/*.min.js"], { usePolling: true }, scripts);
    watch("app/images/src/**/*.{jpg,jpeg,png,webp,svg,gif}", { usePolling: true }, images);
    // watch(`../**/*.{${fileswatch}}`, { usePolling: true }).on("change", browserSync.reload);
}

exports.scripts = scripts;
exports.styles = styles;
exports.images = images;
exports.dev = series(scripts, styles, images, parallel(startwatch));
// exports.dev = series(scripts, styles, images, parallel(browsersync, startwatch));