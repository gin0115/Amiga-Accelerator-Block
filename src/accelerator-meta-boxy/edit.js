/**
 * WordPress dependencies
 */
import { useBlockProps } from "@wordpress/block-editor";
import { TextControl } from '@wordpress/components';
import { useEntityProp } from '@wordpress/core-data';
import { useSelect } from '@wordpress/data';

export default function Edit() {

	// const [memoryVal, setMemoryVal] = useState(memory);
	const blockProps = useBlockProps();

	// META STUFF = https://developer.wordpress.org/block-editor/how-to-guides/metabox/
	const postType = useSelect(
		(select) => select('core/editor').getCurrentPostType(),
		[]
	);



	// Only allow for accelerator post types.
	if (postType !== 'gin0115_amiga_acc') {
		return (
			<div {...blockProps}>
				This block can only be used on accelerator posts.
			</div>
		)
	}


	const [meta, setMeta] = useEntityProp('postType', postType, 'meta');

	// Handle the change of Memory.
	const currentMemory = meta.gin0115_amiga_acc_memory;
	const handleMemoryChange = (value) => {
		setMeta({ ...meta, gin0115_amiga_acc_memory: value });
	};



	return (
		<div {...blockProps}>
			<TextControl
				label="Accelerator Memory"
				value={currentMemory}
				onChange={handleMemoryChange}
			/>
		</div>
	);
}
