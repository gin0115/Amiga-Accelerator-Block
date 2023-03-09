import React from 'react';
import AcceleratorCardItemString from "./Accelerator_Card_Item_String";
import AcceleratorCardItemBool from "./Accelerator_Card_Item_Bool";

export default class AcceleratorCardComponent extends React.Component {
	constructor(props) {
		super(props);

		// Set the meta
		this.meta = props.meta;
		console.log(this.meta);
	}
	render() {
		return (
			<div className="stats-wrapper">
				{Object.keys(gin0115AcceleratorPanel.metaKeys).map((key, index) => {
					// Get the full meta key from its short name.
					const metaKey = gin0115AcceleratorPanel.metaKeys[key];

					// Get the value from the meta.
					const value = this.meta[metaKey];

					// Get the icon and title from the meta details.
					const metaDetails = gin0115AcceleratorPanel.metaDetails[metaKey];
					const icon = metaDetails ? metaDetails.icon : 'unset';
					const title = metaDetails ? metaDetails.title : 'unset';

					// If value is a string.
					if (typeof value === 'string') {
						return <AcceleratorCardItemString key={key} title={title} icon={icon} value={value} />
					}
					if(typeof value === 'boolean') {
						return <AcceleratorCardItemBool key={key} title={title} icon={icon} value={value} />
					}
				})}
			</div>
		);
	}
}
