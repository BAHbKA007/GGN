<!-- Button trigger modal -->
<div class="unten_rechts">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" style="height:34px;">
        <i class="material-icons" style="font-size:20px;">comment</i> 
    </button>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Kommentar zur Auslieferung an <b>{{$var['kunde']->name}}</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/comment" id="comment"> 
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="zaehlung_id" value="{{$var['zaehlung']->id}}">
                        <input type="hidden" name="kunde_id" value="{{$var['kunde']->id}}">
                        <textarea id="textarea" class="form-control" name="comment" rows="3" required>@if (count($var['comment']) > 0){{$var['comment'][0]->comment}}@endif</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="close" type="button" class="btn btn-secondary" data-dismiss="modal">schließen</button>
                    <button class="btn btn-primary commentButton" id="lodingButton" type="submit" data-form="comment" disabled>
                        <span id="spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display:none"></span>
                        <span id="btn-txt">speichern</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@if (isset($var['kommentar_artikel']))
<script>
    var my_i = 0;
    // falls Kommentar im Artikel erzeugt wird, die Artikelbezeichnung dem Text hinzufügen
    $('.unten_rechts').on('click', function () {
        console.log(my_i);
        if (my_i == 0) {
            var text = $('#textarea').val();
            if (text.length > 0) {
                text = text.concat("\n", "{{$var['kommentar_artikel']->bezeichnung}}: ")
            } else {
                text = text.concat("{{$var['kommentar_artikel']->bezeichnung}}: ")
            }

            $('#textarea').val(text);
        };

        my_i++;
    })
</script>
@endif
<script>
$('#textarea').on('change', function () {

    var text = $('#textarea').val();
    if (text.length > 0) {
        $('.commentButton').prop("disabled", false);
    }

})
</script>