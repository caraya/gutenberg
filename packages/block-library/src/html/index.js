/**
 * WordPress dependencies
 */
import { html as icon } from '@wordpress/icons';
import { __ } from '@wordpress/i18n';

/**
 * Internal dependencies
 */
import metadata from './block.json';
import edit from './edit';
import save from './save';

const { name } = metadata;

export { metadata, name };

export const settings = {
	title: __( 'Custom HTML' ),
	description: __( 'Add custom HTML code and preview it as you edit.' ),
	icon,
	keywords: [ __( 'embed' ) ],
	example: {
		attributes: {
			content:
				'<marquee>' +
				__( 'Welcome to the wonderful world of blocks…' ) +
				'</marquee>',
		},
	},
	supports: {
		customClassName: false,
		className: false,
		html: false,
		lightBlockWrapper: true,
	},
	edit,
	save,
};
