var XtrmScrollTop = function(params) {
	var $ = jQuery;
    var options= {
    	useOptions: true,
    	right: '25px',
    	bottom: '25px',
    	width: '80px',
    	height: '80px',
    	border: '1px solid #ccc',
    	borderRadius: '8px',
    	opacity: '.75',
    	background: '#666',
    	backgroundImage: '/media/mod_xtrmtotop/image/scroll-to-top.png'
    };
    var start  = 0;
    
    if(typeof(params) != 'undefined') {
        if(typeof(params.useOptions) != 'undefined') {
            options.useOptions = params.useOptions;
        }
        
        if(typeof(params.bottom) != 'undefined') {
            options.bottom = params.bottom;
        }

        if(typeof(params.right) != 'undefined') {
            options.right = params.right;
        }

        if(typeof(params.width) != 'undefined') {
            options.width = params.width;
        }

        if(typeof(params.height) != 'undefined') {
            options.height = params.height;
        }

        if(typeof(params.border) != 'undefined') {
            options.border = params.border;
        }

        if(typeof(params.borderRadius) != 'undefined') {
            options.borderRadius = params.borderRadius;
        }

        if(typeof(params.opacity) != 'undefined') {
            options.opacity = params.opacity;
        }
        
        if(typeof(params.background) != 'undefined') {
            options.background = params.background;
        }

        if(typeof(params.backgroundImage) != 'undefined') {
            options.backgroundImage = params.backgroundImage;
        }
    }
    
    var runOnScroll = function () {
        if($(window).scrollTop() > 100) {
            if(start == 0) {
                $('body').append('<div id="totop" class="totop"></div>');
                $('#totop').css({display: 'block', position: 'fixed'});
                
                if(options.useOptions == true) {
                    $('#totop').css({
                        bottom: options.bottom,
                        right: options.right,
                        width: options.width,
                        height: options.height,
                        border: options.border,
                        borderRadius: options.borderRadius,
                        opacity: options.opacity,
                        background: options.background
                    });
                }
                
                $('#totop').append('<a id="lnktotop" class="lnktotop"></a>');
            	$('#lnktotop').css({
            	    display: 'block',
                    width: '100%',
                    height: '100%',
                    cursor: 'pointer'
                });
            	
            	if(options.useOptions == true) {
	            	$('#lnktotop').css({
	                    background: 'url("'+options.backgroundImage + '") no-repeat center'
	                });
            	}
            	
            	$('#lnktotop').on('click', function(){
            		$('html, body').animate({scrollTop: 0});
            	});

                start =1;
            }
        } else {
            $('#totop').remove();

            start = 0;
        }
    }
    
    runOnScroll();
    
    window.addEventListener('scroll', runOnScroll);
}