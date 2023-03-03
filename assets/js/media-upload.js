jQuery(function ($) {

	// Define the labels.
	const labels = {
		title: AMIGA_ACC_MEDIA_UPLOAD.title ?? 'Select or Upload Media',
		button: AMIGA_ACC_MEDIA_UPLOAD.uploadButton ?? 'Use this media'
	};

	// on upload button click
	$('body').on('click', '.amiga-acc-upload', function (event) {
		event.preventDefault(); // prevent default link click and page refresh

		const button = $(this);

		// Get the fields.
		const parentWrapper = button.closest('.amiga-acc-media-upload-wrapper');
		const imageWrapper = parentWrapper.find('img');
		const imageField = parentWrapper.find('input[type="hidden"]');
		const imageId = imageField.val();

		// Register the custom uploader.
		const customUploader = wp.media({
			title: labels.title,
			library: {
				type: 'image'
			},
			button: {
				text: labels.button
			},
			multiple: false
		}).on('select', function () { // it also has "open" and "close" events

			// Get the attachment.
			const attachment = customUploader.state().get('selection').first().toJSON();

			// Add the attachement url to the img src
			imageWrapper.attr('src', attachment.sizes.medium.url).show();
			// Add the attachment id to the hidden field
			imageField.val(attachment.id);

			toggleButtons();
		})

		// already selected images
		customUploader.on('open', function () {

			if (imageId) {
				const selection = customUploader.state().get('selection')
				attachment = wp.media.attachment(imageId);
				attachment.fetch();
				selection.add(attachment ? [attachment] : []);
			}

		})

		customUploader.open()

	});

	// Toggles the upload/remove buttons
	const toggleButtons = () => {
		const upload = $('.amiga-acc-upload');
		const remove = $('.amiga-acc-remove');

		// if upload is visible, hide
		if (upload.is(':visible')) {
			upload.hide();
			remove.show();
		} else {
			upload.show();
			remove.hide();
		}

	}
	// on remove button click
	$('body').on('click', '.amiga-acc-remove', function (event) {
		event.preventDefault();

		const button = $(this);
		const parentWrapper = button.closest('.amiga-acc-media-upload-wrapper');
		const imageWrapper = parentWrapper.find('img');
		const imageField = parentWrapper.find('input[type="hidden"]');

		// Clear the image field
		imageField.val('');
		// Hide the image and remove the src
		imageWrapper.hide().attr('src', '');

		toggleButtons();
	});
});