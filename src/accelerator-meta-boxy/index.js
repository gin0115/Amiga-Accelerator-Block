/**
 * Registers a new block provided a unique name and an object defining its behavior.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/#registering-a-block
 */
import { registerBlockType } from "@wordpress/blocks";
import { __ } from "@wordpress/i18n";

/**
 * Internal dependencies
 */
import Edit from "./edit";
import save from "./save";
import metadata from "./block.json";

/**
 * Every block starts by registering a new block type definition.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/#registering-a-block
 */

const { name } = metadata;

export { metadata, name };

export const settings = {
	title: __("Accelerator Meta Boxy", "amiga-acc-block"),
	keywords: [__("design")],
	edit: Edit,
	save,
};

registerBlockType("gin0115/accelerator-meta-boxy", settings);
