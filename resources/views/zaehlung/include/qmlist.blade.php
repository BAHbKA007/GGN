@if (Auth::user()->role > 1)
    @foreach ($var['alle_zaehlungen'] as $item)
        <div class="list-group-item list-group-item-action">
            <a href="zaehlung/{{$item->id}}">Zählung vom {{$wochentag[strftime("%u", strtotime($item->created_at))]}} den {{strftime("%d.%m.%Y", strtotime($item->created_at))}} </a>
                <div class="float-right" style="padding-top: 3px">
                    <a class="btn btn-primary btn-sm" href="export/{{$item->id}}" role="button" style="padding-bottom:0px"><i class="material-icons">description</i></a>
                    <a class="btn btn-success btn-sm" href="#" role="button" style="padding-bottom:0px"><i class="material-icons">info</i></a>
                </div>
            <p style="margin-bottom:0;font-style:italic"><small>{{$item->name}}</small></p>
        </div>
    @endforeach
@endif