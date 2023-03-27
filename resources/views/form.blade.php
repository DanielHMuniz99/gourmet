<div class="form">
    <form class="login-form">
        <p class="message">{{ $dish->getText() }}</p><br>
        @if($dish->getDish() && !$dish->isCorrectAnswer())
            <button type="button" class="btn btn-success" onclick="child({{ $dish->getDish()->id }})">Sim</button>
            <button type="button" class="btn btn-danger" onclick="next({{ $dish->getDish()->id }})">Não</button>
        @else
            <button type="button" class="btn btn-info" onclick="start()">{{ $dish->isCorrectAnswer() ? "recomeçar" : "começar" }}</button>
        @endif
    </form>
</div>