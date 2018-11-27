/**
* The documentation of WP editor is very limited. Gzzz.
*/
(function($, _, wp) {

	var FireFeaturedImage = {

		/**
		 * Get the featured image post ID
		 *
		 * @global wp.media.view.settings
		 *
		 * @returns {wp.media.view.settings.post.featuredImageId|number}
		 */
		get: function() {
			return wp.media.view.settings.post.featuredImageId;
		},

		set: function(id) {
			var settings = wp.media.view.settings;
			settings.post.featuredImageId = id;

			wp.media.post('set-post-thumbnail', {
				json:         true,
				post_id:      settings.post.id,
				thumbnail_id: settings.post.featuredImageId,
				_wpnonce:     settings.post.nonce
			}).then(function( html ) {
				$('#the-fire-post-thumbnail .featured-image').html(html);
			});
		},

		remove: function() {
			var settings = wp.media.view.settings;
			settings.post.featuredImageId = -1;

			wp.media.post('set-post-thumbnail', {
				json:         true,
				post_id:      settings.post.id,
				thumbnail_id: -1,
				_wpnonce:     settings.post.nonce
			}).then(function(html) {
				$('#the-fire-post-thumbnail .featured-image').html(html);
			});
		},

		/**
		 * The Featured Image workflow
		 *
		 * @global wp.media.controller.FeaturedImage
		 * @global wp.media.view.l10n
		 *
		 * @this wp.media.featuredImage
		 *
		 * @returns {wp.media.view.MediaFrame.Select} A media workflow.
		 */
		frame: function() {
			if ( this._frame ) {
				return this._frame;
			}

			this._frame = wp.media({
				state: 'featured-image',
				states: [ new wp.media.controller.FeaturedImage() , new wp.media.controller.EditImage() ]
			});

			this._frame.on( 'toolbar:create:featured-image', function( toolbar ) {
				/**
				 * @this wp.media.view.MediaFrame.Select
				 */
				this.createSelectToolbar( toolbar, {
					text: wp.media.view.l10n.setFeaturedImage
				});
			}, this._frame );

			this._frame.on( 'content:render:edit-image', function() {
				var selection = this.state('featured-image').get('selection'),
					view = new wp.media.view.EditImage( { model: selection.single(), controller: this } ).render();

				this.content.set( view );

				// after bringing in the frame, load the actual editor via an ajax call
				view.loadEditor();

			}, this._frame );

			this._frame.state('featured-image').on( 'select', this.select );
			return this._frame;
		},
		/**
		 * 'select' callback for Featured Image workflow, triggered when
		 *  the 'Set Featured Image' button is clicked in the media modal.
		 *
		 * @global wp.media.view.settings
		 *
		 * @this wp.media.controller.FeaturedImage
		 */
		select: function() {
			var selection = this.get('selection').single();

			if ( ! wp.media.view.settings.post.featuredImageId ) {
				return;
			}

			FireFeaturedImage.set( selection ? selection.id : -1 );
		},

		/**
		 * Open the content media manager to the 'featured image' tab when
		 * the post thumbnail is clicked.
		 *
		 * Update the featured image id when the 'remove' link is clicked.
		 *
		 * @global wp.media.view.settings
		 */
		init: function() {
			$('#the-fire-post-thumbnail').on( 'click', '#set-post-thumbnail', function(event) {
				event.preventDefault();
				// Stop propagation to prevent thickbox from activating.
				event.stopPropagation();

				FireFeaturedImage.frame().open();
			}).on('click', '#remove-post-thumbnail', function(e) {
				e.preventDefault();
				e.stopPropagation();
				FireFeaturedImage.remove();
			});
		}
	};

	$(FireFeaturedImage.init);

})(jQuery, _, wp);