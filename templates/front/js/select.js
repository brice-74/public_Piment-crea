document.addEventListener('DOMContentLoaded',function() {

    $(document).on('click','[ajax=rm-prop]',function(){
        const idProp = $(this).attr('datas');
        const ele = $(this).parent('.catProp');

        $.ajax({
            type:'post',
            url: 'remove-prop',
            data: { prop:idProp },
            success: function(datas){
                tab = JSON.parse(datas);

                if(tab['go'] != undefined){
                    $(ele).fadeOut(300,function(){
                        $(this).remove();
                    })
                }

                if(tab['flash'] != undefined){
                    $('.body').prepend(tab['flash']);
                }   
                if($(document).find('.feedback')){
                    let feed = $('.feedback');
                    setTimeout(function(){
                        $(feed).css({"top":"-20px",});
                    },400)
                    $(feed).click(function(){
                        $(feed).css({"top":"-70px",});
                        setTimeout(function(){
                            $(feed).remove();
                        },350)
                    })
                    if($(document).find('.feedback.timeout')){
                        let feedTime = $(".feedback.timeout");
                        setTimeout(function(){
                            $(feedTime).css({"top":"-70px",});
                            setTimeout(function(){
                                $(feedTime).remove();
                            },350)
                        },5000)
                    }
                }

            }
        });
    });
        

    $('select[multiple]').each(function(nb){

        var select = $(this);
        var parent = select.parent();
        var options = select.find('option');

        var selectMulti = $('<div />').addClass('selectMultiple multi' + nb);
        var active = $('<div />').addClass("divHidden");
        var list = $('<ul />');
        var placeholder = select.data('placeholder');

        var span = $('<span />').text(placeholder).appendTo(active);

        const zi = 1000 - nb; 
        $(parent).css({
            "z-index": zi
        })
        options.each(function() {
            var text = $(this).text();
            if($(this).is(':selected')) {
                active.append($('<a />').html('<em>' + text + '</em><i></i>'));
                span.addClass('hide');
            } else {
                list.append($('<li />').html(text));
            }
        });

        active.append($('<div />').addClass('arrow'));
        selectMulti.append(active).append(list);

        select.wrap(selectMulti);
        notIssetA();

        $(document).on('click','.selectMultiple.multi'+nb+' ul li', function() {
            var select = $(this).parent().parent();
            var li = $(this);
            if(!select.hasClass('clicked')) {
                select.addClass('clicked');
                select.find('option:contains(' + li.text() + ')').prop('selected', true);
                li.prev().addClass('beforeRemove');
                li.next().addClass('afterRemove');
                li.addClass('remove');
                var a = $('<a />').addClass('notShown').html('<em>' + li.text() + '</em><i></i>').hide().appendTo(select.children('div'));
                a.slideDown(400, function() {
                    setTimeout(function() {
                        a.addClass('shown');
                        select.children('div').children('span').addClass('hide');
                    }, 500);
                });
                setTimeout(function() {
                    if(li.prev().is(':last-child')) {
                        li.prev().removeClass('beforeRemove');
                    }
                    if(li.next().is(':first-child')) {
                        li.next().removeClass('afterRemove');
                    }
                    setTimeout(function() {
                        li.prev().removeClass('beforeRemove');
                        li.next().removeClass('afterRemove');
                    }, 200);

                    li.slideUp(400, function() {
                        li.remove();
                        select.removeClass('clicked');
                        notIssetA();
                    });
                }, 600);
            }
        });

        $(document).on('click', '.selectMultiple.multi'+nb+' > div a', function(e) {
            var select = $(this).parent().parent();
            var self = $(this);
            select.find('option:contains(' + self.children('em').text() + ')').prop('selected', false);        
            self.removeClass().addClass('remove');
            select.addClass('open');
            setTimeout(function() {
                self.addClass('disappear');
                setTimeout(function() {
                    self.animate({
                        width: 0,
                        height: 0,
                        padding: 0,
                        margin: 0
                    }, 250, function() {
                        var li = $('<li />').text(self.children('em').text()).addClass('notShown').appendTo(select.find('ul'));
                        li.slideDown(350, function() {
                            notIssetA();
                            li.addClass('show');
                            setTimeout(function() {
                                if(!select.find('option:selected').length) {
                                    select.children('div').children('span').removeClass('hide');
                                }
                                li.removeClass();
                            }, 350);
                        });
                        self.remove();
                    })
                }, 250);
            }, 350);
        });

        function notIssetA(){
            var select = $('.selectMultiple.multi'+nb);
            if($(select).children('div').find('a').length === 0){
                name = select.children('div').children('span').children('select').attr('name').replace(/_[a-z]+\[\]/g,"(s)"); 
                let txt = '<p class="arriv mb0 cGris posA mt5 txt14">Sélectionnez&nbsp;un&nbsp;ou&nbsp;plusieur&nbsp;'+name+'</p>';
                let p = $(txt).appendTo(select.children('div'));
                $(p).fadeIn(300, function(){
                    setTimeout(function(){
                        p.removeClass('arriv');
                    },300);
                });
            }else{
                $(select).children('div').children('p').fadeOut(300, function(){
                    setTimeout(function(){
                        $(this).remove();
                    },300);
                });
                
            }
        }


        $(document).on('click', '.selectMultiple.multi'+nb, function(e) {
            $('.selectMultiple').removeClass('open');
            $('.selectMultiple.multi'+nb).addClass('open');
            closeSelect();
            e.stopPropagation();
        });

        function closeSelect(){
            if($('.selectMultiple.multi'+nb).hasClass('open')){
                $(document).on('click', '#main', function(e) {
                    $('.selectMultiple.multi'+nb).removeClass('open');
                    e.stopPropagation();
                });
            }
        }
    })
})