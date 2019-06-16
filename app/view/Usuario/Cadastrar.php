<div class="text-center" style="margin: 1px auto">
    <h1 class="p-text"> Cadastrar-se ao ZapChat</h1>
    <h4 class="p-text">	Converse com seus amigos e paquere, tudo isso de graça! </h4>
    <p class="p-text" style="font-size: 10px;"><i> *De graça por enquanto >:) ... </i></p>
    <form method="post" role="form" action="/Usuario/cadastrar_post"  enctype="multipart/form-data">
        <div class="form-group">
            <label for="nome_usuario">Nome do Usuario:</label>
            <input type="text" name="nome" class="form-purple" id="nome_usuario" aria-describedby="emailHelp" placeholder="Coloque seu nome de usuario aqui...">
            <small id="nameHelp" class="form-text text-muted">Coloque um nome maior que 5 digitos...</small>
        </div>
        <div class="form-group">
            <label for="email_usuario">Email do Cadastro:</label>
            <input type="email" name="email" class="form-purple" id="email_usuario" aria-describedby="emailHelp" placeholder="Coloque seu email aqui...">
            <small id="emailHelp" class="form-text text-muted">Não compartilhamos essa informação com ninguem...</small>
        </div>
        <div class="form-group">
            <label for="usuario_senha">Senha:</label>
            <input type="password" name="senha" class="form-purple" id="usuario_senha" placeholder="Escreva sua senha aqui...">
            <small id="nameHelp" class="form-text text-muted">Coloque uma senha maior que 5 digitos...</small>

        </div>

        <label for="foto_perfil"><span style="color: dodgerblue">*</span>Foto:</label><input class="form-control" name="foto_perfil" type="file">

        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="terms">
            <label class="form-check-label" for="terms">Concordo com os termos de uso.</label><br>
            <a href="https://desciclopedia.org/wiki/Deslivros:Como_fazer_um_pacto_com_o_dem%C3%B4nio"> <i> *terms.zapchat.com.ru* </i> </a>
        </div>

        <input type="submit" class="btn btn-primary" value="Salvar">
    </form>
</div>