var url = 'http://instasmile.com.devel/';

window.addEventListener('load', function(){

    $('.btn-like').css('cursor', 'pointer');
    $('.btn-dislike').css('cursor', 'pointer');

    function like(){
        $('.btn-dislike').unbind('click').click(function(){
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src', url+'/img/hearts-red.png');

            $.ajax({
                url: url+'/like/'+$(this).data('id'),
                type: 'GET',
            });

            dislike();
        })
    }
    like();

    function dislike(){
        $('.btn-like').unbind('click').click(function(){
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src', url+'/img/hearts-grey.png');

            $.ajax({
                url: url+'/dislike/'+$(this).data('id'),
                type: 'GET',
            });

            like();
        })
    }
    dislike();
});