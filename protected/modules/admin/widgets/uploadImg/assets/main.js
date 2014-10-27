$(document).ready(function(){

    
    /*Отметить все изображения чекбоксами*/
    $('.check-all').on('click', function(){
        $('.list-image input[type=checkbox]').attr('checked', true);
        return false;
    });


    /*Снять со всех изображений чекбоксы*/
    $('.no-check-all').on('click', function(){
        $('.list-image input[type=checkbox]').attr('checked', false);
        return false;
    });


    /*Удалить одно изображение*/
    $('.image-panel a.remove').live('click', function(){

        if(!confirm('Вы уверены, что хотите удалить данный элемент?')) return false;

        $(this).removeFile();

        return false;
    });

    /*Удалить все отмеченные файлы*/
    $('.remove-files').on('click', function(){

        if(!confirm('Вы уверены, что хотите удалить данный элемент?')) return false;

        $('.list-image input[type=checkbox]:checked').each(function(i, e){
            $(e).prev().removeFile();
        });

    });

    /*Образать все отмеченные изображения*/
    $('.resize-files').on('click', function(){
        
        var url = $(this).attr('href');
        var param = {};
        $(this).parents('div.row-fluid').find('select').each(function(i, e){
            param[i] = $(this).val();
        });

        $('.list-image input[type=checkbox]:checked').each(function(i, e){
            $(e).resizeImage(param, url);
        });

        return false;
    });

});


(function($){
    /*Лоадер для изображений*/
    jQuery.fn.loaderImage = function(f)
    {
        if (f) {
            var loading = '<div class="loading" style="';
            loading += 'width:' + this.width() + 'px; ';
            loading += 'height:' + this.height() + 'px;';
            loading += '"></div>';

            this.prepend(loading);
        };

        if (!f) {
            $('.loading', this).remove();
        };
    }

    /*Удаляет файл по ссылке*/
    jQuery.fn.removeFile = function()
    {
        var href = this.attr('href');
        var li = this.parents('li');
        
        $.ajax({
            beforeSend: function(){
                li.loaderImage(true);
            },
            url: href,
            success: function(){
                li.loaderImage(false);
                li.remove();
            }
        });
    }

    /*Обрезка изображений*/
    jQuery.fn.resizeImage = function(param, url)
    {
        var li = this.parents('li');
        $.each($('img', li).attr('src').split('/'), function(i, e){
            if(i==3) param[2] = e;
            if(i==5) param[3] = e;
        });
        
        $.ajax({
            beforeSend: function(){
                li.loaderImage(true);
            },
            type: 'post',
            url: url,
            data: {size: param[0], resize:param[1], folder: param[2], file: param[3]},
            success: function(data){
                li.loaderImage(false);
            },
        });
    }

})(jQuery)