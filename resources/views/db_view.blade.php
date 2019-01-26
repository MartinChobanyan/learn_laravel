<ul>
@foreach( $rows as $row)
   <li><h4> {{ $row->some_string_data }} </h4></li>
@endforeach
</ul>