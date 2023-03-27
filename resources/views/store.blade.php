<div class="form">
    <form class="login-form">
        <p class="message">{{ $dish->getText() }}</p><br>
        <input type="text" id="name"/>
        <button type="button" class="btn btn-success" onclick="store('{{ $dish->getParentId() }}', '{{ $dish->getChildId() }}')">Salvar</button>
    </form>
</div>