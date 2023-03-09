import React from 'react';

export default class AcceleratorCardItemString extends React.Component {
	constructor(args) {
		super();
		this.title = args.title;
		this.icon = args.icon;
		this.value = args.value;
	}

	render() {
		return (
			<div className="accelerator-item numerical">
				<div>
					<div className="accelerator-item__icon">
						<img src={this.icon} alt={this.title} />
					</div>
					<div className="accelerator-item__title">
						<p className="attribute-title">{this.title}</p>
					</div>
				</div>

				<div className="accelerator-item__value">
					{this.value}
				</div>
			</div>
		);
	}
}
