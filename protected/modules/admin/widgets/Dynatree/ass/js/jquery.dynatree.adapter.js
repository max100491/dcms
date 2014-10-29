;(function ($, window, undefined) {
	var pluginName = 'dynatreeAdapter',
		document = window.document,
		defaults = {
		};

	function Plugin(element, options) {
		options.menu = {
			z_index: 200,
			items: {
				add: 'Add',
				edit: 'Edit',
				data: 'Page Data',
				sep1: '-Sep-',
				delete: 'Delete'
			}
		};

		this.element = element;

		this.options = $.extend(defaults, options);

		this._defaults = defaults;
		this._name = pluginName;

		this.init();
	}

	Plugin.prototype.createContextMenu = function (onclick) {
		var self = this,
			ul_len = $('.context-menu-root').length + 1,
            menu_opts = self.options.dyna_options.menu_opts;

        if ( menu_opts && menu_opts.page_data === false ) {
            delete self.options.menu.items.data;
        }

        if ( menu_opts && menu_opts.edit === false ) {
            delete self.options.menu.items.edit;
        }

		this.options.$menu = $('<ul></ul>')
			.addClass('context-menu-list context-menu-root')
			.attr('id', 'contextMenu-' + ( ul_len + 1 ))
			.css('z-index', self.options.menu.z_index + ul_len * 10)
			.hide()
			.appendTo('body');

		$.map(this.options.menu.items, function (item, key) {
			var classes = [ 'context-menu-item' ],
				text = ( item == '-Sep-' ? '' : item );

			if ( item == '-Sep-' ) {
				classes.push('context-menu-separator not-selectable');
			} else {
				classes.push('icon icon-' + key);
			}

			$('<li><span></span></li>')
				.addClass(classes.join(' '))
				.html(text)
				.data('action', key)
				.appendTo(self.options.$menu)
				.on('click', function (e) {
					self.hideContextMenu();

					$.isFunction(onclick) &&
						onclick(self.options.$menu.data('clicked_item'), $(this).data('action'));
				})
				.children()
				.text(text);
		});
	}

	Plugin.prototype.hideContextMenuEvent = function (span) {
		var self = this,
			menu_selector = '#' + self.options.$menu.attr('id');

		$(self.element).on('mousedown', function (e) {
			var menu_fire_time = $(menu_selector).data('fire_time');

			if ( !$(e.target).is(menu_selector) &&
				$(e.target).parents(menu_selector).length == 0 &&
				menu_fire_time ) {
				if ( (new Date()).getTime() - menu_fire_time > 30 ) {
					self.options.$menu.hide();
				}
			}
		});
	}

	Plugin.prototype.hideContextMenu = function () {
		this.options.$menu.hide();
	}

	Plugin.prototype.bindContextMenu = function (span) {
		var self = this;

		$(span).on('mousedown', function (e) {
            var node = $.ui.dynatree.getNode(this);

            if ( e.which == 3 ) {
			    self.options.$menu
				    .show()
				    .data({
						clicked_item: $(this),
						fire_time: (function () {
							return (new Date()).getTime();
						} ())
				    })
				    .css({
						top: e.pageY + 5 + 'px',
						left: e.pageX + 5 + 'px'
				    })
                    .find('li:gt(0)')
                    .css({
                        display: node.data.level == 1 ? 'none' : 'block'
                    });
		    }
		}).on('contextmenu', function (e) {
			return false;
		});
	}

	Plugin.prototype.addNode = function ($node) {
		var opts = this.options,
			node = $.ui.dynatree.getNode($node),
			self = this;

		this.modifyTree({
			method: '_create',
			model: opts.model_data,
			parent: node.data.id
		}, function (re) {
			node.addChild({
				title: opts.new_folder,
				tooltip: "",
				isFolder: true,
				id: re.id,
				level: re.level
			});

			node.expand();
		});
	}

	Plugin.prototype.modifyTree = function (data, success) {
		var opts = this.options,
			self = this;

        if ( opts.model_data ) {
            data.YII_CSRF_TOKEN = opts.model_data.YII_CSRF_TOKEN;
        }

		$.ajax({
			url: opts.urls[data.method],
			type: 'POST',
			data: data,
			dataType: 'json',
			success: function (re) {
				$.isFunction(success) && success(re);
			},
			error: function (a, b, c) {

			}
		});
	}

	Plugin.prototype.deleteNode = function ($node) {
		var node = $.ui.dynatree.getNode($node);

		node.remove();
	}

	Plugin.prototype.init = function () {
		var opts = this.options,
			self = this;

		self.$menu = self.createContextMenu(function ($element, action) {
			var node = $.ui.dynatree.getNode($element),
			ajax_data = {node_id: ''},
            dyna_opts = self.options.dyna_options;

			switch ( action ) {
				case 'add':
					

					$('body').append('<div class="modal fade"></div>');
					var modal = $('.modal');
					$.get(opts.urls.create, function(data){
						modal.html(data).modal('show');
					});

					$('#add-gallery').live('click', function(){
						$.post(opts.urls.create, $('form#gallery-form').serialize() + '&id=' + node.data.id, function(data){
							modal.html(data);
						})
						return false;
					});

					$('.modal').on('hidden', function () {
				    	$(this).remove();
				    })

					break;

				case 'edit':

					window.location = '/admin/cat/update/id/' + node.data.id;

                    /*if ( $.isFunction(dyna_opts.onEdit) ) {
                        dyna_opts.onEdit(node);
                        break;
                    }

					$.xpopup({
						title: 'Edit item',
						ajax: {
							url: opts.urls.update.replace('--id--', node.data.id),
							beforeSend: function () {
								$.xpopup.loading();
							},
							data: ajax_data,
							complete: function () {
								$.xpopup.loadingHide();
							}
						}
					});*/

					break;

				case 'data':
					$.xpopup({
						title: node.data.title,
						ajax: {
							url: opts.urls.getData.replace('--id--', node.data.id),
							beforeSend: function () {
								$.xpopup.loading();
							},
							complete: function () {
								$.xpopup.loadingHide();
							}
						}
					});

					break;

				case 'delete':
					ajax_data.node_id = node.data.id;

					$.xpopup.confirm({
						text: 'Are you sure you want to delete this item?',
						title: 'Confirm',
						confirm_func: function () {
							$.ajax({
								type: 'post',
								url: opts.urls.delete,
								data: ajax_data,
								beforeSend: function () {
									$.xpopup.loading();
								},
								success: function (re) {
									self.deleteNode($element);
									$.xpopup.closeTop(true);
								},
								complete: function () {
									$.xpopup.loadingHide();
								}
							});
						}
					});

					break;
			}
		});


		self.hideContextMenuEvent();

	    $(this.element).dynatree({
			debugLevel: 0,
		    persist: true,
	        onActivate: function(node) {
	            //alert("You activated " + node);
	        },

			onClick: function(node, event) {
			},

            onDblClick: function(node, event) {
                if ( $.isFunction(self.options.dyna_options.dblclick) ) {
                    self.options.dyna_options.dblclick(node);
                }
			},

            onCustomRender: function(node) {
                var dyna_opts = self.options.dyna_options,
                    ret = '<a class="dynatree-title' +
                    ( node.data.visible == 'N' ? ' dya-invisible' : '') +
                    '" href="#">' + node.data.title + '</a>';

                if ( node.data.page_type == 2 ) {
                    ret += '<span class="ui-icon ui-icon-link"></span>';
                }

                if ( node.data.home_page == 'Y' ) {
                    ret += '<span class="ui-icon ui-icon-home"></span>';
                }

                if ( node.data.level > 1 &&
                    node.data.page_url != '' &&
                    dyna_opts.hide_url !== true ) {
                    ret += '<a class="dynatree-ext-link" target="_blank" href="' + node.data.page_url + '">/' + node.data.page_url + '</a>';
                }

                return ret;
            },

			/*Bind context menu for every node when it's DOM element is created.
			We do it here, so we can also bind to lazy nodes, which do not
			exist at load-time. (abeautifulsite.net menu control does not
			support event delegation)*/
			onCreate: function(node, span){
				$(span).attr('id', 'dynatree-span-' + node.data.id);

				if ( node.data.level == 1 ) {
					$(node.span).addClass('dya-root');
					node.data.addClass = 'dya-root';
				}

                if ( self.options.dyna_options.hide_menu !== true ) {
                    self.bindContextMenu(span);
                }
			},
	
		    dnd: {
				onDragStart: function (node) {
					/** This function MUST be defined to enable dragging for the tree.
					*  Return false to cancel dragging of node.
					*/
					return true;
				},
				autoExpandMS: 1000,
				preventVoidMoves: true, // Prevent dropping nodes 'before self', etc.
				onDragEnter: function (node, sourceNode) {
					/** sourceNode may be null for non-dynatree droppables.
					*  Return false to disallow dropping on node. In this case
					*  onDragOver and onDragLeave are not called.
					*  Return 'over', 'before, or 'after' to force a hitMode.
					*  Return ['before', 'after'] to restrict available hitModes.
					*  Any other return value will calc the hitMode from the cursor position.
					*/
					return true;
				},
				onDragOver: function (node, sourceNode, hitMode) {
					/** Return false to disallow dropping this node.
					*
					*/
					//logMsg("tree.onDragOver(%o, %o, %o)", node, sourceNode, hitMode);
					// Prevent dropping a parent below it's own child
					if ( node.isDescendantOf(sourceNode) ) {
						return false;
					}
	
					if ( node.data.level && node.data.level == 1 && hitMode != 'over' ) {
						return false;
					}
	
					// Prohibit creating childs in non-folders (only sorting allowed)
					if ( !node.data.isFolder && hitMode === "over" ) {
						return "after";
					}
				},
				onDrop: function (node, sourceNode, hitMode, ui, draggable) {
					/** This function MUST be defined to enable dropping of items on
					* the tree.
					*/
					//logMsg("tree.onDrop(%o, %o, %s)", node, sourceNode, hitMode);
					self.modifyTree({
						sourceNode: sourceNode.data.id,
						targetNode: node.data.id,
						method: 'move',
						action: hitMode
					});
	
					sourceNode.move(node, hitMode);
				}
			}
	    });

	};

	$.fn[pluginName] = function (options) {
		return this.each(function () {
			if ( !$.data(this, 'plugin_' + pluginName) ) {
				$.data(this, 'plugin_' + pluginName, new Plugin(this, options));
			}
		});
	};

}(jQuery, window));