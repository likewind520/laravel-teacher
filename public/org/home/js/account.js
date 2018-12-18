$(function(){
	
//	切换地址
	$('.content-address .consignee-item .radio').click(function(){
		$(this).parent().find('.radio-img').addClass('pitchOn');
		$(this).parent().siblings('.consignee-item').find('.radio-img').removeClass('pitchOn');
		
	});
	
	$('.invoice .radio').click(function(){
		$(this).parent().find('.radio-img').addClass('pitchOn');
		$(this).parent().siblings('.consignee-item').find('.radio-img').removeClass('pitchOn');
			if($(this).hasClass('yes')){
					$('.con').show();			
				}else{
					$('.con').hide();
				}
	
	
	})
	
	
	
	$('.tongyong').click(function(){
		$(this).addClass('active');
		$(this).siblings().removeClass('active');
		if($(this).hasClass('danwei')){
			$('.danweiname').show();			
		}else{
			$('.danweiname').hide();
		}
	})
	
	
	
	
})