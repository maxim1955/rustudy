<form action="/charge" method="post">
    <input type="text" name="amount" />
    {{ csrf_field() }}
    <input type="submit" name="submit" value="Pay Now">
</form>