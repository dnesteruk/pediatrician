
let project_folder = "../assets";
let source_folder = "../src";

let path = {
    build: {
        css: project_folder + "/css/",
        js: project_folder + "/js/",
    },
    src: {
        css: source_folder + "/scss/**/*.scss",
        js: [source_folder + "/js/**/*.js", "!" + source_folder + "/js/**/_*.js"], //['assets/css/main.css', 'assets/css/custom.css'] - file connection order // source_folder + "/js/**/*.js"
    },
    watch: {
        css: source_folder + "/scss/**/*.scss",
        js: source_folder + "/js/**/*.js",
    }
}

    import gulp from 'gulp';
    import concat from 'gulp-concat';
    import packageSass from 'sass'
    import packageGulpSass from 'gulp-sass'
    const scss = packageGulpSass(packageSass)
    import autoprefixer from 'gulp-autoprefixer';
    import group_media from 'gulp-group-css-media-queries';
    import clean_css from 'gulp-clean-css';
    import rename from 'gulp-rename';
    import packageUglify from 'gulp-uglify-es';
    const uglify = packageUglify.default
    import sourcemaps from 'gulp-sourcemaps';

export const css = () => {
    return gulp.src(path.src.css)
        .pipe(sourcemaps.init())
        .pipe(
            scss({
                outputStyle: "expanded"
            })
        )
        .pipe(group_media())
        .pipe(
            autoprefixer({
                overrideBrowserslist: ["last 5 versions"],
                cascade: true
            })
        )
        .pipe(gulp.dest(path.build.css))
        .pipe(clean_css())
        .pipe(
            rename({
                extname: ".min.css"
            })
        )
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(path.build.css))
};

export const js = () => {
    return gulp.src(path.src.js)
        .pipe(sourcemaps.init())
        .pipe(concat('script.js'))
        .pipe(gulp.dest(path.build.js))
        .pipe(uglify())
        .pipe(
            rename({
                extname: ".min.js"
            })
        )
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(path.build.js))
};

export const watchFiles = () => {
    gulp.watch([path.watch.css], css);
    gulp.watch([path.watch.js], js);
};

export default gulp.series(
    gulp.parallel(
        css,
        js,
    ),
    gulp.parallel(
        watchFiles
    ),
);
