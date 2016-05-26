/**
 * Created by Mazba on 2/29/2016.
 */
$(function () {
    //active menu by mazba
    var allLink = $('.page-sidebar-menu li a');
    var path_name = window.location.pathname;
    path_name = path_name.toLowerCase();
    var foundLink = false;
    if(path_name.lastIndexOf('/')+1 == path_name.length){
        path_name = path_name.substring(0, path_name.length - 1);
    }
    allLink.each(function(){
        var thisUrl = $(this).attr('href').toLowerCase();
        if(path_name == thisUrl){
            checkParentSubMenu(this);
            foundLink = true;
        }
    });
    if(foundLink == false)
    {
        var allParm =  path_name = path_name.split('/');
        var controllerMethod = '/'+allParm[1]+'/'+allParm[2];
        allLink.each(function(){
            var thisUrl = $(this).attr('href').toLowerCase();
            if(controllerMethod == thisUrl){
                checkParentSubMenu(this);
                foundLink = true;
            }
        });

    }
    // ajax loadder
    $(document).ajaxStart(function()
    {
        $('#loader').show();
    });
    $(document).ajaxComplete(function(event,xhr,options)
    {
        $('#loader').hide();
    });
});
function checkParentSubMenu(ele)
{
    $(ele).closest('li').addClass('active');
    var obj = $(ele).closest('.sub-menu');
    if(obj.length > 0)
    {
        obj.closest('li').addClass('active');
        ele = obj.closest('li').closest('li');
        checkParentSubMenu(ele);
    }
    return 0;
}
//file upload preview
$(function () {
    $(document).on("change", ":file", function(event)
    {
        console.log('here');
        var container=$(this).attr('data-preview-container');
        if(container)
        {
            if(this.files && this.files[0])
            {
                var file_type=this.files[0].type;
                if(file_type && file_type.substr(0,5)=="image")
                {
                    var preview_height=200;
                    if($(this).attr('data-preview-height'))
                    {
                        preview_height=$(this).attr('data-preview-height');
                    }
                    var reader = new FileReader();

                    reader.onload = function (e)
                    {
                        var img_tag='<img height="'+preview_height+'" src="'+ e.target.result+'" >';
                        $(container).html(img_tag);
                    };
                    reader.readAsDataURL(this.files[0]);
                }
                else
                {
                    $(container).html(this.files[0].name);
                }
            }
        }
        else
        {
            console.log('no container');
        }

    });
    $(".alert").show().delay(3000).fadeOut();
});