
tinymce.PluginManager.add('upload', function(editor, url) {

    var objGallery, viewGallery = '<ul>', width = 2, cl = false;
    $.ajax({
        url: '/admin/ajax/getallgallery',
        success: function(data){
            objGallery = $.parseJSON(data);
            
            viewGallery = '<table role="presentation" cellspacing="0" class="mce-charmap"><tbody>';
            
            $.each(objGallery, function(i, e){
                viewGallery += '<tr>';
                    viewGallery += '<td title="' + e.name_gallery + '"><div tabindex="-1" title="' + e.name_gallery + '" role="button">' +
                        e.name_gallery + '<img src="/upload/images/' + e.folder_gallery + '/admin/' + e.name_img + '"/>'
                    + '</div></td>';
                viewGallery += '</tr>';
            });

            viewGallery += '</tbody></table>';

        }
    });

    /* Добавить элемент в меню*/
    editor.addMenuItem('upload', {
        text: 'Вставить галерею',
        context: 'tools',
        onclick: function() {

            function getParentTd(elm) {
                while (elm) {
                    if (elm.nodeName == 'TD') {
                        return elm;
                    }

                    elm = elm.parentNode;
                }
            }

            var listGallery = {
                type: 'container',
                html: viewGallery,
                onclick: function(e) {
                    var target = e.target;

                    if (target.tagName == 'TD') {
                        target = target.firstChild;
                    }

                    if (target.tagName == 'DIV') {
                        editor.execCommand('mceInsertContent', false, '{{'+target.firstChild.data+'}}');

                        if (!e.ctrlKey) {
                            win.close();
                        }
                    }
                }
            }

            win = editor.windowManager.open({
                title: 'Вставить галерею',
                width: 500,
                height: 400,
                padding: 10,
                items: [
                    listGallery
                ],
                buttons: [
                    {
                        text: 'Insert',
                        onclick: function() {
                           editor.insertContent('Gellery');
                        }
                    },

                    {text: 'Close', onclick: 'close'}
                ]
            });
        }
    });

});
