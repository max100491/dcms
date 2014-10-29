
/* SumDialog */
(function($) {
  	$.fn.sumdialog = function(options) {

  	    $.fn.sumdialog.defaults = {
  	    	'id' : 'sum-dialog-' + Math.floor(Math.random() * 10001),
            'title' : 'Adding',
            'items' : {
                0 : {
                    'type' : 'text',
                    'title' : 'Title',
                    'name' : 'name'
                }
            },
			'button' : 'Add',
			'iwidth' : '150px'
		};
        
  	    options = $.extend($.fn.sumdialog.defaults, options);
            
        // Hide the popup
        $(document)
            .mousedown(function(e){
                if ( $('.sum-dialog').is(':visible') && !$(e.target).is('.sum-dialog') && !$(e.target).parents('.sum-dialog').is('.sum-dialog') ) {
                    $('.sum-title a').trigger('click');
                }
            });
            
		// Add the HTML of the dialog box
		$('\
            <div>\
                <div>\
                    <span></span>\
                    <a><span></span></a>\
                </div>\
                <div>\
                    <span></span>\
                    <form>\
                        <button></button>\
                        <div></div>\
                        <em></em>\
                    </form>\
                </div>\
            </div>')
			.addClass('sum-dialog')
			.attr({
				'id' : options.id
			})
			.appendTo('body')
			.find('div:first')
				.addClass('sum-title')
				.find('span:first')
					.text(options.title)
					.end()
				.next()
					.addClass('sum-body')
                    .find('span')
                        .addClass('preText')
                        .end()
					.find('form')
						.attr('method', 'post')
                        .prepend(function(){
                            var sHtml = '';
                            
                            for ( var i in options.items ) {
                                switch ( options.items[i].type ) {
                                    case 'text':
                                        sHtml += $('<b><div><span></span><input type="text" /></div></b>')
                                            .find('span')
                                                .html(options.items[i].title)
                                                .next()
                                                    .attr({
                                                        'name' : options.items[i].name
                                                    })
                                                    .css(options.items[i].css || {})
                                                    .end()
                                                .end()
                                            .html();
                                        break;
                                    
                                    case 'hidden':
                                        sHtml += $('<b><div><input type="hidden" /></div></b>')
                                            .find('div')
                                                .addClass('sum-hidden')
                                                .find('input')
                                                    .attr({
                                                        'name' : options.items[i].name
                                                    })
                                                    .end()
                                                .end()
                                            .html();
                                        break;
                                        
                                    case 'select':
                                        sHtml += $('<b><div><span></span><select></select></div></b>')
                                            .find('span')
                                                .html(options.items[i].title)
                                                .next()
                                                    .attr({
                                                        'name' : options.items[i].name
                                                    })
                                                    .css(options.items[i].css || {})
                                                    .html($(options.items[i].selElement).html())
                                                    .end()
                                                .end()
                                            .html();
                                        break;
                                        
                                    case 'textarea':
                                        sHtml += $('<b><div><span></span><textarea></textarea></div></b>')
                                            .find('span')
                                                .html(options.items[i].title)
                                                .next()
                                                    .attr({
                                                        'name' : options.items[i].name
                                                    })
                                                    .css(options.items[i].css || {})
                                                    .end()
                                                .end()
                                            .html();
                                        break;
                                }
                            }
                            
                            return sHtml;
                        })
						.find('button')
							.addClass('sum-button')
							.html(options.button)
							.click(function(e){ e.preventDefault(); })
							.next()
								.addClass('sum-loading');

  		return $(this.selector).live('click', function() {
                
                $sumTarget = $(this);
                
		        $('.sum-dialog').stop(true, true).hide();
                
                docPar = {
                    'wHe' : $(window).height(),
                    'dScT' : $(document).scrollTop(),
                    'wWi' : $(window).width()
                }
                
		        $('#' + options.id)
		            .data('id', $sumTarget.attr('rel'))
                    .css({
                        'top': ( $(this).offset().top + $('#' + options.id).outerHeight() > docPar.wHe + docPar.dScT ? docPar.wHe + docPar.dScT - $('#' + options.id).outerHeight() : $(this).offset().top ),
                        'left': ( $(this).offset().left + $('#' + options.id).outerWidth() + $(this).outerWidth() > docPar.wWi ? docPar.wWi - $('#' + options.id).outerWidth(): $(this).offset().left + $(this).outerWidth() )
                    })
                    .find('.sum-body div:not(.sum-loading)')
                        .each(function(i){
                            switch ( options.items[i].type ) {
                                case 'select':
                                    if ( options.items[i].value ) {
                                        var val = options.items[i].value($sumTarget);
                                        $(this).find('option:contains("' + val + '")').attr('selected', 'selected');
                                    }
                                    break;
                                    
                                default:
                                    $(this).find('input, textarea').val( $.isFunction(options.items[i].value) ? options.items[i].value($sumTarget) : '' ); 
                                    break;
                            }
                        })
                        .end()
		            .find('.sum-title a')
		                .click(function(){
		                    $('#' + options.id)
                                .stop(true, true)
                                .hide('fast')
                                .find('em')
                                    .hide();
							$.isFunction(options.close) && options.close.call(this);
		                })
		                .end()
                    .stop(true, true)
					.show('fast', function(){
                        if ( $.isFunction(options.query) ) {
                            addiQuery = options.query($sumTarget);
                        }
                        
                        // Pass the query into open func
                        $.isFunction(options.open) && options.open(addiQuery);
                    })
                    .find('span.preText')
                        .html($.isFunction(options.pText) && options.pText($sumTarget) || '')
                        .end()
		            .find('.sum-button')
			            .unbind('click')
			            .click(function(e) {
			                e.preventDefault();

							xQuery = $(this).parents('form').serialize();
                        
                            if ( $.isFunction(options.query) ) { xQuery += '&' + $.param(addiQuery); }
                            
			                $.ajax({
			                    url: options.url,
			                	data: xQuery,
			                	type: "post",
			                	dataType: "json",
			                    context: $(this),
			                    timeout: 5000,
			                	beforeSend: function() {
			                        $(this)
                                        .next()
                                            .show()
                                            .next()
                                                .hide();
                                },
			                    success: function(rs){
			                        if ( !rs.error ) {
			                            $(this)
			                                .nextAll()
			                                    .hide()
			                                    .end()
			                                .parents('.sum-dialog')
			                                    .hide();
                                                
										$.isFunction(options.done($sumTarget, rs)) && options.done.call;
                                        $.isFunction(options.close) && options.close.call(this);
                                        
			                            return;
			                        }
                                      
			                        $(this)
			                            .siblings('em')
			                                .html(rs.error)
                                            .show()
			                                .end()
			                            .next()
			                                .hide();
			                	}
			                });

			            })
						.next()
							.hide();

		    });

  	}
})(jQuery);

