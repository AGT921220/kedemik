<div class="row">

<div class="col-md-3">
    <form method="POST" action="/dashboard/bulk-payments">
        @csrf
        <div class="form-group">
            <input type="hidden" name="type" required="true" value="{{ strtolower(str_replace(' ', '_', $type)) }}">
            <div class="form-group">
                <label>Fecha</label>
                <input class="datepicker form-control" type="date" required="true" name="date_payment_bulk">
            </div>

            <button class="btn btn-primary btn-block" type="submit">Agregar A Todos</button>
        </div>
    </form>
</div>
</div>
