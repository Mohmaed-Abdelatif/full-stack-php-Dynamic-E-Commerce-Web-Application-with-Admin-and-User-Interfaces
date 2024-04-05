$('.comment').submit(function(event){
    event.preventDefault();
    $('.alert').remove();
    var data={};
    var anyFieldEmpty = false;
    $('.comment input, .comment textarea').each(function(index,item){
        if($(item).val() != ''){
            data[$(item).attr('name')] = $(item).val();
        }else{
            $(item).parent().append('<div class="alert alert-danger mt-2">Cannot be impty</div>');
            anyFieldEmpty = true;
        }
    })

    if(!anyFieldEmpty){
        $.post('fun/send-messege.php', data, function(x){
            console.log("dfa");
            $('.newData').append(x);
            $('.comment input, .comment textarea').val('');
        })
    }
})