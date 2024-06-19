<h2>Ahoj, <b>{{$meno}} {{$priezvisko}}</b></h2>

<p style="padding-bottom: 10px;">Aktivuj svoj ucast <a target="_blank" href="http://localhost:8000/manage-registration?token={{$token}}">tu</a>!</p>

Aktualny harmonogram ktory si zvolil, na aktivacnej linke to mozes zmenit: <br>
{!! html_entity_decode($konvertovane_programy) !!}

