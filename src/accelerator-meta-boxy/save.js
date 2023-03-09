import { useBlockProps } from "@wordpress/block-editor";

export default function save({ attributes }) {
	const blockProps = useBlockProps.save();

	return (
		<div id="react-app" {...blockProps} data-foo={attributes.postID}>
			Accelerator card details to follow
		</div>
	);
}
