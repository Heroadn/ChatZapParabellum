<h1>Criar Template</h1>
<form class="form-horizontal" method="post" role="form" action="/Install/template_post"  enctype="multipart/form-data">
    <div class="text-info">Os campos marcados com <i class="fas fa-asterisk"></i> são de preenchimento obrigatório.</div>
    <br>
    <div class="form-group">
        <label for="nome"><span style="color: dodgerblue">*</span>Nome:</label> <input class="form-control" name="nome" type="text">
        <label for="css"><span style="color: dodgerblue">*</span>Arquivos CSS:</label> <input class="form-control"name="css[0]" type="text">
        <div class="css_input"></div>
        <div class="row">
            <div class="col-sm-12">
                <div class="text-center">
                    <button type="button" class="btn btn-primary css_plus"><i class="fas fa-plus"></i>CSS</button>
                </div>
            </div>
        </div>

        <label for="js"><span style="color: dodgerblue">*</span>Arquivos JS:</label> <input class="form-control js_input" name="js[0]" type="text">
        <div class="js_input"></div>
        <div class="row">
            <div class="col-sm-12">
                <div class="text-center">
                    <button type="button" class="btn btn-primary js_plus"><i class="fas fa-plus"></i>JS</button>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="text-right">
        <input type="submit" class="btn btn-primary" value="Criar">
    </div>
</form>

<script>
    $(document).ready(function(){
        var css_index = 1;
        $(".css_plus").click(function(){
            $('.css_input').append('<input class="form-control" name="css['+css_index+']" type="text">');
            css_index++
        });

        var js_index = 1;
        $(".js_plus").click(function(){
            $('.js_input').append('<input class="form-control" name="js['+css_index+']" type="text">');
            js_index++
        });
    });
</script>
