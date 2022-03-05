<div class="content container well">
    <form class="form-horizontal" id="app_form" name="app_form" method="post" action="generate.php">
        <div class="tabbable">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#app" data-toggle="tab">General</a></li>
                <li><a href="#models" data-toggle="tab">Models</a></li>
<!--                <li><a href="#video" data-toggle="tab">How to video</a></li>-->
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="app">
                    <div class="form-container well" style="background: none;">
                        <?php include('ui/forms/app.php');?>
                        <?php include('ui/forms/generate.php');?>
                    </div>
                </div>

                <div class="tab-pane" id="models">
                    <div class="form-container well" style="background: none;">
                        <?php include('ui/forms/models.php');?>
                    </div>
                </div>

                <div class="tab-pane" id="blocks">
                    <div class="form-container well" style="background: none;">
                        <?php include('ui/forms/blocks.php');?>
                    </div>
                </div>
<!--                <div class="tab-pane" id="video">
                    <div class="form-container well" style="background: none;">
                        <iframe width="853" height="480" src="https://www.youtube.com/embed/JVnW2AK7OJM" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>-->
            </div>
        </div>
    </form>
</div>

<script>
    function shake(element) {
        element.addClass('shaking');
        setTimeout(function () {
            element.removeClass('shaking');
        }, 900);
    }
    $('#app_form').on('submit',function(params){
        if($('#app_namespace').val() == '') {
            shake($('#app_namespace'));
            return false;
        }
        $.ajax({
            url: "generate.php",
            type : 'post',
            data:   $('#app_form').serialize()
        }).done(function(response) {
            window.location.href=response;
        });
        return false;
    });
    $('.control-group.depends').each(function(i,e){
        $('#'+$(e).attr('depends')).on('change',function (el){
            $('div[depends="'+$(el.target).attr('id')+'"]').toggle();
        });
    })
</script>
