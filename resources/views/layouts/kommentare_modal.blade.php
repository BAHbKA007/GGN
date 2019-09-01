<!-- Button trigger modal -->
<div class="unten_rechts">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
        <i class="material-icons" style="font-size:16px;">comment</i> Kommentieren
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
                        <textarea id="textarea" class="form-control" name="comment" rows="3">@if (count($var['comment']) > 0){{$var['comment'][0]->comment}}@endif</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="close" type="button" class="btn btn-secondary" data-dismiss="modal">schließen</button>
                    <button class="btn btn-primary" id="lodingButton" type="submit" data-form="comment">
                        <span id="spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display:none"></span>
                        <span id="btn-txt">speichern</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>