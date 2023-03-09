import { useState, render, useEffect } from "@wordpress/element";
import AcceleratorCardComponent from "../components/Accelerator_Card_Component";

import "./../../assets/css/accelerator-panel.scss";

const getPostID = () => {
	const wrapper = document.querySelector('#react-app');
	return wrapper.dataset.foo;
}

const AcceleratorPanel = () => {

	const [postMeta, setPostMeta] = useState(0);

	useEffect(() => {
		const fetchPostMeta = async () => {
			const response = await fetch(gin0115AcceleratorPanel.rest + getPostID());
			const data = await response.json();
			setPostMeta(data.meta);
		};
		fetchPostMeta().catch((err) => {
			console.log(err.message);
		});
	}, []);

	// Show loading until we have data
	if (postMeta === 0) return (<div>Loading...</div>);

	// Render the details.
	return (
		<div id="accelerator-stats">
			<AcceleratorCardComponent meta={postMeta} />
		</div>
	);
};
render(<AcceleratorPanel />, document.getElementById('react-app'));
