<h1>Nova Dúvida</h1>

<form action="{{ route('supports.store') }}" method="POST">
    @csrf
    <input type="text" placeholder="Assunto" name="subject" required>
    <textarea name="body" cols="30" rows="5" placeholder="Descrição"></textarea>
    <button type="submit">Enviar</button>

</form>
