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
import Save from "./save";

export const settings = {
	title: __("Accelerator Meta Boxy", "amiga-acc-block"),
	keywords: [__("design", "amiga-acc-block")],
	"multiple": false,
	edit: Edit,
	save: Save,
};

registerBlockType("gin0115/accelerator-meta-boxy", settings);
