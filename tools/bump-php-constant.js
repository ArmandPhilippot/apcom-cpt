/**
 * bump-php-constant.js
 *
 * Copy package.json version into apcom-cpt.php file.
 */
const fs = require( 'fs' );

// Load package.json data.
const packageJson = JSON.parse( fs.readFileSync( './package.json' ) );
const packageVersion = packageJson.version;

module.exports = {
	files: 'apcom-cpt.php',
	from: new RegExp(
		"_VERSION', '(0|[1-9]\\d*)\\.(0|[1-9]\\d*)\\.(0|[1-9]\\d*)(?:-((?:0|[1-9]\\d*|\\d*[a-zA-Z-][0-9a-zA-Z-]*)(?:\\.(?:0|[1-9]\\d*|\\d*[a-zA-Z-][0-9a-zA-Z-]*))*))?(?:\\+([0-9a-zA-Z-]+(?:\\.[0-9a-zA-Z-]+)*))?",
		'g'
	),
	to: "_VERSION', '" + packageVersion,
};
