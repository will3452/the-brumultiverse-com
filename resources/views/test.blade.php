<form action="/test" method="POST">
    @csrf
    <input type="text" name="description">
    <input type="number" name="amount">
    <input type="hidden" name="txnid" value="00001">
    <button>submit</button>
</form>
