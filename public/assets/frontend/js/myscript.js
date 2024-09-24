$(function(){

    $('#showModal').click(function(){
        Swal.fire({
            position: "top-end",
            icon: "error",
            title: "Warning!",
            text: 'You have access to the page as an admin'
        });
    })


    $('#btn_created').prop('disabled',true);
    $('#btnApply').prop('disabled',true);
    
    $('input#atribute').click(function(){
        if($('input#atribute').is(':checked')){
            $('#btnApply').prop('disabled',false);
        }else{
            $('#btnApply').prop('disabled',true);
        }
    })
    $('input[name=confirm_olds]').click(function(){
        if($('input[name=confirm_olds]').is(':checked')){
            $('#btn_created').prop('disabled',false);
        }else{
            $('#btn_created').prop('disabled',true);
        }
    })

    $('#openFilter').on('click',function(){
        $('.rightBar').addClass('opened');
    })


    $('#bar').on('click', function(){
        $('.openedMenu').addClass('showOpened');
        $('body').css({'overflow':'hidden'});
    })

    // sidebar menu
    $('.rtl_btn').on('click', function(){
        $('.openedMenu').removeClass('showOpened');
        $('.filterMenu').removeClass('showFiltrMenu');
        $('body').css({'overflow':'unset'});
    })
    

    $('#btnFilter').on('click', function(){
        $('.filterMenu').addClass('showFiltrMenu');
        $('body').css({'overflow':'hidden'});
    })

    $('.opened_body_li li').on('click',function(){
        $(this).children('.subdropdown_m').slideToggle();
    })



    var maxQuan = $('input[name=quantity]').val();

    $('.dropdown_li li').on('click',function(){
        $(this).children('.subdropdown').slideToggle();
    });
    var i = maxQuan;
    if(i < maxQuan){
        $('input[name=quantity]').val(maxQuan);
        $('button.quantity-left-minus').prop('disabled',true)
    }
    $('.quantity-right-plus').on('click',function(){
        i++;
        $('input[name=quantity]').val(i)
        $('button.quantity-left-minus').prop('disabled',false)
    });

    $('.quantity-left-minus').on('click',function(){
        --i;
        if(i < maxQuan){
            $('input[name=quantity]').val(maxQuan);
            $('button.quantity-left-minus').prop('disabled',true)
        }else{
            $('input[name=quantity]').val(i);
           
        }
        
    });

    $('#openVideobtn').on('click',function(){
        $('#uploadImage').click();
    });


    

});




// addtoCard

function addtoCard(id){
    var quan = parseInt($('input[name=quantity]').val());
    $.ajax({
        url:'',
        method:'GET',
        data:{'id':id,'quan':quan},
        success:function(response){
            location.href='https://globaldrinkshub.com/addtocard?id='+id+'&quan='+quan;
        }
    })
}