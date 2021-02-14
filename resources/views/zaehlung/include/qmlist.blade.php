@if (Auth::user()->role > 1)
    @foreach ($var['alle_zaehlungen'] as $item)
        <div class="list-group-item list-group-item-action">

            <div class="float-left" style="padding-top:3px;padding-right:10px">
                <a class="btn btn-sm @if ($item->sum_erledigt > 0) btn-danger @endif my_button_zaehlung" href="" target="popup" onclick="window.open('/comment/{{$item->id}}','name','width=600,height=900')" role="button">
                    <i class="material-icons">comment</i>
                </a>
            </div>

            <a href="zaehlung/{{$item->id}}">{{$wochentag[strftime("%u", strtotime($item->created_at))]}} {{strftime("%d.%m.%Y", strtotime($item->created_at))}} <small>{{$item->name}}</small></a>
                @if (Auth::user()->role > 1)
                    <div class="float-right" style="padding-top: 3px">
                        <a class="btn btn-primary btn-sm my_button_zaehlung @if ($item->sum_erledigt > 0) disabled @endif" href="export/{{$item->id}}" role="button" @if ($item->sum_erledigt > 0) aria-disabled="true" @endif><i class="material-icons" data-toggle="tooltip" data-placement="top" title="GGN Liste downloaden">description</i></a>
                        <a class="btn btn-secondary btn-sm my_button_zaehlung @if ($item->sum_erledigt > 0) disabled @endif" href="kistenexport/{{$item->id}}" role="button" @if ($item->sum_erledigt > 0) aria-disabled="true" @endif><i class="material-icons" data-toggle="tooltip" data-placement="top" title="Leergut Liste downloaden">inventory</i></a>
                        <a class="btn btn-success btn-sm my_button_zaehlung" href="/zaehlung/info/{{$item->id}}" role="button"><i class="material-icons" data-toggle="tooltip" data-placement="top" title="Übersicht anzeigen">info</i></a>
                    </div>
                @endif
            <p style="margin-bottom:0;font-style:italic">
                @if (isset($item->letze_aenderung))
                    <small>
                        letzte Änderung: {{$item->user_aenderung}} {{strftime("%d.%m.%Y %H:%M:%S", strtotime($item->letze_aenderung))}}
                    </small>
                @endif
            </p>
        </div>
            {{-- Script für die TooltipBox --}}
        <script>$(function () {
            $('[data-toggle="tooltip"]').tooltip()
          })</script>
    @endforeach
@endif