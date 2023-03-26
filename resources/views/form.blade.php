<div class="form">
    <form class="login-form">
        <p class="message">{{ $dish->getText() }}</p>
        @if($dish->getDish() && !$dish->isCorrectAnswer())
            <button class="true btn btn-success" onclick="child({{ $dish->getDish()->id }})">Sim</button>
            <button class="false btn btn-danger" onclick="next({{ $dish->getDish()->id }})">Não</button>
        @else
            <button class="false btn btn-info" onclick="start()">{{ $dish->isCorrectAnswer() ? "recomeçar" : "começar" }}</button>
        @endif
    </form>
</div>