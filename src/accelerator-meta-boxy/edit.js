/**
 * WordPress dependencies
 */
import { useBlockProps } from "@wordpress/block-editor";
import {
	TextControl,
	ToggleControl,
	Card, CardHeader, CardBody

} from '@wordpress/components';
import { useEntityProp } from '@wordpress/core-data';
import { useSelect } from '@wordpress/data';
import { __ } from "@wordpress/i18n";

export default function Edit({ attributes, setAttributes }) {
	const blockProps = useBlockProps();

	// META STUFF = https://developer.wordpress.org/block-editor/how-to-guides/metabox/
	const postType = useSelect(
		(select) => select('core/editor').getCurrentPostType(),
		[]
	);

	// Get the current post ID and set it as an attribute.
	const currentPostID = useSelect(
		(select) => select('core/editor').getCurrentPostId(),
		[]
	);
	setAttributes({ postID: currentPostID })

	// Only allow for accelerator post types.
	if (postType !== AcceleratorPostTypes.accelerators) {
		return (
			<div {...blockProps}>
				{__("This block can only be used on accelerator posts.", "amiga-acc-block")}
			</div>
		)
	}

	// Get all meta handling.
	const [meta, setMeta] = useEntityProp('postType', postType, 'meta');

	/**
	 * Returns a curry'able function used to update any meta value.
	 * @param {string} key
	 * @returns function(value)
	 */
	const metaUpdate = (key) => (value) => {
		const newMeta = meta;
		newMeta[key] = value;
		setMeta({ newMeta });
	}

	return (
		<div {...blockProps}>
			<Card>
				<CardHeader>
					{__("Accelerator Details", "amiga-acc-block")}
				</CardHeader>
				<CardBody>
					<TextControl
						label={__("Accelerator Memory", "amiga-acc-block")}
						value={meta[AcceleratorPostMeta.memory]}
						onChange={metaUpdate(AcceleratorPostMeta.memory)}
					/>
					<TextControl
						label={__("Accelerator CPU Model", "amiga-acc-block")}
						value={meta[AcceleratorPostMeta.cpu]}
						onChange={metaUpdate(AcceleratorPostMeta.cpu)}
					/>
					<TextControl
						label={__("Accelerator CPU Speed", "amiga-acc-block")}
						value={meta[AcceleratorPostMeta.cpuSpeed]}
						onChange={metaUpdate(AcceleratorPostMeta.cpuSpeed)}
					/>
					<TextControl
						label={__("Accelerator MPU Model", "amiga-acc-block")}
						value={meta[AcceleratorPostMeta.mpu]}
						onChange={metaUpdate(AcceleratorPostMeta.mpu)}
					/>
					<TextControl
						label={__("Accelerator MPU Speed", "amiga-acc-block")}
						value={meta[AcceleratorPostMeta.mpuSpeed]}
						onChange={metaUpdate(AcceleratorPostMeta.mpuSpeed)}
					/>
					<ToggleControl
						label={__("Has SCSI Controller", "amiga-acc-block")}
						checked={meta[AcceleratorPostMeta.scsi]}
						onChange={metaUpdate(AcceleratorPostMeta.scsi)}
					/>
					<ToggleControl
						label={__("Has IDE Controller", "amiga-acc-block")}
						checked={meta[AcceleratorPostMeta.ide]}
						onChange={metaUpdate(AcceleratorPostMeta.ide)}
					/>
					<ToggleControl
						label={__("Has Floppy Controller", "amiga-acc-block")}
						checked={meta[AcceleratorPostMeta.floppy]}
						onChange={metaUpdate(AcceleratorPostMeta.floppy)}
					/>
					<ToggleControl
						label={__("Is Daughter Board", "amiga-acc-block")}
						checked={meta[AcceleratorPostMeta.daughterBoard]}
						onChange={metaUpdate(AcceleratorPostMeta.daughterBoard)}
					/>
					<ToggleControl
						label={__("Has Zorro Expansion", "amiga-acc-block")}
						checked={meta[AcceleratorPostMeta.zorro]}
						onChange={metaUpdate(AcceleratorPostMeta.zorro)}
					/>
				</CardBody>
			</Card>

		</div>
	);
}
